<?php

/**
 * Description of Application
 *
 * @author ekoaprianto
 */
class SysApplicationController extends Application_system
{

    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('m_application');
        // load library
        $this->load->library('mynotification');
        $this->load->library('mypagination');
    }

    public function index()
    {
        /* Start Pagination */
        $config['total_rows'] = $this->m_application->get_total_rows();
        /* End Pagination */
        $data['per_page'] = $this->mypagination->get_per_page();
        $data['total_rows'] = $config['total_rows'];
        $data['no'] = 1;
        $data['rs_id'] = $this->m_application->get_all();
        $data['url_search'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/search_process';
        $data['url_add'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/add';
        $data['url_detail'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/detail';
        $data['url_edit'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/edit';
        $data['url_delete'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/delete_process';
        $data['list_application'] = $this->m_application->get_list();
        // notification
        $data['notification'] = $this->mynotification->display_notification();
        // display
        parent::display('list', $data);
    }

    public function search_process()
    {
        if ($this->input->post('save') === 'reset') {
            $this->session->unset_userdata('search_application');
        } else {
            $params = array(
                'search_type' => $this->input->post('search_type'),
                's_keyword' => $this->input->post('s_keyword'),
                'dept_parent_id' => $this->input->post('dept_parent_id'),
                'dept_code' => $this->input->post('dept_code'),
                'dept_name' => $this->input->post('dept_name'),
                'dept_desc' => $this->input->post('dept_desc'),
                'dept_order' => $this->input->post('dept_order')
            );
            $this->session->set_userdata('search_application', $params);
        }
        redirect('sys_application/' . $this->router->fetch_class() . '/index');
    }

    public function add()
    {
        $data['form_label'] = 'Add Application';
        $data['list_application'] = $this->m_application->get_list();
        $data['url_action'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/add_process';
        $data['result'] = !empty($this->mynotification->display_last_field()) ? $this->mynotification->display_last_field() : array();
        // notification
        $data['notification'] = $this->mynotification->display_notification();
        // display
        parent::display('add', $data);
    }

    public function add_process()
    {
        $this->mynotification->set_rules('dept_id', 'Application ID', 'trim');
        $this->mynotification->set_rules('dept_code', 'Application Code', 'trim');
        $this->mynotification->set_rules('dept_name', 'Application Name', 'trim|required');
        $this->mynotification->set_rules('dept_parent_id', 'Parent', 'trim|required');
        $this->mynotification->set_rules('dept_desc', 'Description', 'trim');
        $this->mynotification->set_rules('dept_order', 'Order', 'trim');
        if ($this->mynotification->run() !== FALSE) {
            $params = array(
                'dept_parent_id' => $this->input->post('dept_parent_id'),
                'dept_code' => $this->input->post('dept_code'),
                'dept_name' => $this->input->post('dept_name'),
                'dept_desc' => $this->input->post('dept_desc'),
                'dept_order' => $this->input->post('dept_order'),
                'user_id' => '1'
            );
            if ($this->m_application->insert($params)) {
                // success
                $this->mynotification->sent_notification('success', 'Data add successfully');
            } else {
                // error
                $this->mynotification->sent_notification('error', 'Data add failed!');
            }
        } else {
            // error
            $this->mynotification->sent_notification('error', 'Data add failed!');
        }
        // default redirect
        redirect('sys_application/' . $this->router->fetch_class() . '/add');
    }

    public function detail($id = '')
    {
        $data['form_label'] = 'Detail Application';
        $data['url_action'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/edit_process';
        $data['result'] = $this->m_application->get_data_by_id(array($id));
        // display
        parent::display('detail', $data);
    }

    public function edit($id = '')
    {
        $data['form_label'] = 'Edit Application';
        $data['list_application'] = $this->m_application->get_list();
        $data['url_action'] = site_url() . '/sys_application/' . $this->router->fetch_class() . '/edit_process';
        $data['result'] = !empty($this->mynotification->display_last_field()) ? $this->mynotification->display_last_field() : $this->m_application->get_data_by_id(array($id));
        // notification
        $data['notification'] = $this->mynotification->display_notification();
        // display
        parent::display('edit', $data);
    }

    public function edit_process()
    {
        $this->mynotification->set_rules('dept_id', 'Application ID', 'trim|required');
        $this->mynotification->set_rules('dept_parent_id', 'Parent', 'trim|required');
        $this->mynotification->set_rules('dept_code', 'Application Code', 'trim');
        $this->mynotification->set_rules('dept_name', 'Application Name', 'trim|required');
        $this->mynotification->set_rules('dept_desc', 'Description', 'trim');
        $this->mynotification->set_rules('dept_order', 'Order', 'trim');
        if ($this->mynotification->run() !== FALSE) {
            $params = array(
                'dept_parent_id' => $this->input->post('dept_parent_id'),
                'dept_code' => $this->input->post('dept_code'),
                'dept_name' => $this->input->post('dept_name'),
                'dept_desc' => $this->input->post('dept_desc'),
                'dept_order' => $this->input->post('dept_order'),
                'user_id' => '1',
                'dept_id' => $this->input->post('dept_id')
            );
            if ($this->m_application->update($params)) {
                // success
                $this->mynotification->sent_notification('success', 'Data edit successfully');
            } else {
                // error
                $this->mynotification->sent_notification('error', 'Data edit failed!');
            }
        } else {
            // error
            $this->mynotification->sent_notification('error', 'Data edit failed!');
        }
        // default redirect
        redirect('sys_application/' . $this->router->fetch_class() . '/edit/' . $this->input->post('dept_id'));
    }

    public function delete_process($id)
    {
        if ($id) {
            $params = array(
                'dept_id' => $id
            );
            if ($this->m_application->delete($params)) {
                // success
                $this->mynotification->sent_notification('success', 'Data deleted successfully');
            } else {
                // error
                $this->mynotification->sent_notification('error', 'Data deleted failed!');
            }
        } else {
            // error
            $this->mynotification->sent_notification('error', 'Data deleted failed!');
        }
        // default redirect
        redirect('sys_application/' . $this->router->fetch_class() . '/index/');
    }

}
