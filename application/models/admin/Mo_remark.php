<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_remark extends CI_Model {

	var $table = 'dsc_remark';
	var $views = 'dca_customer';
	var $order = array('id' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_remark($dca_id)
	{
		$this->db->from($this->table);
		$this->db->where('dca_id',$dca_id);
		$query = $this->db->get();

		return $query->result();
	}

	public function detail_dca($id)
	{
		$this->db->from($this->views);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
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
}
