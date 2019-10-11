<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_ksrn extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_jenis_ksrn','jenis_ksrn');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Jenis Kuisioner';
		$head['menu']               = 'kuisioner';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('kuisioner/jenis_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->jenis_ksrn->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $jenis_ksrn) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$jenis_ksrn->id.'"></div>';
			$row[] = $jenis_ksrn->jenis_kuisioner;
			$row[] = $jenis_ksrn->deskripsi;
			if ($jenis_ksrn->created_date == "0000-00-00 00:00:00") {
				$row[] = '<div class="text-center">-</div>';
			}else{
				$row[] = '<div class="text-center">'.time_elapsed_string($jenis_ksrn->created_date).'</div>';
			}
			//add html for action
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_jenis_ksrn('."'".$jenis_ksrn->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Hapus"
					  	  	onclick="delete_jenis_ksrn('."'".$jenis_ksrn->id."'".')">
					  	  	<i class="fas fa-trash-alt"></i></a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jenis_ksrn->count_all(),
						"recordsFiltered" => $this->jenis_ksrn->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'jenis_kuisioner' 	=> $this->input->post('jenis_kuisioner'),
				'deskripsi' 		=> $this->input->post('deskripsi'),
				'created_date' 		=> date('Y-m-d H:i:s'),
			);

		$insert = $this->jenis_ksrn->save($data);

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
		$data = $this->jenis_ksrn->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
				'jenis_kuisioner' 	=> $this->input->post('jenis_kuisioner'),
				'deskripsi' 		=> $this->input->post('deskripsi'),
				'created_date' 		=> date('Y-m-d H:i:s'),
			);

		$this->jenis_ksrn->update(array('id' => $this->input->post('id')), $data);
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
		$this->jenis_ksrn->delete_by_id($id);
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
			$this->jenis_ksrn->delete_by_id($id);
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

		if($this->input->post('jenis_kuisioner') == '')
		{
			$data['inputerror'][] = 'jenis_kuisioner';
			$data['error_string'][] = 'Jenis Kuisioner Masih Kosong';
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

/* End of file Jenis_ksrn.php */
/* Location: ./application/controllers/admin/Jenis_ksrn.php */