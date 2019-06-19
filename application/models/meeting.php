<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meeting extends CI_Model {
    function addMeeting($data,$detail) {
        $this->load->model('notifikasi_l');
        $return = array();
        $this->db->trans_start();
        $this->db->insert("meeting_m",$data);
        $inserted_id = $this->db->insert_id();
        $myid=$this->session->userdata('user_user_id');
        $counter=rand(0,100);
        foreach($detail as $v) {
            $this->db->set("meeting_id",$inserted_id);
            $this->db->set("user_id",$v);
            $this->db->insert("meeting_team");
            if($v!=$myid) {
                $notif = array(
                    'notifikasi_id' => 'MT'.uniqid(),
                    'notifikasi_isi' => 'you have invited in meeting '.$data['desc'],
                    'notifikasi_link' => site_url('/Meetings'),
                    'notifikasi_date' => date('Y-m-d H:i:s'),
                    'user_id' =>$v
                );
                $this->notifikasi_l->addNotif($notif);
                $counter++;
            }
        }
        $this->db->where('divisi_id',7);
        $su=$this->db->get('user_m');
        foreach ($su->result() as $t){
            if($t->user_id!=$myid) {
                $notif = array(
                    'notifikasi_id' => 'MT'.uniqid(),
                    'notifikasi_isi' => 'you have invited in meeting '.$data['desc'],
                    'notifikasi_link' => site_url('/Meetings'),
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
        }
        return $return;
    }
    function getAll(){
        $user_id=$this->session->userdata('user_user_id');
        $divisi=$this->session->userdata('user_divisi_id');
        $this->db->where('start >=',date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s').' -2d')));
        if($divisi!=7) {
            $this->db->where('user_id =', $user_id);
        }
        $this->db->or_where('create_by =', $user_id);
        $this->db->group_by('meeting_id');
        $meeting=$this->db->get('meetingcalender_v');
        if($meeting->num_rows()>0){
            return $meeting->result();
        }else{
            return array();
        }
    }
    function get($meeting_id){
        $this->db->where('meeting_id',$meeting_id);
        $meeting=$this->db->get('meetingcalender_v');
        if($meeting->num_rows()>0){
            $return=array();
            $return['detail']=$meeting->row();
            $return['team']=$meeting->result();
            return $return;
        }else{
            return false;die;
        }
    }
}