<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterDivisi extends App_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_subject('divisi');
        $crud->set_table('divisi_m')->columns('divisi_id','divisi');
        $crud->required_fields('divisi');
        $crud->add_fields('divisi');
        $crud->edit_fields('divisi');
        $crud->callback_after_insert(array($this, 'create_group'));
        $output = $crud->render();
        $this->data['title']="Master Divisi";
        $this->data['subtitle']="user operations";
        $this->data['output']=$output->output;
        $this->data['css_files']=$output->css_files;
        $this->data['js_files']=$output->js_files;
        $this->renderAdmin('gcrud',true);
    }
    function create_group($post_array,$primary_key)
    {
        $group = array(
            "divisi_id" => $primary_key
        );
        $this->db->insert('chatgroup_ml',$group);
        return true;
    }
}