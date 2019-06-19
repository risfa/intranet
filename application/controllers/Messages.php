<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('notifikasi_l');
        $this->load->model('chat');
    }

    public function index()
    {
        $user_id=$this->session->userdata('user_user_id');
        $this->data['title']="Messages";
        $this->data['subtitle']="division & project chats";
        $this->data['group']=$this->chat->getAllGroup($user_id);
        $this->loadJS('chat');
        $this->renderAdmin('messages');
    }
    public function realtime(){
        $user_id=$this->session->userdata('user_user_id');
        $this->data['title']="Messages";
        $this->data['subtitle']="division & project chats";
        $this->data['group']=$this->chat->getAllGroup($user_id);
        $this->loadJS('new_chat');
        $this->renderAdmin('new_messages');
    }
    public function readNotif(){
        $user_id=$this->session->userdata('user_user_id');
        $this->response=$this->notifikasi_l->setReaded($user_id);
        $this->jsonOutput();
    }
    public function getMessages($cg_id=null){
        if(isset($cg_id)){
            $chats=$this->chat->getAllChat($cg_id);
            echo json_encode($chats);
        }
    }
    public function Send(){
        $data=array(
          'cg_id'=>$this->input->post('cg_id'),
          'user_id'=>$this->session->userdata('user_user_id'),
          'message_date'=>date('Y-m-d H:i:s'),
          'message'=>$this->input->post('message')
        );
        $this->response=$this->chat->sendChat($data,$this->input->post('cg_name'));
        $this->jsonOutput();
    }
}
