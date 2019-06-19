<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterMenu extends App_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_subject('menu');
        $crud->set_table('menu_l')->columns('menu_id','menu_title','menu_icon','menu_link','access_level');
        $crud->set_relation('access_level','divisi_m','divisi');
        $crud->required_fields('menu_title','menu_icon','menu_link','access_level');
        $crud->add_fields('menu_title','menu_icon','menu_link','access_level');
        $crud->edit_fields('menu_title','menu_icon','menu_link','access_level');
        $output = $crud->render();
        $this->data['title']="Master Menu";
        $this->data['subtitle']="Access for divisions";
        $this->data['output']=$output->output;
        $this->data['css_files']=$output->css_files;
        $this->data['js_files']=$output->js_files;
        $this->renderAdmin('gcrud',true);
    }
}