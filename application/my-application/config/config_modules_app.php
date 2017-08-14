<?php

if (!defined('MY_SYS_PATH'))
    exit('No direct script access allowed');
/**
 * Module Location for app
 */
$config['modules_locations_app'] = array(
    MY_APP_PATH . 'modules/app/' => MY_APP_PATH_VALUE . 'modules/app/',
    MY_APP_PATH . 'modules/app/sub_folder/' => MY_APP_PATH_VALUE . 'modules/app/sub_folder/',
);
?>