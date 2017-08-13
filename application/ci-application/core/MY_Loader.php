<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require MY_SYS_PATH . "plugins/MX/Loader.php";

class MY_Loader extends MX_Loader {

    public function __construct() {
        parent::__construct();
    }

    public function controller($app_path = NULL, $modules = NULL, $file_name, $object_name = NULL) {
        $CI = & get_instance();

        $file_path_sys = MY_APP_PATH . 'system/' . $modules . '/controllers/' . $file_name . '.php';
        $file_path_mod = MY_APP_PATH . 'modules/' . $app_path . '/' . $modules . '/controllers/' . $file_name . '.php';
        if ($object_name === NULL) {
            $object_name = strtolower($file_name);
        }
        $class_name = ucfirst($file_name);

        if (file_exists($file_path_sys)) {
            require $file_path_sys;
            $CI->$object_name = new $class_name();
        } else if (file_exists($file_path_mod)) {
            require $file_path_mod;
            $CI->$object_name = new $class_name();
        } else {
            show_error("Unable to load the requested controller class: " . $class_name);
        }
    }

}
