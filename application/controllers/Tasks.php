<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_detail');
    }

    public function index()
    {

    }
    public function add($project_name)
    {
        $project_name=urldecode($project_name);
        $this->session->set_userdata('project_name',$project_name);
        $this->data['title']="Add update";
        $this->data['subtitle']="add update for ".$project_name;
        $this->data['project_name']=$project_name;
        $this->data['project_id']=$this->session->userdata('project_id');
        $this->session->set_userdata('project_id',$this->data['project_id']);
        $this->addBreadcumb($project_name,site_url('/Projects'));
        $this->loadJS('tasks');
        $this->renderAdmin('tasks');
    }
    public function saveEdit(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $status=$this->input->post('status');
        if($status=="Lainnya"){
            $this->form_validation->set_rules('status_lainnya', 'status', 'trim|required');
        }
        if($this->form_validation->run() != FALSE) {
            if($status=="Lainnya"){
                $status=$this->input->post('status_lainnya');
            }
            if(isset($_FILES['file'])){
                $config['upload_path']          = './assets/uploads/files/';
                $config['allowed_types']        = 'gif|jpg|png|xls|xlsx|ppt|pptx|doc|docx|psd|ai|aip|pdf';
                $config['max_size']             = 10240;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file'))
                {
                    $response['status']=false;
                    $response['message']=$this->upload->display_errors();
                }
                else
                {
                    $file =  $this->upload->data();
                    unlink('./assets/uploads/files/'.$this->input->post('old_file'));
                    $data=array(
                        'project_id'=>$this->input->post('project_id'),
                        'status'=>$status,
                        'share'=>$this->input->post('share'),
                        'file'=>$file['file_name'],
                        'desc'=>$this->input->post('desc')
                    );
                    $response=$this->Project_detail->saveDetailUpdate($data,$this->input->post('project_detail_id'));
                }
            }else{
                $data=array(
                    'project_id'=>$this->input->post('project_id'),
                    'status'=>$status,
                    'share'=>$this->input->post('share'),
                    'desc'=>$this->input->post('desc')
                );
                $response=$this->Project_detail->saveDetailUpdate($data,$this->input->post('project_detail_id'));
            }
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
    public function edit()
    {
        $project=$this->Project_detail->getDetail($this->session->userdata('project_detail_id'));
        $this->data['title']="Edit Update";
        $this->data['subtitle']="edit update for ".$project->project_name;
        $this->data['project_name']=$project->project_name;
        $this->data['file']=$project->file;
        $this->data['desc']=$project->desc;
        $this->data['status']=$project->status;
        $this->data['share']=$project->share;
        $this->data['project_detail_id']=$project->project_detail_id;
        $this->data['project_id']=$this->session->userdata('project_id');
        $this->session->set_userdata('project_id',$this->data['project_id']);
        $this->addBreadcumb($project->project_name,site_url('/Projects'));
        $this->loadJS('edit_task');
        $this->renderAdmin('edit_task');
    }
    public function save(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $status=$this->input->post('status');
        if($status=="Lainnya"){
            $this->form_validation->set_rules('status_lainnya', 'status', 'trim|required');
        }
        if($this->form_validation->run() != FALSE) {
            if($status=="Lainnya"){
                $status=$this->input->post('status_lainnya');
            }
            if(isset($_FILES['file'])){
                $config['upload_path']          = './assets/uploads/files/';
                $config['allowed_types']        = 'gif|jpg|png|xls|xlsx|ppt|pptx|doc|docx|psd|ai|aip|pdf';
                $config['max_size']             = 10240;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file'))
                {
                    $response['status']=false;
                    $response['message']=$this->upload->display_errors();
                }
                else
                {
                    $file =  $this->upload->data();
                    $data=array(
                        'project_id'=>$this->input->post('project_id'),
                        'status'=>$status,
                        'file'=>$file['file_name'],
                        'desc'=>$this->input->post('desc'),
                        'share'=>$this->input->post('share'),
                        'create_by'=>$this->session->userdata('user_user_id'),
                        'created'=>date('Y-m-d H:i:s')
                    );
                    $response=$this->Project_detail->saveDetail($data);
                }
            }else{
                $data=array(
                    'project_id'=>$this->input->post('project_id'),
                    'status'=>$status,
                    'desc'=>$this->input->post('desc'),
                    'share'=>$this->input->post('share'),
                    'create_by'=>$this->session->userdata('user_user_id'),
                    'created'=>date('Y-m-d H:i:s')
                );
                $response=$this->Project_detail->saveDetail($data);
            }
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
    public function setActiveTask($project_detail_id){
        $this->session->set_userdata('project_detail_id',$project_detail_id);
    }
}
