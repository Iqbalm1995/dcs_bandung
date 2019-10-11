<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pic extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_pic','pic');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Person In Charge';
		$head['menu']          		= 'pic';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('pic/pic_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->pic->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $pic) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$pic->id.'"></div>';
			$row[] = $pic->nip;
			$row[] = $pic->nama;
			$row[] = $pic->unit;
			switch ($pic->pic_status) {
				case 'APPROVED':
					$status_m = '<div class="badge badge-success">APPROVED</div>';
					break;
				case 'BANNED':
					$status_m = '<div class="badge badge-danger">BANNED</div>';
					break;
				
				default:
					$status_m = '<div class="badge badge-warning">WAIT</div>';
					break;
			}
			$row[] = '<div class="text-center">'.$status_m.'</div>';
			if ($pic->login_terakhir == "0000-00-00 00:00:00") {
				$row[] = '<div class="text-center">-</div>';
			}else{
				$row[] = '<div class="text-center">'.time_elapsed_string($pic->login_terakhir).'</div>';
			}
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_pic('."'".$pic->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Hapus"
					  	  	onclick="delete_pic('."'".$pic->id."'".')">
					  	  	<i class="fas fa-trash-alt"></i></a>
					  	<a class="btn btn-sm btn-info" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Detail"
					  	  	onclick="detail('."'".$pic->id."'".')">
					  	  	<i class="fas fa-info-circle"></i></a>
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
				'nip' 				=> $this->input->post('nip'),
				'nama' 				=> $this->input->post('nama'),
				'unit' 				=> $this->input->post('unit'),
				'no_tlp' 			=> $this->input->post('no_tlp'),
				'pass' 				=> md5($this->input->post('pass')),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
				'pic_status' 		=> $this->input->post('pic_status'),
			);

		$insert = $this->pic->save($data);

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
		$data = $this->pic->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate_update();

		$data = array(
				'nip' 				=> $this->input->post('nip'),
				'nama' 				=> $this->input->post('nama'),
				'unit' 				=> $this->input->post('unit'),
				'no_tlp' 			=> $this->input->post('no_tlp'),
				'pass' 				=> md5($this->input->post('pass')),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
				'pic_status' 		=> $this->input->post('pic_status'),
			);

		$this->pic->update(array('id' => $this->input->post('id')), $data);
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
		$this->pic->delete_by_id($id);
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
			$this->pic->delete_by_id($id);
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

		if($this->input->post('nip') == '')
		{
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP Masih Kosong';
			$data['status'] = FALSE;
		}

		$nip = $this->input->post('nip');
		$where = array('nip' => $nip);
		$cek_data = $this->pic->cek($where,'dcs_pic')->result();

		if (count($cek_data)>0) {
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP sudah ada';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('unit') == '')
		{
			$data['inputerror'][] = 'unit';
			$data['error_string'][] = 'Korporat Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_tlp') == '')
		{
			$data['inputerror'][] = 'no_tlp';
			$data['error_string'][] = 'Nomor telepon Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('pass') == '')
		{
			$data['inputerror'][] = 'pass';
			$data['error_string'][] = 'Password Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_update()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nip') == '')
		{
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('unit') == '')
		{
			$data['inputerror'][] = 'unit';
			$data['error_string'][] = 'Korporat Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('no_tlp') == '')
		{
			$data['inputerror'][] = 'no_tlp';
			$data['error_string'][] = 'Nomor telepon Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('pass') == '')
		{
			$data['inputerror'][] = 'pass';
			$data['error_string'][] = 'Password Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Pic.php */
/* Location: ./application/controllers/Pic.php */