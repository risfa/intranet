<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends App_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['title']="Reports";
        $this->data['subtitle']="project Reports";
        $this->renderAdmin('reports');
    }
}
