<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArchiveProject extends CI_Model {
    function getAll($year){
        $this->db->where('project_status','complete');
        $this->db->like('created',$year);
        // $this->db->where('created >=',$year.'-01-01 00:00:00');
        // $this->db->where('created <=',date('Y-m-d H:i:s',strtotime(date($year.'-01-01 00:00:00').' +1year')));
        $this->db->group_by('project_id');
        $this->db->order_by('created','desc');
        $project=$this->db->get('project_m');
        if($project->num_rows()>0){
            return $project->result();
        }else{
            return array();
        }
    }


    function getProjectById($id) {
        $this->db->where("project_id",$id);
        $this->db->from('project_m');
        $this->db->join('client_m', 'project_m.client_id = client_m.client_id');
        $projectById = $this->db->get();
        if($projectById->num_rows() > 0) {
            return $projectById->result();
        } else {
            return array();
        }
    }

    function getTeamProject($id) {
        $this->db->where("project_id",$id);
        $projectById = $this->db->get('teamproject_v');
        if($projectById->num_rows() > 0) {
            return $projectById->result();
        } else {
            return array();
        }
    }
    function getFileProject($id) {
        $this->db->where("project_id",$id);
        $projectById = $this->db->get('fileproject_v');
        if($projectById->num_rows() > 0) {
            return $projectById->result();
        } else {
            return array();
        }
    }
    function getDetailProject($id,$limit=0) {
        $this->db->where("project_id",$id);
        $this->db->limit(5,$limit);
        $projectById = $this->db->get('detailproject_v');
        if($projectById->num_rows() > 0) {
            return $projectById->result();
        } else {
            return array();
        }
    }
}
