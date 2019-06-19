<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Model {
        function getAll(){
                $user_id=$this->session->userdata('user_user_id');
                $divisi=$this->session->userdata('user_divisi_id');
                if($divisi!=7) {
                    $this->db->where('user_id =', $user_id);
                }
                $this->db->where('enabled =','Y');
                // $this->db->where('project_status !=','complete');
                $this->db->or_where('create_by =', $user_id);
                $this->db->group_by('project_id');
                $this->db->order_by('created','desc');
                $project=$this->db->get('userproject_v');
                if($project->num_rows()>0){
                    return $project->result();
                }else{
                    return array();
                }
        }
        function getAllPicByCompanyId($clientid){
                // $user_id=$this->session->userdata('user_user_id');
                // $divisi=$this->session->userdata('user_divisi_id');
                // if($divisi!=7) {
                //     $this->db->where('user_id =', $user_id);
                // }
                // $this->db->where('enabled =','Y');
                // // $this->db->where('project_status !=','complete');
                // $this->db->or_where('create_by =', $user_id);
                // $this->db->group_by('project_id');
                // $this->db->order_by('created','desc');
                $this->db->where('client_id',$clientid);
                $project=$this->db->get('client_d');
                if($project->num_rows()>0){
                    return $project->result();
                }else{
                    return array();
                }
        }
        function getAllDashboard(){
                $user_id=$this->session->userdata('user_user_id');
                $divisi=$this->session->userdata('user_divisi_id');
                if($divisi!=7) {
                    $this->db->where('user_id =', $user_id);
                }
                $this->db->where('enabled =','Y');
                $this->db->where('project_status !=','complete');
                $this->db->or_where('create_by =', $user_id);
                $this->db->group_by('project_id');
                $this->db->order_by('created','desc');
                $project=$this->db->get('userproject_v');
                if($project->num_rows()>0){
                    return $project->result();
                }else{
                    return array();
                }
        }
        function homeUpdate($home_id){
            $divisi=$this->session->userdata('user_divisi_id');
            if($divisi!=7) {
                $this->db->where('home_id', $home_id);
            }
            $this->db->limit(50,0);
            $this->db->group_by('project_detail_id');
            $update=$this->db->get('homeupdate_v');
            if($update->num_rows()>0){
                return $update->result();
            }else{
                return array();
            }
        }
        function getNotif($user_id){
            $divisi=$this->session->userdata('user_divisi_id');
            if($divisi!=7) {
                $this->db->where('user_id', $user_id);
            }
            $this->db->limit(50,0);
            $this->db->order_by("notifikasi_date", "desc");
            $this->db->group_by("notifikasi_date");
            $notif=$this->db->get('notif_l');
            if($notif->num_rows()>0){
                return $notif->result();
            }else{
                return array();
            }
        }
		function getProjectById($id) {
			$this->db->where("project_id",$id);
			$projectById = $this->db->get('project_v');
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
		
		function addProject($data,$detail) {
            $this->load->model('notifikasi_l');
            $return = array();
			$this->db->trans_start();
			$this->db->insert("project_m",$data);
			$inserted_id = $this->db->insert_id();
            $this->db->insert('chatgroup_ml',array("project_id"=>$inserted_id));
            $counter=rand(0,100);
            $myid=$this->session->userdata('user_user_id');
			foreach($detail as $v) {
				$this->db->set("project_id",$inserted_id);
				$this->db->set("user_id",$v);
				$this->db->insert("team_project");
                if($v!=$myid) {
                    $notif = array(
                        'notifikasi_id' => 'PJ'. uniqid(),
                        'notifikasi_isi' => 'you got new project',
                        'notifikasi_link' => site_url('/Projects'),
                        'notifikasi_date' => date('Y-m-d H:i:s'),
                        'user_id' => $v
                    );
                    $this->notifikasi_l->addNotif($notif);
                }
                $counter++;
			}
            $this->db->where('divisi_id',7);
            $su=$this->db->get('user_m');
            foreach ($su->result() as $t){
                if($t->user_id!=$myid) {
                    $notif = array(
                        'notifikasi_id' => 'PJ'. uniqid(),
                        'notifikasi_isi' => 'you got new project',
                        'notifikasi_link' => site_url('/Projects'),
                        'notifikasi_date' => date('Y-m-d H:i:s'),
                        'user_id' =>$t->user_id
                    );
                    $this->notifikasi_l->addNotif($notif,false);
                    $counter++;
                }
            }
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE) {
				$return["status"] = false;
				$return["message"] = "Failed insert DB";
			} else {
				$return["status"] = true;
				$return["message"] = "ok";
				$return["project_id"] =$inserted_id;
			}
			return $return;
		}
		function editProject($data,$detail,$project_id) {
			$return = array();
			$this->db->trans_start();
            $this->db->where("project_id",$project_id);
			$this->db->update("project_m",$data);
			foreach($detail as $v) {
				$this->db->where("project_id",$project_id);
				$this->db->where("user_id",$v);
				$team=$this->db->get('team_project');
				if($team->num_rows()<=0){
                    $this->db->set("project_id",$project_id);
                    $this->db->set("user_id",$v);
                    $this->db->insert("team_project");

                }
			}
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE) {
				$return["status"] = false;
				$return["message"] = "Failed update DB";
			} else {
				$return["status"] = true;
				$return["message"] = "ok";
			}
			return $return;
		}
		function addMember($data,$project_id){
            $this->db->trans_start();
            foreach($data as $v) {
                $this->db->where('project_id',$project_id);
                $this->db->where('user_id',$v);
                $check=$this->db->get('team_project');
                if($check->num_rows()<=0){
                    $this->db->set("project_id",$project_id);
                    $this->db->set("user_id",$v);
                    $this->db->insert("team_project");
                }
            }
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE) {
                $return["status"] = false;
                $return["message"] = "Failed insert Team";
            } else {
                $return["status"] = true;
                $return["message"] = "ok";
            }
            return $return;
        }
		function deleteProject($project_id){
            $this->db->where('project_id',$project_id);
            $delete=$this->db->update('project_m',array('enabled'=>'N','status'=>'archive'));
            if($delete){
                $return["status"] = true;
                $return["message"] = "project deleted";
            }else{
                $return["status"] = false;
                $return["message"] = "failed to delete project";
            }
            return $return;
        }
        function deleteDetailProject($project_detail_id){
            $this->db->where('project_detail_id',$project_detail_id);
            $delete=$this->db->update('project_d',array('enabled'=>'N'));
            if($delete){
                $return["status"] = true;
                $return["message"] = "detail project deleted";
            }else{
                $return["status"] = false;
                $return["message"] = "failed to delete detail project";
            }
            return $return;
        }
        function approveDetailProject($project_detail_id){
            $this->db->where('project_detail_id',$project_detail_id);
            $delete=$this->db->update('project_d',array('status'=>'Completed'));
            if($delete){
                $return["status"] = true;
                $return["message"] = "detail project approve";
            }else{
                $return["status"] = false;
                $return["message"] = "failed to approve detail project";
            }
            return $return;
        }
        function rejectDetailProject($project_detail_id){
            $this->db->where('project_detail_id',$project_detail_id);
            $delete=$this->db->update('project_d',array('status'=>'Rejected'));
            if($delete){
                $return["status"] = true;
                $return["message"] = "detail project reject";
            }else{
                $return["status"] = false;
                $return["message"] = "failed to reject detail project";
            }
            return $return;
        }

        function picId ($client_id){
            $this->db->where('client_id',$client_id);
            $search = $this->db->get('client_d')->result_array();


            // if($search){
            //     $return["status"] = true;
            //     $return["message"] = "detail project reject";
            // }else{
            //     $return["status"] = false;
            //     $return["message"] = "failed to reject detail project";
            // }
            return $search;
        }

         function getPicId ($project_id){
            $this->db->where('client_id',$project_id);
            $search = $this->db->get('client_m');

            if($search){
                $return["status"] = true;
                $return["message"] = "detail project reject";
            }else{
                $return["status"] = false;
                $return["message"] = "failed to reject detail project";
            }
            return $search;
        }

}
