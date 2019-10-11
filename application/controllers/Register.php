<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_get('Asia/Jakarta');
		$this->load->model('Mo_register','register');
	}

	public function index()
	{
		// $this->load->view('admin/s_header');
		$this->load->view('login/register_users');
	}

	public function proses_daftar()
	{
		$email = $this->input->post('email');
		$where = array('email' => $email);
		$cek_data = $this->register->cek($where,'dcs_customer')->result();

		if (count($cek_data)>0) {
			$this->session->set_flashdata('pesan1', 'Email Sudah terdaftar di Daily Activity Sales JNE');
			redirect(base_url('register'));
		}

		$data = array(
				'nama_lengkap' 		=> $this->input->post('nama_lengkap'),
				'nama_korporat' 	=> $this->input->post('nama_korporat'),
				'no_tlp' 			=> $this->input->post('no_tlp'),
				'email' 			=> $this->input->post('email'),
				'alamat' 			=> $this->input->post('alamat'),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
				'status_member' 	=> 'NB',
			);

		$insert = $this->register->save($data);

		$this->session->set_flashdata('pesan3', 'Anda berhasil terdaftar di Daily Activity Sales JNE');
		redirect(base_url());
	}

}

/* End of file register.php */
/* Location: ./application/controllers/register.php */