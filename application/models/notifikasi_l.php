<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi_l extends CI_Model {
    function getUnread($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('notifikasi_status','N');
        $this->db->order_by("notifikasi_date", "desc");
        $notif=$this->db->get('notif_l');
        if($notif->num_rows()>0){
            $response['total']=$notif->num_rows();
            $response['data']=$notif->result();
        }else{
            $response['total']=0;
            $response['data']=array();
        }
        return $response;
    }
    function addNotif($data,$email=true){
        if($email) {
            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['smtp_host'] = 'smtp.gmail.com';
            $config['smtp_user'] = 'explore@limadigit.com';
            $config['smtp_pass'] = '5d3xpl0r3';
            $config['smtp_port'] = 587;
            $config['smtp_crypto'] = 'tls';
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->get('user_m');
            $user = $query->row();
            $message = "Hi " . $user->nama . ", " . $data['notifikasi_isi'] . ' at ' . date('H:i', strtotime($data['notifikasi_date'])) . '. visit ' . $data['notifikasi_link'] . ' for more detail';
            $this->email->clear();
            $this->email->from('explore@limadigit.com', 'Explore');
            $this->email->to($user->email);
            $this->email->subject('Intranet Notification ' . date('d M Y', strtotime($data['notifikasi_date'])));
            $this->email->message($message);
            $this->email->send();
        }
        $this->db->insert('notif_l',$data);
    }
    function setReaded($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('notifikasi_status','N');
        $update=$this->db->update('notif_l',array('notifikasi_status'=>'Y'));
        if($update){
            $response['status']=true;
            $response['message']='readed';
        }else{
            $response['status']=false;
            $response['message']='unreaded';
        }
        return $response;
    }
}