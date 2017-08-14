<?php

if (!defined('MY_SYS_PATH'))
    exit('No direct script access allowed');

/* module configuration/man */
$v_man_module = array(
    'app' => 'app',
    'rest_server' => 'rest_server'
);

$config['modules_locations_app'] = array();

if (count($v_man_module) > 0) {
    foreach ($v_man_module as $key => $value) {
        $v_man_config = MY_APP_PATH . 'config/config_modules_' . $value . '.php';
        if (file_exists($v_man_config)) {
            require_once $v_man_config; //echo $v_man_config;
            //log_message('debug', 'Module Config/man file loaded: '.$v_man_config);

            $v_modules_location = 'modules_locations_' . $value;
            if (array_key_exists($v_modules_location, $config)) {
                $config['modules_locations_app'] = array_merge($config['modules_locations_app'], $config[$v_modules_location]);
            } else {
                show_error("MY_ERROR::CONFIG_NOT_EXIST, " . 'The configuration variable $config["' . $v_modules_location . '"]' . ' does not exist.');
            }
        } else {
            show_error("MY_ERROR::FILE_NOT_EXIST, " . 'The module configuration file ' . $v_man_config . '.php' . ' does not exist.');
        }
    }
}
?>