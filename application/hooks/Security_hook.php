<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_hook {

    /**
     * Gate all admin panel access — fires at pre_controller stage.
     *
     * Running pre_controller means this check happens BEFORE the admin
     * controller is instantiated, so a 500 from the constructor cannot
     * bypass the gate.
     *
     * Two layers of protection, applied in order:
     *  1. Flag gate   — all /admin/* requests return 404 unless
     *                   admin_panel_enabled = TRUE in config.php
     *  2. IP allowlist — if admin_allowed_ips is non-empty, only listed
     *                    addresses can reach the panel after the flag is on.
     */
    public function check_admin_ip()
    {
        // At pre_controller stage the CI super-object is not yet available.
        // Check the URI directly from the server request.
        $uri = isset($_SERVER['REQUEST_URI']) ? strtolower($_SERVER['REQUEST_URI']) : '';

        // Only gate /admin/* paths
        if (strpos($uri, '/admin/') === FALSE && substr($uri, -6) !== '/admin') {
            return;
        }

        // Load CI config manually (the config file has already been loaded
        // by CI core at this stage, so we read it from the CI Config class).
        $CI_config = & load_class('Config', 'core');

        // --- Layer 1: Flag-based access gate ---
        if ( ! $CI_config->item('admin_panel_enabled')) {
            header('HTTP/1.1 404 Not Found');
            header('Content-Type: text/html; charset=UTF-8');
            echo '<!DOCTYPE html><html><head><title>404 Not Found</title></head>'
               . '<body><h1>404 Not Found</h1><p>The page you requested was not found.</p></body></html>';
            exit;
        }

        // --- Layer 2: IP allowlist (optional) ---
        $allowed_ips = $CI_config->item('admin_allowed_ips');
        if (is_array($allowed_ips) && ! empty($allowed_ips)) {
            $client_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                ? trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0])
                : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');

            if ( ! in_array($client_ip, $allowed_ips)) {
                header('HTTP/1.1 403 Forbidden');
                header('Content-Type: text/html; charset=UTF-8');
                echo '<!DOCTYPE html><html><head><title>403 Forbidden</title></head>'
                   . '<body><h1>403 Forbidden</h1><p>Your IP address is not authorised to access this panel.</p></body></html>';
                exit;
            }
        }
    }
}
