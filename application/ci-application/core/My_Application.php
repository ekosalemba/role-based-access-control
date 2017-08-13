<?php

/**
 * Description of Application_base
 *
 * @author ekoaprianto
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Application extends MX_Controller {

    // base variable
    protected $app_id;
    protected $sys_app;
    protected $sys_user;
    protected $group_id;
    protected $sys_group;
    protected $lang_code;
    protected $is_registered = FALSE;
    protected $is_public = FALSE;
    protected $is_need_auth = FALSE;
    protected $is_need_autz = FALSE;
    protected $is_need_register = FALSE;
    protected $sys_module_path = '';
    protected $sys_module = '';
    protected $sys_module_action = '';
    protected $is_auth;
    protected $is_autz;
    protected $acl = array();
    protected $current_lang;
    protected $other_lang = array();
    protected $login_url;
    protected $logout_url;
    # privileges
    protected $prev_public = 1;
    protected $prev_auth = 2;
    protected $prev_autz = 3;
    #
    protected $session_login_name;

    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('system/system_model');
    }

    //--------------------------------------------------------------------------
    // <editor-fold defaultstate="collapsed" desc="BASE LOAD APP">
    protected function _init_base_variable() {
        $this->lang_code = (empty($this->session->userdata('lang_code'))) ? 'en' : $this->session->userdata('lang_code');
        $this->current_lang = $this->system_model->get_lang_by_code($this->lang_code);
        $this->other_lang = $this->system_model->get_other_lang_code($this->lang_code);

        $this->sys_module_path = $this->uri->segment(1);
        $this->sys_module_action = (empty($this->uri->segment(3))) ? $this->uri->segment(2) . '/index' : $this->uri->segment(2) . '/' . $this->uri->segment(3);
    }

    protected function _module_is_registered() {
        $params = array($this->sys_module_path, $this->sys_module_action, $this->app_id);
        $this->sys_module = $this->system_model->is_register($params);
        if (count($this->sys_module) > 0) {
            $this->is_registered = TRUE;
            # check module is active
            self::_module_is_active();
            # check module action is public / auth / autz
            self::_module_privileges();
            # check is login / auth
            self::_module_is_auth();
            # check is has privileges / autz
            self::_module_is_autz();
        } else {
            if (ENVIRONMENT == 'development') {
                $this->is_need_register = TRUE;
                // redirect to auto register module
                show_error("MY_ERROR::MODULE_NOT_REGISTERED, " . "Modul belum diregister-kan, kalau environment nya dev, besok ditambah autoregister ya!");
                die();
            } else {
                $this->is_registered = FALSE;
                // redirect to error page
                show_error("MY_ERROR::MODULE_NOT_REGISTERED, " . "Module is not registered!");
                die();
            }
        }
    }

    protected function _module_is_active() {
        if ($this->sys_module['module_is_active'] != 1) {
            // redirect to error page
            echo 'Module is not active!';
            die();
        } else if ($this->sys_module['module_action_is_active'] != 1) {
            // redirect to error page
            show_error("MY_ERROR::MODULE_ACTION_IS_NOT_ACTIVE, " . "Module action is not active, check on your RBAC database configuration!");
            die();
        }
    }

    protected function _module_privileges() {
        if ($this->sys_module['module_action_privilege_id'] == $this->prev_autz) {
            $this->is_need_auth = TRUE;
            $this->is_need_autz = TRUE;
        } elseif ($this->sys_module['module_action_privilege_id'] == $this->prev_auth) {
            $this->is_need_auth = TRUE;
        } elseif ($this->sys_module['module_action_privilege_id'] == $this->prev_public) {
            $this->is_public = TRUE;
        } else {
            show_error("MY_ERROR::MODULE_PRIVILEGE_NOT_DEFINED, " . "Privilege not defined!");
            die();
        }
    }

    protected function _module_is_auth() {
        $session = $this->session->userdata($this->session_login_name);
        if (!empty($session)) {
            $this->sys_user = $this->system_model->get_user_by_id($session);
            # get acl
            self::_get_acl_by_module(array($this->sys_user['user_id'], $this->sys_module['module_id']));
        }
        if ($this->is_need_auth) {
            if (!empty($this->sys_user)) {
                // define user login
                $this->is_auth = TRUE;
            } else {
                // not auth
                redirect($this->login_url);
            }
        }
    }

    protected function _module_is_autz() {
        if ($this->is_need_autz) {
            $this->is_autz = $this->system_model->is_autz(array($this->sys_user['user_id'], $this->app_id, $this->sys_module['module_id'], $this->sys_module['module_action_id']));
            if (count($this->is_autz) < 1) {
                show_error("MY_ERROR::ACCESS_CONTROL, " . "You haven't acess to this page!" . " Click <a href='" . base_url() . $this->logout_url . "'>here </a> to logout");
                die();
            }
        }
    }

    protected function _get_acl_by_module($params) {
        $acl = $this->system_model->get_acl_by_module($params);
        $this->acl = $acl;
    }

    // </editor-fold>
    //--------------------------------------------------------------------------
}
