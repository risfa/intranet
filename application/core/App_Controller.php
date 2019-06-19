<?php
/**
 * Created by PhpStorm.
 * User: arahman
 * Date: 2/9/17
 * Time: 4:28 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class App_Controller extends CI_Controller {
    var $template=array();
    var $data      = array();
    var $response      = array();
    public function __construct()
    {
        parent::__construct();
        $islogin=$this->session->userdata('is_login');
        if(!isset($islogin) || $islogin!=true){
            redirect('login');
        }
        $this->data['title']="";
        $this->data['subtitle']="";
        $this->data['breadcumb']=array();
        $this->data['menu']=array();
        $this->template['js']="";
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    public function renderAdmin($content,$gc=false)
    {
        $this->load->model('notifikasi_l');
        $this->data['user_id']=$this->session->userdata('user_user_id');
        $this->data['notif']=$this->notifikasi_l->getUnread($this->data['user_id']);
        $this->data['email']=$this->session->userdata('user_email');
        $this->data['nama']=$this->session->userdata('user_nama');
        $this->data['photo']=$this->session->userdata('user_photo');
        $this->data['jabatan']=$this->session->userdata('user_jabatan');
        $this->data['alamat']=$this->session->userdata('user_alamat');
        $this->data['telp']=$this->session->userdata('user_telp');
        $this->data['status_KTP']=$this->session->userdata('user_status_KTP');
        $this->data['status_intranet']=$this->session->userdata('user_status_intranet');
        $this->data['divisi']=$this->session->userdata('user_divisi');
        $this->data['divisi_id']=$this->session->userdata('user_divisi_id');
        $this->data['menu']=$this->session->userdata('menu');
        $this->template['header']   = $this->load->view('users/header', $this->data, true);
        $this->template['content'] = $this->load->view('users/'.$content, $this->data, true);
        $this->template['breadcumb'] = $this->load->view('users/breadcumb', $this->data, true);
        $this->template['sidemenu'] = $this->load->view('users/sidemenu', $this->data, true);
        $this->template['footer'] = $this->load->view('users/footer', $this->data, true);
        $this->template['gc'] = $gc;
//        $this->template['login'] = $this->data['login'];
        $this->load->view('users/index',$this->template);
    }
    public function jsonOutput(){
        echo json_encode($this->response);die;
    }
    public function loadJS($js){
        $this->template['js'] .= $this->load->view('js/users/'.$js, null, true);
    }
    public function addBreadcumb($name,$link){
        $bdata=array('name'=>$name,'link'=>$link);
        $this->data['breadcumb'][]=$bdata;
    }
}
