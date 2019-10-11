<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remark extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_dca','dca');
        $this->load->model('admin/Mo_customer','customer');
        $this->load->model('admin/Mo_pic','pic');
        $this->load->model('admin/Mo_remark','moremark');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin');
		}
        
    }

	// Remark Function -----------------------------------------------------------------------------------------------------
	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'dca_id' 		=> $this->input->post('dca_id'),
				'title' 		=> $this->input->post('title'),
				'desc' 			=> $this->input->post('desc'),
				'start_remark' 	=> $this->input->post('start_remark'),
				'end_remark' 	=> $this->input->post('end_remark'),
				'created' 		=> date('Y-m-d H:i:s'),
			);

		$insert = $this->moremark->save($data);

		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di tambahkan
	        </div>
			');
	}

	public function ajax_delete($id)
	{
		$this->moremark->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di hapus
            </div>
			');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('title') == '')
		{
			$data['inputerror'][] = 'title';
			$data['error_string'][] = 'Judul Masih Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('desc') == '')
		{
			$data['inputerror'][] = 'desc';
			$data['error_string'][] = 'Deskripsi Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('start_remark') == '')
		{
			$data['inputerror'][] = 'start_remark';
			$data['error_string'][] = 'Waktu Mulai Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('end_remark') == '')
		{
			$data['inputerror'][] = 'end_remark';
			$data['error_string'][] = 'Waktu Selesai Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */