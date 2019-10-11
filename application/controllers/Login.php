<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_get('Asia/Jakarta');
		$this->load->model('Mo_auth','auth');
	}

	public function index()
	{
		// $this->load->view('admin/s_header');
		$this->load->view('login/login_users');
	}

	public function proses_login()
	{

		$email = $this->input->post('email');
		$where = array(
			'email' => $email
			);

		$this->form_validation->set_rules('email','Email','required|trim');

		$cek = $this->auth->cek_login("dcs_customer",$where)->num_rows();

		$datas = $this->auth->cek_login("dcs_customer",$where)->result();

		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('pesan1', 'E-mail masih kosong!');
			redirect(base_url());
		}else{

			if($cek > 0){

				foreach ($datas as $row) {
					# code...
				}
				$id 	  = $row->id;
				$data_session = array(
					'id' 				=> $id,
					'email' 			=> $email,
					'nama' 				=> $row->nama_lengkap,
					'nama_korporat' 	=> $row->nama_korporat,

					'status' 			=> "logindcacus"
					);

				$this->session->set_userdata($data_session);
				redirect(base_url().'dashboard');

			}else{
				$this->session->set_flashdata('pesan2', 'E-mail salah!');
				redirect(base_url());
			}
		}

	}

	public function logout(){
		$data_session = array(
					'id'					=> '',
					'email' 				=> '',
					'nama' 					=> '',
					'nama_korporat' 		=> '',

					'status' 				=> ''
					);

		$this->session->unset_userdata($data_session);
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
}
