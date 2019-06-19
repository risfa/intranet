<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model {
    function getAll(){
        $clients=$this->db->get('client_m');
        if($clients->num_rows()>0){
            return $clients->result();
        }else{
            return array();
        }
    }
}
