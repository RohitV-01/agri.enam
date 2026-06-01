<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_hook {

    /**
     * Restrict admin panel access by IP address.
     *
     * Runs as a post_controller_constructor hook. If admin_allowed_ips
     * is configured (non-empty array), only those IPs can reach any
     * controller inside the admin/ directory.
     */
    public function check_admin_ip() {
        $CI =& get_instance();

        // Only apply to admin directory requests
        $directory = (string) $CI->router->fetch_directory();

        if (strtolower(trim($directory)) !== 'admin/') {
            return; // Not an admin route — skip
        }

        $allowed_ips = $CI->config->item('admin_allowed_ips');

        // If the whitelist is not configured or empty, allow all (no restriction)
        if (!is_array($allowed_ips) || empty($allowed_ips)) {
            return;
        }

        $client_ip = $CI->input->ip_address();

        if (!in_array($client_ip, $allowed_ips)) {
            log_message('error', 'Admin access DENIED for IP: ' . $client_ip 
                . ' | URI: ' . $CI->uri->uri_string());
            show_error(
                'Access Denied: Your IP address (' . htmlspecialchars($client_ip) 
                . ') is not authorized to access this panel.',
                403,
                'Forbidden'
            );
        }
    }
}
