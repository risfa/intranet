<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends App_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }
    public function index($user_id=null){
        if(empty($user_id)){
            redirect('/home');
        }
        $this->data['title']="User Profile";
        $this->data['subtitle']="user information";
        $this->data['detail']=$this->user->getProfile($user_id);
        $this->renderAdmin('profile');
    }
}

