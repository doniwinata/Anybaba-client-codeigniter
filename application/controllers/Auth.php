<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
	public function login()
	{

		$data['page_title'] = 'ANYBABA|LOGIN';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/login');
		$this->load->view('partials/footer');
	}

	public function signup()
	{

		$data['page_title'] = 'ANYBABA|LOGOUT';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/signup');
		$this->load->view('partials/footer');
	}
}
