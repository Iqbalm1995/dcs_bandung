<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_type extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_agenda_type','agenda_type');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Agenda Type';
		$head['menu']          		= 'agenda type';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('master/agenda_type_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->agenda_type->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $agenda_type) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$agenda_type->id.'"></div>';
			$row[] = $agenda_type->nama;
			$row[] = $agenda_type->deskripsi;
			if ($agenda_type->tanggal_buat == "0000-00-00 00:00:00") {
				$row[] = '<div class="text-center">-</div>';
			}else{
				$row[] = '<div class="text-center">'.time_elapsed_string($agenda_type->tanggal_buat).'</div>';
			}
			//add html for action
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_agenda_type('."'".$agenda_type->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Hapus"
					  	  	onclick="delete_agenda_type('."'".$agenda_type->id."'".')">
					  	  	<i class="fas fa-trash-alt"></i></a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->agenda_type->count_all(),
						"recordsFiltered" => $this->agenda_type->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'nama' 				=> $this->input->post('nama'),
				'deskripsi' 		=> $this->input->post('deskripsi'),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
			);

		$insert = $this->agenda_type->save($data);

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
		$data = $this->agenda_type->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
				'nama' 				=> $this->input->post('nama'),
				'deskripsi' 		=> $this->input->post('deskripsi'),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
			);

		$this->agenda_type->update(array('id' => $this->input->post('id')), $data);
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
		$this->agenda_type->delete_by_id($id);
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
			$this->agenda_type->delete_by_id($id);
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

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('deskripsi') == '')
		{
			$data['inputerror'][] = 'deskripsi';
			$data['error_string'][] = 'Deskripsi Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Agenda_type.php */
/* Location: ./application/controllers/Agenda_type.php */