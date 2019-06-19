<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_detail extends CI_Model {
    function saveDetail($data){
        $this->load->model('notifikasi_l');
        $username=$this->session->userdata('user_nama');
        $myid=$this->session->userdata('user_user_id');
        $this->db->where('project_id',$data['project_id']);
        $select=$this->db->get('project_m');
        $project=$select->row();
        $text=$username.' add an update to '.$project->project_name;
        $link=site_url('/Projects');
        $this->db->where('project_id',$data['project_id']);
        $team=$this->db->get('team_project');
        if($team->num_rows()>0){
            $counter=rand(0,100);
            foreach ($team->result() as $t){
                if($t->user_id!=$myid) {
                    $notif = array(
                        'notifikasi_id' => 'PD'.uniqid(),
                        'notifikasi_isi' => $text,
                        'notifikasi_link' => $link,
                        'notifikasi_date' => date('Y-m-d H:i:s'),
                        'user_id' => $t->user_id
                    );
                    $this->notifikasi_l->addNotif($notif);
                    $counter++;
                }
            }
        }
        $this->db->where('divisi_id',7);
        $su=$this->db->get('user_m');
        foreach ($su->result() as $t){
            if($t->user_id!=$myid) {
                $notif = array(
                    'notifikasi_id' => 'PD'.uniqid(),
                    'notifikasi_isi' => $text,
                    'notifikasi_link' => $link,
                    'notifikasi_date' => date('Y-m-d H:i:s'),
                    'user_id' =>$t->user_id
                );
                $this->notifikasi_l->addNotif($notif,false);
                $counter++;
            }
        }
        $insert=$this->db->insert('project_d',$data);
        if($insert){
            $response['status']=true;
            $response['message']="project detail inserted";
        }else{
            $response['status']=false;
            $response['message']="Failed to insert detail";
        }
        return $response;
    }
    function saveDetailUpdate($data,$project_detail_id){
        $this->db->where('project_detail_id',$project_detail_id);
        $update=$this->db->update('project_d',$data);
        if($update){
            $response['status']=true;
            $response['message']="project detail updated";
        }else{
            $response['status']=false;
            $response['message']="Failed to update detail";
        }
        return $response;
    }
    function deleteDetailProject($project_detail_id){
        $this->db->where('project_detail_id',$project_detail_id);
        $delete=$this->db->update('project_d',array('enabled'=>'N'));
        if($delete){
            $return["status"] = true;
            $return["message"] = "project detail deleted";
        }else{
            $return["status"] = false;
            $return["message"] = "failed to delete detail project";
        }
        return $return;
    }
    function getDetail($project_detail_id){
        $this->db->where('project_detail_id',$project_detail_id);
        $project_detail=$this->db->get('detailproject_v');
        if($project_detail->num_rows()>0){
            return $project_detail->row();
        }else{
            return array();
        }
    }
}
