<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterClientM extends App_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_subject('client company');
        $crud->set_table('client_m')->columns('client_id','client_name','alamat','telp','created','created_by','last_update');
        $crud->set_relation('created_by','user_m','nama');
        $crud->required_fields('client_name','alamat','telp');
        $crud->display_as('client_name', 'Company');
        $crud->field_type('created_by', 'hidden',$this->session->userdata('user_user_id'));
        $crud->field_type('created', 'hidden',date('Y-m-d H:i:s'));
        $crud->add_fields('client_name','alamat','telp','status_pajak','created','created_by');
        $crud->edit_fields('client_name','alamat','telp','status_pajak','created','created_by');
        $crud->field_type('alamat', 'textarea');
        $output = $crud->render();
        $this->data['title']="Master Client Company";
        $this->data['subtitle']="client company list";
        $this->data['output']=$output->output;
        $this->data['css_files']=$output->css_files;
        $this->data['js_files']=$output->js_files;
        $this->renderAdmin('gcrud',true);
    }
}