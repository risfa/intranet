<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArchiveProjects extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client');
        $this->load->model('archiveproject');
        $this->load->model('user');
        $this->load->model('notifikasi_l');
    }

    public function index($year=null)
    {
        if(empty($year)){
            $year=date('Y');
        }
        $this->data['clients']=$this->client->getAll();
        $this->data['projects'] = $this->archiveproject->getAll($year);
        $this->data['users'] = $this->user->getAllName();
        $this->data['year']=$year;
        $this->data['title']="Archive Projects";
        $this->data['subtitle']="Deleted/Completed projects directory";
        $this->loadJS('archiveprojects');
        $this->renderAdmin('archiveprojects');
    }

    public function getProject() {
        $id = $_POST["id"];
        $this->session->set_userdata('project_id',$id);
        $projectById = $this->archiveproject->getProjectById($id);
        $data["data"] = $projectById;
        $projectID=$this->session->userdata('project_id');
        if(isset($projectID)){
            $data["team"] = $this->archiveproject->getTeamProject($projectID);
            $data["file"] = $this->archiveproject->getFileProject($projectID);
        }else {
            $data["team"] = $this->archiveproject->getTeamProject($projectById[0]->project_id);
            $data["file"] = $this->archiveproject->getFileProject($projectById[0]->project_id);
        }
        echo json_encode($data);
    }
    public function getDetail(){
        $id = $_POST["id"];
        $page = $_POST["page"];
        $limit=($page-1)*5;
        $data["detail"] = $this->archiveproject->getDetailProject($id,$limit);
        echo json_encode($data);
    }
}
