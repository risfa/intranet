<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
    function login($username,$password){
        $this->db->where('email',$username);
        $this->db->where('password',$password);
        $this->db->select('user_id,email,photo,jabatan,status_KTP,status_intranet,nama,divisi_id,telp,alamat,divisi,company_name,company_id,created_by');
        $user=$this->db->get('userdata_v');
        if($user->num_rows()>0){
            $response['data']=$user->row();
            $this->db->where('access_level',$response['data']->divisi_id);
            $this->db->select('menu_title,menu_icon,menu_link');
            $menu=$this->db->get('menu_l')->result();
            foreach ($menu as $m){
                $response['menu'][]=array('title'=>$m->menu_title,'icon'=>$m->menu_icon,'link'=>$m->menu_link);
            }
            $response['status']=true;
            $response['message']="login success";
        }else{
            $response['status']=false;
            $response['message']="invalid username and password";
        }
        return $response;
    }
	function saveInfo($data,$user_id){
        $this->db->where('user_id',$user_id);
        $update=$this->db->update('user_m',$data);
        if($update!=FALSE){
            $response['status']=true;
            $response['message']="update success";
        }else{
            $response['status']=false;
            $response['message']="failed update data";
        }
        return $response;
    }
	function updatePass($data,$id) {
		$this->db->where("user_id",$id);
		$update = $this->db->update('user_m',$data);
		if($update) {
			$response["status"] = true;
			$response["message"] = "update password success";
		} else {
			$response["status"] = false;
			$response["message"] = "failed update data";
		}
		return $response;
	}
	function checkOldPassword($pass,$id) {
		$this->db->where("user_id",$id);
		$this->db->where("password",$pass);
		$user = $this->db->get("user_m");
		if($user->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
    function getProfile($id) {
        $this->db->where("user_id",$id);
        $user = $this->db->get("userinfo_v");
        if($user->num_rows() > 0) {
            return $user->row();
        } else {
            return array();
        }
    }
    function getAllName() {
        $this->db->select("user_id, nama");
        $user=$this->db->get('user_m');
        if($user->num_rows()>0){
            return json_encode($user->result_array());
        }else{
            return array();
        }
    }
    function insert_file($data, $id) {
        $this->db->where('user_id',$id);
        $row = $this->db->update("user_m",$data);
        if($row) {
            $response["status"] = true;
            $response["message"] = "Success Upload Photo & Refresh browser if pic not replace";
        } else {
            $response["status"] = false;
            $response["message"] = "failed Upload";
        }
        return $response;
    }
}
