<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        $this->load->model('admin/Mo_user_admin','user_admin');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'User Admin';
		$head['menu']          		= 'user admin';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('user_admin/user_admin_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->user_admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $user_admin) {
			$no++;
			$row = array();
			if ($user_admin->id == 1) {
				$row[] = '<div class="text-center">=</div>';
			}else{
				$row[] = '<div class="text-center"><input type="checkbox" class="data-check" value="'.$user_admin->id.'"></div>';
			}
			$row[] = $user_admin->user;
			$row[] = $user_admin->nama;
			$row[] = $user_admin->deskripsi;
			$row[] = '<div class="text-center">'.$user_admin->hak_akses.'</div>';
			if ($user_admin->login_terakhir == "0000-00-00 00:00:00") {
				$row[] = '<div class="text-center">-</div>';
			}else{
				$row[] = '<div class="text-center">'.time_elapsed_string($user_admin->login_terakhir).'</div>';
			}
			//add html for action
			$row[] = '<div class="text-center">
				  		<a  class="btn btn-sm btn-success" href="javascript:void(0)" 
							data-toggle="tooltip" title="Ubah"
							onclick="edit_user_admin('."'".$user_admin->id."'".')">
							<i class="fas fa-edit"></i></a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	data-toggle="tooltip" title="Hapus"
					  	  	onclick="delete_user_admin('."'".$user_admin->id."'".')">
					  	  	<i class="fas fa-trash-alt"></i></a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user_admin->count_all(),
						"recordsFiltered" => $this->user_admin->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'user' 				=> $this->input->post('user'),
				'pass' 				=> md5($this->input->post('pass')),
				'nama' 				=> $this->input->post('nama'),
				'deskripsi' 		=> $this->input->post('deskripsi'),
				'hak_akses' 		=> $this->input->post('hak_akses'),
				'created' 			=> date('Y-m-d H:i:s'),
			);

		$insert = $this->user_admin->save($data);

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
		$data = $this->user_admin->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate_update();

		$data = array(
				'user' 				=> $this->input->post('user'),
				'pass' 				=> md5($this->input->post('pass')),
				'nama' 				=> $this->input->post('nama'),
				'deskripsi' 		=> $this->input->post('deskripsi'),
				'hak_akses' 		=> $this->input->post('hak_akses'),
				'created' 			=> date('Y-m-d H:i:s'),
			);

		$this->user_admin->update(array('id' => $this->input->post('id')), $data);
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
		$this->user_admin->delete_by_id($id);
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
			$this->user_admin->delete_by_id($id);
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

		if($this->input->post('user') == '')
		{
			$data['inputerror'][] = 'user';
			$data['error_string'][] = 'Username Masih Kosong';
			$data['status'] = FALSE;
		}

		$user = $this->input->post('user');
		$where = array('user' => $user);
		$cek_data = $this->user_admin->cek($where,'dcs_user_admin')->result();

		if (count($cek_data)>0) {
			$data['inputerror'][] = 'user';
			$data['error_string'][] = 'Username sudah ada';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('pass') == '')
		{
			$data['inputerror'][] = 'pass';
			$data['error_string'][] = 'Password Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('deskripsi') == '')
		{
			$data['inputerror'][] = 'deskripsi';
			$data['error_string'][] = 'Deskripsi Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('hak_akses') == '')
		{
			$data['inputerror'][] = 'hak_akses';
			$data['error_string'][] = 'Hak Akses Belum Dipilih';
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

		if($this->input->post('user') == '')
		{
			$data['inputerror'][] = 'user';
			$data['error_string'][] = 'Username Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('pass') == '')
		{
			$data['inputerror'][] = 'pass';
			$data['error_string'][] = 'Password Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('deskripsi') == '')
		{
			$data['inputerror'][] = 'deskripsi';
			$data['error_string'][] = 'Deskripsi Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('hak_akses') == '')
		{
			$data['inputerror'][] = 'hak_akses';
			$data['error_string'][] = 'Hak Akses Belum Dipilih';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file User_admin.php */
/* Location: ./application/controllers/User_admin.php */