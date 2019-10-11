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
        $this->load->model('admin/Mo_kuisioner','kuisioner');
        
        //sesion
        if($this->session->userdata('status') != "logindcaadministrator"){
			redirect(base_url().'admin');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Kuisioner';
		$head['menu']          		= 'kuisioner';

        $data['getKSRN']            = $this->kuisioner->get_kuisioner();
		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('kuisioner/kuisioner_views', $data);
        $this->load->view('static/footer_view');
	}

    public function setup()
    {
        $head['title_page']         = 'Atur Kuisioner';
        $head['menu']               = 'kuisioner';
        // View
        $this->load->view('static/header_view', $head);
        $this->load->view('kuisioner/kuisioner_setup');
        $this->load->view('static/footer_view');
    }

}

/* End of file Kuisioner.php */
/* Location: ./application/controllers/admin/Kuisioner.php */