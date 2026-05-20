<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_hook {
    public function check_admin_ip() {
        $CI =& get_instance();
        
        // Check if the current request is for the admin panel
        $directory = $CI->router->fetch_directory();
        
        if ($directory == 'admin/') {
            $allowed_ips = $CI->config->item('admin_allowed_ips');
            if (is_array($allowed_ips) && !empty($allowed_ips) && !in_array($CI->input->ip_address(), $allowed_ips)) {
                show_error('Access Denied: Your IP address is not authorized to access this panel.', 403);
            }
        }
    }
}
