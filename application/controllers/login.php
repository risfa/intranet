<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function index()
    {
        $this->load->view('login',array('error'=>null));
        $islogin=$this->session->userdata('is_login');
         if(isset($islogin) && $islogin==true){
            redirect('home');
        }
    }
    public function process(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Email', 'valid_email|trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() != FALSE) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $response = $this->user->login($username, $password);
            if ($response['status']) {
                $this->session->set_userdata('is_login',true);
                foreach ($response['data'] as $k => $v) {
                    $this->session->set_userdata('user_' . $k, $v);
                }
                $this->session->set_userdata('menu',$response['menu']);
                $this->session->set_userdata('first_login','Dear All , Mohon untuk mengganti kata sandi default untuk menjaga keamanan !');
                // redirect(site_url().'/logisssn');
            }
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
         echo json_encode($response);
    }
    public function logout(){
        // $this->session->sess_destroy();
        // redirect("/login");
        // echo "<script>alert('Asd')</script>";
        echo "TEST";
		// $this->load->view('login');
    }
}
