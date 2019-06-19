<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

	public function index()
	{
                // $this->output->delete_cache();
                $this->session->sess_destroy();
                redirect(site_url().'/login');
                // echo "<script>document.location.href='https://5dapps.com/intranet/index.php'</script>";
                
	}
}
