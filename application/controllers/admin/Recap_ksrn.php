<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recap_ksrn extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_jawaban_ksrn','jawaban_ksrn');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Rekap Kuisioner';
		$head['menu']               = 'kuisioner';

		$data = $this->jawaban_ksrn->get_data()->result();
		$x['crtKSRN'] = $data;
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('kuisioner/jawaban_views', $x);
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->jawaban_ksrn->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $jawaban_ksrn) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<div class="text-center">'.$jawaban_ksrn->responden.' Customer</div>';
			$row[] = '<div class="text-center">'.$jawaban_ksrn->persentase.'%</div>';
			$row[] = '<div class="text-center">'.$jawaban_ksrn->created_date.'</div>';
			//add html for action
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jawaban_ksrn->count_all(),
						"recordsFiltered" => $this->jawaban_ksrn->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function ajax_edit($id)
	{
		$data = $this->jawaban_ksrn->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function update_recap()
	{

		$data = array(
				'responden' 		=> $this->input->post('responden'),
				'persentase' 		=> $this->input->post('persentase'),
				'created_date' 		=> date('Y-m-d'),
			);

		$insert = $this->jawaban_ksrn->save($data);

		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di Update
            </div>
			');

		redirect(base_url().'admin/recap_ksrn');
	}

}

/* End of file Jawaban_ksrn.php */
/* Location: ./application/controllers/admin/Jawaban_ksrn.php */