<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterUsers extends App_Controller {
    var $divisi="";
    var $company="";
    var $created_by="";
    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $this->divisi=$this->session->userdata('user_divisi_id');
        $this->company=$this->session->userdata('user_company_id');
        $this->user_id=$this->session->userdata('user_user_id');
        $this->created_by=$this->session->userdata('user_created_by');
        if($this->created_by=="su" || $this->created_by==5) {
            $crud = new grocery_CRUD();
            $crud->set_subject('user');
            $crud->set_table('user_m')->columns('email', 'nama', 'company_id', 'jabatan', 'divisi_id',  'created');
            $crud->where('user_m.user_id !=', $this->user_id);
            if ($this->divisi != 7) {
                $crud->where('user_m.divisi_id', $this->divisi);
                $crud->where('user_m.nama !=', $this->created_by);
            }

            $crud->display_as('company_id', 'Company')->display_as('divisi_id', 'Divisi');
            $crud->set_relation('company_id', 'company_m', 'nama');
            $crud->set_relation('divisi_id', 'divisi_m', 'divisi');
            if ($this->divisi != 7) {
                $crud->required_fields('email', 'nama', 'password', 'verify_password', 'jabatan');
                $crud->add_fields('email', 'nama', 'password', 'verify_password', 'telp', 'alamat', 'status_KTP', 'jabatan', 'status_intranet', 'created', 'created_by');
                $crud->edit_fields('email', 'nama', 'password', 'verify_password', 'telp', 'alamat', 'status_KTP', 'jabatan', 'status_intranet', 'created', 'created_by');
            } else {
                $crud->add_fields('email', 'nama', 'password', 'verify_password', 'company_id', 'telp', 'alamat', 'status_KTP', 'divisi_id', 'jabatan', 'status_intranet', 'created', 'created_by');
                $crud->edit_fields('email', 'nama', 'password', 'verify_password', 'company_id', 'telp', 'alamat', 'status_KTP', 'divisi_id', 'jabatan', 'status_intranet', 'created', 'created_by');
                $crud->required_fields('email', 'nama', 'company_id', 'divisi_id', 'password', 'verify_password', 'jabatan');
            }
            $crud->field_type('created_by', 'hidden', $this->session->userdata('user_user_id'));
            $crud->field_type('created', 'hidden', date('Y-m-d H:i:s'));
            $crud->field_type('last_update', 'hidden');
            $crud->field_type('password', 'password');
            $crud->field_type('verify_password', 'password');
            $crud->field_type('alamat', 'textarea');
            $crud->display_as('company_id', 'Company');
            $crud->display_as('divisi_id', 'Divisi');
            $crud->change_field_type('verify_password', 'password');
            $crud->callback_before_insert(array($this, 'unset_verification'));
            $crud->callback_before_update(array($this, 'unset_verification'));
            $crud->callback_edit_field('password', array($this, 'set_password_input_to_empty'));
            $crud->callback_add_field('password', array($this, 'set_password_input_to_empty'));
            $crud->callback_update(array($this, 'update_user'));
            $crud->callback_insert(array($this, 'insert_user'));
            $output = $crud->render();
            $this->data['title'] = "Master Users";
            $this->data['subtitle'] = "user maniplations";
            $this->data['output'] = $output->output;
            $this->data['css_files'] = $output->css_files;
            $this->data['js_files'] = $output->js_files;
            $this->renderAdmin('gcrud', true);
        }else{
            $this->data['title'] = "Master Users";
            $this->data['subtitle'] = "user maniplations";
            $this->renderAdmin('no_access', true);
        }
    }
    function unset_verification($post_array) {
        unset($post_array['verify_password']);
        return $post_array;
    }
    function set_password_input_to_empty() {
        return "<input type='password' name='password' value='' />";
    }
    function update_user($post_array, $primary_key) {
        unset($post_array['verify_password']);
        $post_array['password']=md5($post_array['password']);
        if($this->divisi!=7){
            $post_array['company_id']=$this->company;
            $post_array['divisi_id']=$this->divisi;
        }else{
            $post_array['created_by']='su';
        }
        return $this->db->update('user_m',$post_array,array('user_id' => $primary_key));
    }
    function insert_user($post_array) {
        unset($post_array['verify_password']);
        $post_array['password']=md5($post_array['password']);
        if($this->divisi!=7){
            $post_array['company_id']=$this->company;
            $post_array['divisi_id']=$this->divisi;
        }else{
            $post_array['created_by']='su';
        }
        return $this->db->insert('user_m',$post_array);
    }
}