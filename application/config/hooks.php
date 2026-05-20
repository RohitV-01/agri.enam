<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$hook['post_controller_constructor'][] = array( 
'class' => 'Test_hook', 
'function' => 'hooks_fun',
'filename' => 'Test_hook.php',
'filepath' => 'hooks' 
//'params' => array('beer', 'wine', 'snacks') 
);

$hook['post_controller_constructor'][] = array(
'class' => 'Security_hook',
'function' => 'check_admin_ip',
'filename' => 'Security_hook.php',
'filepath' => 'hooks'
);

