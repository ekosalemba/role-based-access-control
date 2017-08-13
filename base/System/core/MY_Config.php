<?php

/**
 * 
 * @author ekoaprianto
 * 
 */
/**
 * 
 * @inspiring from muharihar
 * 
 */
if (!defined('MY_SYS_PATH'))
    exit('No direct script access allowed');

$my_config = array();

$my_config['my_sys_path'] = 'my-sys';
$my_config['my_app_path'] = 'my-app';

$my_config['module_path'] = 'modules';


$ci_app_path = realpath(APPPATH);
$v_deep = substr_count($ci_app_path, DIRECTORY_SEPARATOR) - substr_count(realpath(MY_ROOT_PATH), DIRECTORY_SEPARATOR);
$v_deep_path = str_repeat('..' . DIRECTORY_SEPARATOR, $v_deep);

//my modules
define('MY_SYS_MODULE_PATH', MY_SYS_PATH . $my_config['module_path'] . '/');
define('MY_SYS_MODULE_VALUE', $v_deep_path . $my_config['my_sys_path'] . '/');

define('MY_APP_PATH_VALUE', $v_deep_path . $my_config['my_app_path'] . '/');

//ci application module
define('APP_MODULE_PATH', APPPATH . $my_config['module_path'] . '/');
define('APP_MODULE_VALUE', '../' . $my_config['module_path'] . '/');
