<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterClientD extends App_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_subject('client');
        $crud->set_table('client_d')->columns('client_detail_id','client_id','nama','email','telp','jabatan','created','created_by','last_update');
        $crud->set_relation('created_by','user_m','nama');
        $crud->set_relation('client_id','client_m','client_name');
        $crud->display_as('client_id', 'Company');
        $crud->field_type('created_by', 'hidden',$this->session->userdata('user_user_id'));
        $crud->field_type('created', 'hidden',date('Y-m-d H:i:s'));
        $crud->required_fields('client_id','nama','email','telp','jabatan');
        $crud->add_fields('client_id','nama','email','telp','jabatan','created','created_by');
        $crud->edit_fields('client_id','nama','email','telp','jabatan','created','created_by');
        $output = $crud->render();
        $this->data['title']="Master Client Detail";
        $this->data['subtitle']="detail client";
        $this->data['output']=$output->output;
        $this->data['css_files']=$output->css_files;
        $this->data['js_files']=$output->js_files;
        $this->renderAdmin('gcrud',true);
    }
}