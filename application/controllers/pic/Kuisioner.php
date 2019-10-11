<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        $this->load->helper('timeago');
        // Load Model
        
        //sesion
        if($this->session->userdata('status') != "logindcapic"){
            redirect(base_url().'pic/login_pic');
        }
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Kuisioner';
		$head['menu']          		= 'kuisioner';
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('kuisioner/kuisioner_pic');
        $this->load->view('static/footer_view');
	}

}

/* End of file Kuisioner.php */
/* Location: ./application/controllers/admin/Kuisioner.php */