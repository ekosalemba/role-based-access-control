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
/*
 * HMVC Module Locations  
 */
$config['modules_locations'] = array(
    APP_MODULE_PATH => APP_MODULE_VALUE,
    MY_SYS_MODULE_PATH => MY_SYS_MODULE_VALUE . 'modules/',
    MY_SYS_MODULE_PATH . 'my_system/' => MY_SYS_MODULE_VALUE . 'modules/my_system/',
    MY_APP_PATH . 'modules/' => MY_APP_PATH_VALUE . 'modules/',
);

/**
 * Load module configuration in appliation 
 */
require_once MY_APP_PATH . 'config/config_modules.php';
require_once MY_APP_PATH . 'config/config_system.php';
