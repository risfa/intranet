<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends App_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('project');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function index()
    {
        $this->data['title']="Dashboard";
        $this->data['projects'] = $this->project->getAllDashboard();
        $this->data['notifs'] = $this->project->getNotif($this->session->userdata('user_user_id'));
        $this->data['updates'] = $this->project->homeUpdate($this->session->userdata('user_user_id'));
        $this->data['subtitle']="summary & report";
        $this->data['login']= $this->session->userdata('first_login');
        $this->session->unset_userdata('first_login');
        $this->loadJS('home');
        $this->renderAdmin('home');
    }

    
}
