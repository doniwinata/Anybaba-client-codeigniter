<?php

include('/httpful.phar');
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
	public function registerMember()
	{

		$url = 'http://localhost:3000/backend/users/';
		$userList = \Httpful\Request::get($url)->send();
		$data = $this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title'] = 'ANYBABA|LOGOUT';
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('partials/signup');
			$this->load->view('partials/footer');
		}
		else
		{
			$data['page_title'] = 'ANYBABA|LOGOUT';
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('partials/signup');
			$this->load->view('partials/footer');
		}
		
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
