<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditProfile extends App_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function index()
    {
        $this->data['title']="Edit Profile";
        $this->data['subtitle']="change your information";
        $this->loadJS('editprofile');
        $this->renderAdmin('editprofile');
    }
    public function saveInfo(){
        $user_id=$this->session->userdata('user_user_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('telp', 'Telp', 'trim|required');
        $this->form_validation->set_rules('status_KTP', 'status KTP', 'trim|required');
        $this->form_validation->set_rules('status_intranet', 'status Intranet', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        if($this->input->post('status_intranet')=='Lainnya'){
            $this->form_validation->set_rules('intranet_lainnya', 'status Intranet Lainnya', 'trim|required');
        }
        if ($this->form_validation->run() == FALSE) {
            $response['status']=false;
            $response['message']=validation_errors();
        }else{
            if($this->input->post('status_intranet')=='Lainnya'){
                $status_intranet=$this->input->post('intranet_lainnya');
            }else{
                $status_intranet=$this->input->post('status_intranet');
            }
            $data=array(
                'email'=>$this->input->post('email'),
                'nama'=>$this->input->post('nama'),
                'telp'=>$this->input->post('telp'),
                'status_KTP'=>$this->input->post('status_KTP'),
                'status_intranet'=>$status_intranet,
                'alamat'=>$this->input->post('alamat')
            );
            $response=$this->user->saveInfo($data,$user_id);
            if($response['status']){
                foreach ($data as $k => $v) {
                    $this->session->set_userdata('user_' . $k, $v);
                }
            }
        }
        echo json_encode($response);
    }
	
	public function changePass() {
		$user_id=$this->session->userdata('user_user_id');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('oldPassword', 'Current Password', 'required');
        $this->form_validation->set_rules('newPassword', 'New Password', 'required');
        $this->form_validation->set_rules('rePassword', 'Re-type New Password', 'required|matches[newPassword]');
		if ($this->form_validation->run() == FALSE) {
            $response['status']=false;
            $response['message']=validation_errors();
        } else {
			$cekOldPassword = $this->user->checkOldPassword(md5($this->input->post("oldPassword")),$user_id);
			if($cekOldPassword) {
				$data["password"] = md5($this->input->post("newPassword"));
				$response = $this->user->updatePass($data,$user_id);
			} else {
				$response["status"] = false;
				$response["message"] = "Wrong Current Password";
			}
		}
		echo json_encode($response);
	}

    public function upload() {
        $user_id = $this->session->userdata("user_user_id");
        $config['upload_path'] = './assets/uploads/files';
        $config['allowed_types'] = 'gif|jpg|png|doc|txt';
        $config['max_size'] = 1024;
        $config['overwrite'] = TRUE;
        $new_name = $user_id."_".$this->session->userdata("user_company_name");
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        $this->load->library('image_lib');
 
        if (!$this->upload->do_upload('fileUpload'))
        {
            $response["status"] = false;
            $response['message'] = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $configer =  array(
              'image_library'   => 'gd2',
              'source_image'    =>  $data['full_path'],
              'maintain_ratio'  =>  TRUE,
              'width'           =>  200,
              'height'          =>  200,
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();
            $upload = $this->user->insert_file(array("photo"=>$data['file_name']), $user_id);
            $response['status'] = $upload['status'];
            $response['message'] = $upload['message'];
            if($upload['status']);
            {
                $this->session->set_userdata("user_photo",$data["file_name"]);
            }
        }
        @unlink($_FILES['fileUpload']);
        echo json_encode($response);
    }
}
