<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meetings extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project');
        $this->load->model('user');
        $this->load->model('meeting');
    }

    public function index()
    {
        $this->data['projects'] = $this->project->getAll();
        $this->data['users'] = $this->user->getAllName();
        $this->data['title']="Meetings";
        $this->data['subtitle']="schedule meetings";
        $this->loadJS('meetings');
        $this->renderAdmin('meetings');
    }
    public function saveMeeting() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('project_id', 'Project', 'trim|required');
        $this->form_validation->set_rules('meeting_desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('meeting_date', 'Date', 'trim|required');
        $this->form_validation->set_rules('meeting_member', 'Member', 'trim|required');
        if($this->form_validation->run() != FALSE) {
            $data["project_id"] = $this->input->post('project_id');
            $data["desc"] = $this->input->post('meeting_desc');
            $data["meeting_date"] = $this->input->post('meeting_date');
            $data["created"] = date("Y-m-d H:i:s");
            $data["create_by"] = $this->session->userdata("user_user_id");
            $dataDetail = explode(",",$this->input->post('meeting_member'));
            $response = $this->meeting->addMeeting($data,$dataDetail);
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
    public function getMeetings(){
        $response=array();
        $meetings= $this->meeting->getAll();
        foreach($meetings as $m){
            $start=date('Y-m-d H:i:s',strtotime($m->start));
            $new_event=array(
                'id'=>$m->meeting_id,
                'title'=>$m->title,
                'allDay'=>TRUE,
                'start'=> $start
            );
            $response[]=$new_event;
        }
        echo json_encode($response);
    }
    public function detailMeeting($meeting_id){
        $detail=$this->meeting->get($meeting_id);
        $this->data['detail']=$detail;
        $this->data['user_id']=$this->session->userdata('user_user_id');
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
        $this->load->view('users/dm_modal',$this->data);
    }
}
