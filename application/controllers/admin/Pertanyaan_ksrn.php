<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan_ksrn extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_pertanyaan_ksrn','pertanyaan_ksrn');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Pertanyaan Kuisioner';
		$head['menu']               = 'kuisioner';
		$data['get_jenis'] 			= $this->pertanyaan_ksrn->get();
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('kuisioner/pertanyaan_views', $data);
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->pertanyaan_ksrn->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $pertanyaan_ksrn) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$pertanyaan_ksrn->id.'"></div>';

			$nama_jenis = $this->pertanyaan_ksrn->get_jenis_nama($pertanyaan_ksrn->jenis_ksrn_id);
			$row[] = $nama_jenis->jenis_kuisioner;
			$row[] = $pertanyaan_ksrn->isi_pertanyaan;
			if ($pertanyaan_ksrn->created_date == "0000-00-00 00:00:00") {
				$row[] = '<div class="text-center">-</div>';
			}else{
				$row[] = '<div class="text-center">'.time_elapsed_string($pertanyaan_ksrn->created_date).'</div>';
			}
			//add html for action
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_pertanyaan_ksrn('."'".$pertanyaan_ksrn->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Hapus"
					  	  	onclick="delete_pertanyaan_ksrn('."'".$pertanyaan_ksrn->id."'".')">
					  	  	<i class="fas fa-trash-alt"></i></a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pertanyaan_ksrn->count_all(),
						"recordsFiltered" => $this->pertanyaan_ksrn->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'jenis_ksrn_id' 	=> $this->input->post('jenis_ksrn_id'),
				'isi_pertanyaan' 		=> $this->input->post('isi_pertanyaan'),
				'created_date' 		=> date('Y-m-d H:i:s'),
			);

		$insert = $this->pertanyaan_ksrn->save($data);

		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di tambahkan
            </div>
			');
	}

	public function ajax_edit($id)
	{
		$data = $this->pertanyaan_ksrn->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
				'jenis_ksrn_id' 	=> $this->input->post('jenis_ksrn_id'),
				'isi_pertanyaan' 		=> $this->input->post('isi_pertanyaan'),
				'created_date' 		=> date('Y-m-d H:i:s'),
			);

		$this->pertanyaan_ksrn->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di update
            </div>
			');
	}

	public function ajax_delete($id)
	{
		$this->pertanyaan_ksrn->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di hapus
            </div>
			');
	}

	public function ajax_bulk_delete()
	{
		$list_id = $this->input->post('id');
		foreach ($list_id as $id) {
			$this->pertanyaan_ksrn->delete_by_id($id);
		}
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

		if($this->input->post('jenis_ksrn_id') == '')
		{
			$data['inputerror'][] = 'jenis_ksrn_id';
			$data['error_string'][] = 'Jenis Kuisioner Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('isi_pertanyaan') == '')
		{
			$data['inputerror'][] = 'isi_pertanyaan';
			$data['error_string'][] = 'Isi Pertanyaan Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Pertanyaan_ksrn.php */
/* Location: ./application/controllers/admin/Pertanyaan_ksrn.php */