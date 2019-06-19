<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client');
        $this->load->model('project');
        $this->load->model('user');
        $this->load->model('notifikasi_l');
    }

    public function index($id=null)
    {

    	if(empty($id)){
            redirect('/Projects/index/80');
                    // $this->data['id'] = 12;
        }
        $this->data['clients']=$this->client->getAll();
        // $this->data['clients_pic']=$this->project->getAllPicByCompanyId();
        $this->data['projects'] = $this->project->getAll();
        $this->data['users'] = $this->user->getAllName();
        $this->data['title']="Projects";
        $this->data['subtitle']="projects directory";
        $this->data['id'] = $id;
        $this->loadJS('projects');
        $this->renderAdmin('projects');
    }



    public function getProject() {
        $id = $_POST["id"];
        $this->session->set_userdata('project_id',$id);
        $projectById = $this->project->getProjectById($id);
        $data["data"] = $projectById;
        $projectID=$this->session->userdata('project_id');
        if(isset($projectID)){
            $data["team"] = $this->project->getTeamProject($projectID);
            $data["file"] = $this->project->getFileProject($projectID);
        }else {
            $data["team"] = $this->project->getTeamProject($projectById[0]->project_id);
            $data["file"] = $this->project->getFileProject($projectById[0]->project_id);
        }
        echo json_encode($data);
    }
	public function getDetail(){
        $id = $_POST["id"];
        $page = $_POST["page"];
        $limit=($page-1)*5;
        $data["detail"] = $this->project->getDetailProject($id,$limit);
        echo json_encode($data);
    }
    public function addProject() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('client', 'Client', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('leader', 'Leader', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('team', 'Team', 'trim|required');
        if($this->form_validation->run() != FALSE) {
            $data["client_id"] = $this->input->post('client');
            $data["project_name"] = $this->input->post('name');
            $data["project_leader"] = $this->input->post('leader');
            $data["project_status"] = $this->input->post('status');
            $data["desc"] = $this->input->post('desc');
            $data["created"] = date("Y-m-d H:i:s");
            $data["create_by"] = $this->session->userdata("user_user_id");
            $data["pic_id"] = $this->input->post("client_pic");
            $dataDetail = explode(",",$this->input->post('team'));
            $response = $this->project->addProject($data,$dataDetail);
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
    public function editProject() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('project_client', 'Client', 'trim|required');
        $this->form_validation->set_rules('project_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('project_leader', 'Leader', 'trim|required');
        $this->form_validation->set_rules('project_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('project_desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('project_team', 'Team', 'trim|required');
        if($this->form_validation->run() != FALSE) {
            $data["client_id"] = $this->input->post('project_client');
            $data["project_name"] = $this->input->post('project_name');
            $data["project_leader"] = $this->input->post('project_leader');
            $data["project_status"] = $this->input->post('project_status');
            $data["desc"] = $this->input->post('project_desc');
            $dataDetail = explode(",",$this->input->post('project_team'));
            $response = $this->project->editProject($data,$dataDetail,$this->input->post('project_id'));
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
    public function addMember(){
        $this->load->library('form_validation');
        $project_id=$this->input->post('project_id');
        $this->form_validation->set_rules('team', 'Team', 'trim|required');
        if($this->form_validation->run() != FALSE) {
            $teams = explode(",",$this->input->post('team'));
            $response = $this->project->addMember($teams,$project_id);
        }else{
            $response['status']=false;
            $response['message']=strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    function deleteProject($project_id){
	    $response= $this->project->deleteProject($project_id);
	    echo json_encode($response);
    }
    function deleteDetailProject($project_detail_id){
	    $response= $this->project->deleteDetailProject($project_detail_id);
	    echo json_encode($response);
    }
    function approveDetailProject($project_detail_id){
        $response= $this->project->approveDetailProject($project_detail_id);
        if($response['status']){
            $notif = array(
                'notifikasi_id' => 'A'.uniqid(),
                'notifikasi_isi' => 'your update was approved in '.$_GET['project_name'],
                'notifikasi_link' => site_url('/Meetings'),
                'notifikasi_date' => date('Y-m-d H:i:s'),
                'user_id' =>$_GET['to']
            );
            $this->notifikasi_l->addNotif($notif);
        }
        echo json_encode($response);
    }
    function rejectDetailProject($project_detail_id){
        $response= $this->project->rejectDetailProject($project_detail_id);
        if($response['status']){
            $notif = array(
                'notifikasi_id' => 'R'.uniqid(),
                'notifikasi_isi' => 'your rejected was approved in '.$_GET['project_name'],
                'notifikasi_link' => site_url('/Meetings'),
                'notifikasi_date' => date('Y-m-d H:i:s'),
                'user_id' =>$_GET['to']
            );
            $this->notifikasi_l->addNotif($notif);
        }
        echo json_encode($response);
    }

    public function picId($client_id)
    {
        $var = $this->project->picId($client_id);
        echo json_encode($var);

    }


}
