<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_customer','customer');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Customer';
		$head['menu']          		= 'customer';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('customer/customer_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->customer->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $customer) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$customer->id.'"></div>';
			$row[] = $customer->email;
			$row[] = $customer->nama_lengkap;
			$row[] = $customer->nama_korporat;
			//add html for action
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_customer('."'".$customer->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Hapus"
					  	  	onclick="delete_customer('."'".$customer->id."'".')">
					  	  	<i class="fas fa-trash-alt"></i></a>
					  	<a class="btn btn-sm btn-info" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Detail"
					  	  	onclick="detail('."'".$customer->id."'".')">
					  	  	<i class="fas fa-info-circle"></i></a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->customer->count_all(),
						"recordsFiltered" => $this->customer->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'nama_lengkap' 		=> $this->input->post('nama_lengkap'),
				'nama_korporat' 	=> $this->input->post('nama_korporat'),
				'no_tlp' 			=> $this->input->post('no_tlp'),
				'email' 			=> $this->input->post('email'),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
				'status_member' 	=> 'M',
			);

		$insert = $this->customer->save($data);

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
		$data = $this->customer->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate_update();

		$data = array(
				'nama_lengkap' 		=> $this->input->post('nama_lengkap'),
				'nama_korporat' 	=> $this->input->post('nama_korporat'),
				'no_tlp' 			=> $this->input->post('no_tlp'),
				'email' 			=> $this->input->post('email'),
				'tanggal_buat' 		=> date('Y-m-d H:i:s'),
				'status_member' 	=> 'M',
			);

		$this->customer->update(array('id' => $this->input->post('id')), $data);
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
		$this->customer->delete_by_id($id);
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
			$this->customer->delete_by_id($id);
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

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email Masih Kosong';
			$data['status'] = FALSE;
		}

		$email = $this->input->post('email');
		$where = array('email' => $email);
		$cek_data = $this->customer->cek($where,'dcs_customer')->result();

		if (count($cek_data)>0) {
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Customer sudah ada';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_lengkap') == '')
		{
			$data['inputerror'][] = 'nama_lengkap';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_korporat') == '')
		{
			$data['inputerror'][] = 'nama_korporat';
			$data['error_string'][] = 'Korporat Masih Kosong';
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

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_lengkap') == '')
		{
			$data['inputerror'][] = 'nama_lengkap';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_korporat') == '')
		{
			$data['inputerror'][] = 'nama_korporat';
			$data['error_string'][] = 'Korporat Masih Kosong';
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