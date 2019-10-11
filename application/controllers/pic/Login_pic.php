<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_pic extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_get('Asia/Jakarta');
		$this->load->model('pic/Mo_pic_auth','pic_auth');
	}

	public function index()
	{
		// $this->load->view('admin/s_header');
		$this->load->view('login/login_pic_views');
	}

	public function proses_login()
	{

		$nip = $this->input->post('nip');
		$pass = $this->input->post('pass');
		$where = array(
			'nip' => $nip,
			'pass' => md5($pass)
			);

		$this->form_validation->set_rules('nip','Username','required|trim');
		$this->form_validation->set_rules('pass','Password','required|trim');

		$cek = $this->pic_auth->cek_login("dcs_pic",$where)->num_rows();

		$datas = $this->pic_auth->cek_login("dcs_pic",$where)->result();

		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('pesan1', 'Username dan Password masih kosong!');
			redirect(base_url().'pic');
		}else{

			if($cek > 0){

				foreach ($datas as $row) {
					# code...
				}
				$id 	  = $row->id;
				$data_session = array(
					'id' 				=> $id,
					'nip' 				=> $nip,
					'nama' 				=> $row->nama,

					'status' 			=> "logindcapic"
					);

				$this->session->set_userdata($data_session);
				redirect(base_url().'pic/dashboard');

			}else{
				$this->session->set_flashdata('pesan2', 'Username atau Password salah!');
				redirect(base_url().'pic');
			}
		}

	}

	public function logout(){
		$data_session = array(
					'id'					=> '',
					'nip' 					=> '',
					'nama' 					=> '',

					'status' 				=> ''
					);

		$this->session->unset_userdata($data_session);
		$this->session->sess_destroy();
		redirect(base_url().'pic');
	}
	
}
