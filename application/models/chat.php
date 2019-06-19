<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Model {
    function getAllGroup($user_id){
        $divisi=$this->session->userdata('user_divisi_id');
        if($divisi!=7) {
            $this->db->where('user_id', $user_id);
        }
        $this->db->group_by('cg_id');
        $cg=$this->db->get('chatgroup_v');
        if($cg->num_rows()>0){
            return $cg->result();
        }else{
            return array();
        }
    }
    function getAllChat($cg_id){
        $this->db->where('cg_id',$cg_id);
        $cg=$this->db->get('chatdetail_v');
        if($cg->num_rows()>0){
            return $cg->result();
        }else{
            return array();
        }
    }
    function sendChat($data,$cg_name){
        $this->load->model('notifikasi_l');
        $notifM='you got new message in '.$cg_name;
        $link=site_url('/Messages');
        $insert=$insert=$this->db->insert('chat_l',$data);
        $this->db->where('cg_id',$data['cg_id']);
        $team=$this->db->get('chatgroup_v');
        $this->db->where('divisi_id',7);
        $su=$this->db->get('user_m');
        if($team->num_rows()>0){
            $counter=rand(0,100);
            foreach ($team->result() as $t){
                if($t->user_id!=$data['user_id']) {
                    $notif = array(
                        'notifikasi_id' => 'CG'.uniqid(),
                        'notifikasi_isi' => $notifM,
                        'notifikasi_link' => $link,
                        'notifikasi_date' => date('Y-m-d H:i:s'),
                        'user_id' => $t->user_id
                    );
                    $this->notifikasi_l->addNotif($notif);
                    $counter++;
                }
            }
            foreach ($su->result() as $t){
                if($t->user_id!=$data['user_id']) {
                    $notif = array(
                        'notifikasi_id' => 'CG'.uniqid(),
                        'notifikasi_isi' => $notifM,
                        'notifikasi_link' => $link,
                        'notifikasi_date' => date('Y-m-d H:i:s'),
                        'user_id' => $t->user_id
                    );
                    $this->notifikasi_l->addNotif($notif,false);
                    $counter++;
                }
            }
        }
        if($insert){
            $response['status']=true;
            $response['message']="chat sent";
        }else{
            $response['status']=false;
            $response['message']="Failed to send message";
        }
        return $response;
    }
}