<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('credentials') == 'member' || !$this->session->userdata('credentials'))
		{
		 redirect('auth/login');
		}
                // Your own constructor code
	}
	public function index()
	{
		$data['page_title'] = 'ANYBABA|DASHBOARD';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/dashboard');
		$this->load->view('partials/footer');
	}

	public function dashboard()
	{
		if($this->session->userdata('credentials'))
		{
			$data['page_title'] = 'ANYBABA|DASHBOARD';
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('partials/dashboard');
			$this->load->view('partials/footer');
		}
	}
}
