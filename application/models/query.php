<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query extends CI_Model {
    public function searchUser($q){
        $this->db->like('nama',$q);
        $users=$this->db->get('user_m');
        if($users->num_rows()>0){
            return $users->result();
        }else{
            return array();
        }
    }
    public function searchUpdates($q,$start,$total){
        $user_id=$this->session->userdata('user_user_id');
        $divisi=$this->session->userdata('user_divisi_id');
        if($divisi!=7 && $divisi!=1) {
            $news=$this->db->query(" select * from search_non_user_v where my_id='".$user_id."' 
            AND (search_non_user_v.nama like '%".$q."%' 
            OR search_non_user_v.file like '%".$q."%' 
            OR search_non_user_v.project_name like '%".$q."%'
             OR search_non_user_v.desc like '%".$q."%') limit ".$start.",".$total);
        }else{
            $this->db->like('nama',$q);
            $this->db->or_like('project_name',$q);
            $this->db->or_like('file',$q);
            $this->db->or_like('desc',$q);
            $this->db->limit($total,$start);
            $news=$this->db->get('search_v');
        }
        return $news;
    }
    public function searchUpdatesTotal($q){
        $user_id=$this->session->userdata('user_user_id');
        $divisi=$this->session->userdata('user_divisi_id');
        if($divisi!=7 && $divisi!=1) {
            $news=$this->db->query(" select * from search_non_user_v where my_id='".$user_id."' 
            AND (search_non_user_v.nama like '%".$q."%' 
            OR search_non_user_v.file like '%".$q."%' 
            OR search_non_user_v.project_name like '%".$q."%'
             OR search_non_user_v.desc like '%".$q."%')");
        }else{
            $this->db->like('nama',$q);
            $this->db->or_like('project_name',$q);
            $this->db->or_like('file',$q);
            $this->db->or_like('desc',$q);
            $news=$this->db->get('search_v');
        }
        return $news->num_rows();
    }
}
