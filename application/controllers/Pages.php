<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_CONTROLLER {

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
	
	public function index()
	{
		$data['page_title'] = 'ANYBABA|HOME';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/home');
		$this->load->view('partials/footer');
	}

	
}
