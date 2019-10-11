<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dca extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('Mo_dca','dca');
        $this->load->model('pic/Mo_customer','customer');
        $this->load->model('Mo_pic','pic');
        $this->load->model('admin/Mo_remark','moremark');
        $this->load->model('admin/Mo_kuisioner','kuisioner');
        //sesion
        if($this->session->userdata('status') != "logindcacus"){
			redirect(base_url());
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'DCA';
		$head['menu']          		= 'dca';

		//load Data extend
		$data['load_business'] 		= $this->dca->load_business();
		$data['load_agenda'] 		= $this->dca->load_agenda();
		$data['load_pic'] 			= $this->dca->load_pic();

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('dca/dca_users', $data);
        $this->load->view('static/footer_view');
	}

	// Remark index
	public function remark($id)
	{
		$head['title_page'] 		= 'Remark Detail DCA';
		$head['menu']          		= 'dca';

		$data['detailDCA']  		= $this->dca->get_by_detail2($id);
		$data['detailRemark']  		= $this->moremark->get_remark($id);
		$data['dataDCA']  			= $this->moremark->detail_dca($id);

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('dca/remark_users', $data);
        $this->load->view('static/footer_view');
	}

	// Remark index
	public function kuesioner($id)
	{
		$head['title_page'] 		= 'Kuesioner DCA';
		$head['menu']          		= 'dca';

		$data['detailDCA']  		= $this->dca->get_by_detail2($id);
		$data['detailRemark']  		= $this->moremark->get_remark($id);
		$data['dataDCA']  			= $this->moremark->detail_dca($id);
        $data['getKSRN']            = $this->kuisioner->get_kuisioner();

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('dca/kuesioner_users', $data);
        $this->load->view('static/footer_view');
	}

	public function simpanKsrn()
	{
		$ksrn_view = $this->kuisioner->get_kuisioner();

		foreach ($ksrn_view as $read){ 

			$data = array(
					'dca_id' 			=> $this->input->post('dca_id'.$read->id_pertanyaan),
					'pertanyaan_id' 	=> $this->input->post('pertanyaan_id'.$read->id_pertanyaan),
					'jawaban' 			=> $this->input->post('ksrn'.$read->id_pertanyaan),
					'created_date' 		=> date('Y-m-d H:i:s'),
				);

			$insert = $this->dca->saveKsrn($data);

			$upt_saran = array(
				'saran_ksrn' 		=> $this->input->post('saran_ksrn'),
			);

			$this->dca->update(array('id' => $this->input->post('id_dca')), $upt_saran);
		}


		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Kuesioner telah di simpan
            </div>
			');

		redirect(base_url().'dca');
		
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->dca->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $dca) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $dca->nama_korporat;
			$row[] = $dca->nama_business;
			$row[] = $dca->time_sign;
			$row[] = $dca->nama;
			$row[] = $dca->nama_agenda;
			$row[] = $dca->created_date;
			// $row[] = $dca->no_mom;
			switch ($dca->status_activity) {
				case 'WAIT':
					$status_m = '<div class="badge badge-warning">WAIT</div>';
					break;
				case 'ACCEPTED':
					$status_m = '<div class="badge badge-success">ACCEPTED</div>';
					break;
				case 'PROGRESS':
					$status_m = '<div class="badge badge-info">PROGRESS</div>';
					break;
				case 'DONE':
					$status_m = '<div class="badge badge-primary">DONE</div>';
					break;
				case 'RESCHEDULING':
					$status_m = '<div class="badge badge-light">RESCHEDULING</div>';
					break;
				
				default:
					$status_m = '<div class="badge badge-danger">CANCEL</div>';
					break;
			}
			$row[] = '<div class="text-center">'.$status_m.'</div>';
			// add html for action
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_dca('."'".$dca->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	
					  	<a class="btn btn-sm btn-info" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Detail"
					  	  	onclick="detail('."'".$dca->id."'".')">
					  	  	<i class="fas fa-info-circle"></i></a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->dca->count_all(),
						"recordsFiltered" => $this->dca->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function pic_list()
	{
		// $this->load->helper('url');

		$list = $this->pic->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $pic) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $pic->nip;
			$row[] = $pic->nama;
			$row[] = $pic->unit;
			if ($pic->login_terakhir == "0000-00-00 00:00:00") {
				$row[] = '<div class="text-center">-</div>';
			}else{
				$row[] = '<div class="text-center">'.time_elapsed_string($pic->login_terakhir).'</div>';
			}
			$row[] = '<div class="text-center">
					  	<a class="btn btn-sm btn-info" href="javascript:void(0)" 
					  	  	title="Ambil PIC"
					  	  	onclick="pick_pic('."'".$pic->id."'".','."'".$pic->nip."'".','."'".$pic->nama."'".')">
					  	  	Pilih</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pic->count_all(),
						"recordsFiltered" => $this->pic->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'customer_id' 		=> $this->input->post('customer_id'),
				'business_id' 		=> $this->input->post('business_id'),
				'time_sign' 		=> $this->input->post('time_sign'),
				'pic_id' 			=> $this->input->post('pic_id'),
				'pic_name' 			=> null,
				'agenda_id' 		=> $this->input->post('agenda_id'),
				'status_activity' 	=> $this->input->post('status_activity'),
				'remark' 			=> $this->input->post('remark'),
				'agenda_id' 		=> $this->input->post('agenda_id'),
				'no_mom' 			=> null,
				'created_date' 		=> date('Y-m-d H:i:s'),
			);

		$insert = $this->dca->save($data);

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
		$data = $this->dca->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_detail($id)
	{
		$data = $this->dca->get_by_detail($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
				'customer_id' 		=> $this->input->post('customer_id'),
				'business_id' 		=> $this->input->post('business_id'),
				'time_sign' 		=> $this->input->post('time_sign'),
				'pic_id' 			=> $this->input->post('pic_id'),
				'pic_name' 			=> null,
				'agenda_id' 		=> $this->input->post('agenda_id'),
				'status_activity' 	=> $this->input->post('status_activity'),
				'remark' 			=> $this->input->post('remark'),
				'agenda_id' 		=> $this->input->post('agenda_id'),
				'no_mom' 			=> null,
				'created_date' 		=> date('Y-m-d H:i:s'),
			);

		$this->dca->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di update
            </div>
			');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('customer_id') == '')
		{
			$data['inputerror'][] = 'customer_id';
			$data['error_string'][] = 'Nama Korporat Masih Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('pic_id') == '')
		{
			$data['inputerror'][] = 'pic_id';
			$data['error_string'][] = 'PIC Sales Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('business_id') == '')
		{
			$data['inputerror'][] = 'business_id';
			$data['error_string'][] = 'Tipe Bisnis Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('agenda_id') == '')
		{
			$data['inputerror'][] = 'agenda_id';
			$data['error_string'][] = 'Tipe Agenda Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('time_sign') == '')
		{
			$data['inputerror'][] = 'time_sign';
			$data['error_string'][] = 'Time Sign Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('status_activity') == '')
		{
			$data['inputerror'][] = 'status_activity';
			$data['error_string'][] = 'Status Belum Dipilih';
			$data['status'] = FALSE;
		}

		if($this->input->post('remark') == '')
		{
			$data['inputerror'][] = 'remark';
			$data['error_string'][] = 'Remark Masih Kosong';
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