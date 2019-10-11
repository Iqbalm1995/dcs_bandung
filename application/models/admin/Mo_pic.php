<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_pic extends CI_Model {

	var $table = 'dcs_pic';
	var $column_order = array(null, 'nip', 'nama', 'unit', 'no_tlp', 'pass', 'foto', 'tanggal_buat', 'login_terakhir', 'pic_status'); //set column field database for datatable orderable
	var $column_search = array('nip','nama','unit', 'tanggal_buat', 'login_terakhir', 'pic_status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('nip'))
		{
			$this->db->like('nip', $this->input->post('nip'));
		}
		if($this->input->post('nama'))
		{
			$this->db->like('nama', $this->input->post('nama'));
		}
		if($this->input->post('unit'))
		{
			$this->db->where('unit', $this->input->post('unit'));
		}
		if($this->input->post('pic_status'))
		{
			$this->db->where('pic_status', $this->input->post('pic_status'));
		}
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
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
