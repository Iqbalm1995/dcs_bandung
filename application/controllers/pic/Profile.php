<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('pic/Mo_profile','profile');
        //sesion
        if($this->session->userdata('status') != "logindcapic"){
			redirect(base_url().'pic/login_pic');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Profile';
		$head['menu']          		= 'profile';

		$data['picDATA'] = $this->profile->get_pic($this->session->userdata('id'));
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('pic/profile_pic', $data);
        $this->load->view('static/footer_view');
	}

	public function ajax_edit($id)
	{
		$data = $this->profile->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	private function resize_img($gbr){
		$config['image_library']='gd2';
        $config['source_image']='./drive/photo/temp/'.$gbr['file_name'];
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '80%';
        $config['width']= 400;
        $config['height']= 400;
        $config['new_image']= './drive/photo/'.$gbr['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'unit' 				=> $this->input->post('unit'),
				'no_tlp' 			=> $this->input->post('no_tlp'),
			);

		$this->profile->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_photo()
	{
		$id = $this->input->post('id_foto');
		$profile = $this->profile->get_by_id($id);
    	if(!empty($_FILES['photo']['name'])){
    		if(file_exists('drive/photo/'.$profile->photo) && $profile->photo)
				unlink('drive/photo/'.$profile->photo);
				$data['photo'] = '';
    	}

    	if(empty($_FILES['photo']['name'])){
    		if(file_exists('drive/photo/'.$profile->photo) && $profile->photo)
				unlink('drive/photo/'.$profile->photo);
				$data['photo'] = '';
    	}

		$config['upload_path'] = './drive/photo/temp/'; //path folder
	    $nmfile = "file_".time();
        $config['allowed_types'] = 'jpg|png|jpeg|bmp';
        $config['file_name'] = $nmfile;

        $this->load->library('upload',$config);

    	if(!empty($_FILES['photo']['name'])){
    		if(!$this->upload->do_upload('photo')){
    			$data['inputerror'][] = 'photo';
				$data['error_string'][] = 'Gagal upload gambar'; //show ajax error
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();	
    		}else{
    			$gbr = $this->upload->data();
	            $this->resize_img($gbr);
	            unlink('drive/photo/temp/'.$this->upload->data('file_name'));
	            $data['photo'] = $this->upload->data('file_name');
	        }
    	}

		$this->profile->update(array('id' => $this->input->post('id_foto')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_pass()
	{
		$this->_validate2();
		$data = array(
				'pass' 			=> md5($this->input->post('pass')),
			);

		$this->profile->update(array('id' => $this->input->post('id_pass')), $data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('unit') == '')
		{
			$data['inputerror'][] = 'unit';
			$data['error_string'][] = 'Unit Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_tlp') == '')
		{
			$data['inputerror'][] = 'no_tlp';
			$data['error_string'][] = 'Nomor Telepon Masih Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if(md5($this->input->post('password_lama')) != $this->input->post('hidden_pass'))
		{
			$data['inputerror'][] = 'password_lama';
			$data['error_string'][] = 'Password Salah';
			$data['status'] = FALSE;
		}

		// if($this->input->post('password') == '')
		// {
		// 	$data['inputerror'][] = 'password';
		// 	$data['error_string'][] = 'Password Baru Masih Kosong';
		// 	$data['status'] = FALSE;
		// }

		if($this->input->post('pass') != $this->input->post('pass_confirm'))
		{
			$data['inputerror'][] = 'pass_confirm';
			$data['error_string'][] = 'Password Tidak Sama';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/pic/Profile.php */