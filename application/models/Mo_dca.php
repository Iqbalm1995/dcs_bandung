<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_dca extends CI_Model {

	var $views 		= 'dca_customer';
	var $table 		= 'dcs_dca';
	var $kuesioner 	= 'dcs_kuisioner';

	var $t_business 	= 'dcs_business_type';
	var $t_agenda 		= 'dcs_agenda';
	var $t_customer 	= 'dcs_customer';
	var $t_pic 			= 'dcs_pic';


	var $column_order = array(null, 'nama_korporat', 'nama_business', 'time_sign', 'nama', 'pic_name', 'nama_agenda', 'status_activity', 'remark','no_mom','saran_ksrn','created_date'); //set column field database for datatable orderable
	var $column_search = array('nama_korporat','time_sign','nama', 'pic_name', 'nama_agenda', 'status_activity', 'remark','no_mom','saran_ksrn','created_date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_hasilKsrn($dca_id)
	{
		$this->db->from($this->kuesioner);
		$this->db->where('dca_id', $dca_id);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('nama_korporat'))
		{
			$this->db->like('nama_korporat', $this->input->post('nama_korporat'));
		}
		if($this->input->post('nama_business'))
		{
			$this->db->where('nama_business', $this->input->post('nama_business'));
		}
		if($this->input->post('time_sign'))
		{
			$this->db->like('time_sign', $this->input->post('time_sign'));
		}
		if($this->input->post('nama'))
		{
			$this->db->like('nama', $this->input->post('nama'));
		}
		if($this->input->post('nama_agenda'))
		{
			$this->db->where('nama_agenda', $this->input->post('nama_agenda'));
		}
		if($this->input->post('status_activity'))
		{
			$this->db->where('status_activity', $this->input->post('status_activity'));
		}
		if($this->input->post('no_mom'))
		{
			$this->db->like('no_mom', $this->input->post('no_mom'));
		}
		
		$this->db->from($this->views);

		$cek_cus = $this->session->userdata('email');
		
		$this->db->where('email',$cek_cus);

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
		$this->db->from($this->views);
		$cek_cus = $this->session->userdata('email');
		
		$this->db->where('email',$cek_cus);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_detail($id)
	{
		$this->db->from($this->views);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_detail2($id)
	{
		$this->db->from($this->views);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function saveKsrn($data)
	{
		$this->db->insert($this->kuesioner, $data);
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

	// Data Extend

	public function load_business() 
	{
	  	$this->db->select('*');
		return $this->db->get($this->t_business)->result();
	}

	public function load_agenda() 
	{
	  	$this->db->select('*');
		return $this->db->get($this->t_agenda)->result();
	}

	public function load_customer() 
	{
	  	$this->db->select('*');
		return $this->db->get($this->t_customer)->result();
	}

	public function load_pic() 
	{
	  	$this->db->select('*');
		return $this->db->get($this->t_pic)->result();
	}

	public function get_id_val($where,$table)
	{
		$this->db->from($table);
		$this->db->where('id',$where);
		$query = $this->db->get();

		return $query->row_array();
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


		

		