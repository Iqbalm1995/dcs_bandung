<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_register extends CI_Model {

	var $table = 'dcs_customer';
	//database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}

	public function view(){
		return $this->db->get($this->table)->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	// public function upload_file($filename){
	// 	$this->load->library('upload'); // Load librari upload
		
	// 	$config['upload_path'] = './drive/excel/';
	// 	$config['allowed_types'] = 'xlsx';
	// 	$config['max_size']	= '2048';
	// 	$config['overwrite'] = true;
	// 	$config['file_name'] = $filename;
	
	// 	$this->upload->initialize($config); // Load konfigurasi uploadnya
	// 	if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
	// 		// Jika berhasil :
	// 		$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
	// 		return $return;
	// 	}else{
	// 		// Jika gagal :
	// 		$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
	// 		return $return;
	// 	}
	// }
	
	// // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	// public function insert_multiple($data){
	// 	$this->db->insert_batch($this->table, $data);
	// }
}
