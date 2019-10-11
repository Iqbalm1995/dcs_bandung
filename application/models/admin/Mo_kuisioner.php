<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_kuisioner extends CI_Model {

	var $views = 'dca_kuisioner';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_kuisioner()
	{
		$this->db->from($this->views);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_countJwbn($where,$where2)
	{
		$query = $this->db->query('
            SELECT COUNT(jawaban) AS jawaban
				FROM dcs_kuisioner
				WHERE jawaban = '.$where.' AND pertanyaan_id = '.$where2.'
        ');

		return $query->row_array();
	}

	public function get_responden()
	{
		$query = $this->db->query('
            SELECT COUNT(DISTINCT dca_id) AS respon
			FROM dcs_kuisioner;
        ');

		return $query->row_array();
	}

}

/* End of file Mo_kuisioner.php */
/* Location: ./application/models/admin/Mo_kuisioner.php */