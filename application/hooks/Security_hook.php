<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_hook {

    /**
     * Gate all admin panel access.
     *
     * Two layers of protection, applied in order:
     *  1. Flag gate   — panel returns 404 unless ADMIN_PANEL_ENABLED=true
     *  2. IP allowlist — if admin_allowed_ips is non-empty, only listed
     *                    addresses can reach the panel after the flag is on.
     *
     * Runs as a post_controller_constructor hook.
     */
    public function check_admin_ip()
    {
        $CI =& get_instance();

        // Only applies to admin/* routes
        $directory = (string) $CI->router->fetch_directory();
        if (strtolower(trim($directory)) !== 'admin/') {
            return;
        }

        // --- Layer 1: Flag-based access gate ---
        // The panel is completely hidden (404) unless ADMIN_PANEL_ENABLED=true
        // is set as an environment variable.
        if ( ! $CI->config->item('admin_panel_enabled')) {
            show_404('', FALSE);
            exit;
        }

        // --- Layer 2: IP allowlist (optional) ---
        // If admin_allowed_ips is a non-empty array, only listed addresses
        // can reach the panel even after the flag is enabled.
        $allowed_ips = $CI->config->item('admin_allowed_ips');
        if (is_array($allowed_ips) && ! empty($allowed_ips)) {
            $client_ip = $CI->input->ip_address();
            if ( ! in_array($client_ip, $allowed_ips)) {
                log_message('error', 'Admin access DENIED for IP: ' . $client_ip
                    . ' | URI: ' . $CI->uri->uri_string());
                show_error(
                    'Access Denied: Your IP address (' . htmlspecialchars($client_ip)
                    . ') is not authorised to access this panel.',
                    403,
                    'Forbidden'
                );
                exit;
            }
        }
    }
}
