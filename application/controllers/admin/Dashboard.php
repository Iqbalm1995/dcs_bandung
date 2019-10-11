<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin/login_admin');
		}
    }

	public function index()
	{
		$head['title_page'] 		= 'Dashboard';
		$head['menu']          		= 'dashboard';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('dashboard/dashboard_views');
        $this->load->view('static/footer_view');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */