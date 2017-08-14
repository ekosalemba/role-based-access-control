<?php

if (!defined('MY_SYS_PATH'))
    exit('No direct script access allowed');

/* module app. system */
$config['modules_locations_app_system'] = array(
    MY_APP_PATH . 'system/' => MY_APP_PATH_VALUE . 'system/'
);

$config['modules_locations_app'] = array_merge($config['modules_locations_app'], $config['modules_locations_app_system']);
?>