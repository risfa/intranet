<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('query');
    }

    public function index()
    {
        $page=(isset($_GET['page']))? $_GET['page'] : 1;
        $start=($page-1)*10;
        $total=10;
        $q=(isset($_GET['q']))? $_GET['q'] : '';
        $updates=$this->query->searchUpdates($q,$start,$total);
        $result=$updates->result();
        $totalR=$this->query->searchUpdatesTotal($q);
        $this->data['q']=$q;
        $this->data['page']=$page;
        $this->data['total']=$totalR;
        $this->data['perpage']=$total;
        $this->data['users']=$this->query->searchUser($q);
        $this->data['updates']=(isset($result))? $result : array();
        $this->data['title']="Search";
        $this->data['subtitle']="Search Result";
        $this->renderAdmin('search');
    }
}
