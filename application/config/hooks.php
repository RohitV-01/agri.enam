<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: Test_hook (visitor counter) disabled — it crashes the site if the
// visitor_count table is missing, and has a SQL injection vulnerability.
// $hook['post_controller_constructor'][] = array( 
// 'class' => 'Test_hook', 
// 'function' => 'hooks_fun',
// 'filename' => 'Test_hook.php',
// 'filepath' => 'hooks' 
// );

// pre_controller fires BEFORE the admin controller is instantiated,
// so a 500 from the controller constructor cannot bypass this gate.
$hook['pre_controller'][] = array(
'class'    => 'Security_hook',
'function' => 'check_admin_ip',
'filename' => 'Security_hook.php',
'filepath' => 'hooks'
);
