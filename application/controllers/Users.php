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



	}
	//check if user enter same email
	public function email_check($str)
	{
		$url = $this->config->item('serv_url').'/backend/users/checkemail/'.$str;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);

		if ($res['Error'])
		{
			$this->form_validation->set_message('email_check', 'Failed, Email is already use !');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function signupMember()
	{
		$input = $this->input->post();

		if($input){

			$user = $input['user'];

			$this->load->library('form_validation');

			$this->form_validation->set_rules('user[first_name]', 'First Name', 'required');
			$this->form_validation->set_rules('user[email]', 'Email', 'required|valid_email|callback_email_check');
			$this->form_validation->set_rules('user[password]', 'Password', 'required');
			$this->form_validation->set_rules('user[confirm]', 'Password Confirmation', 'required|matches[user[password]]');
		//$this->form_validation->set_rules('confirmation', 'Password Confirmation', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				//if something wrong
				//print_r($user);
				$data['page_title'] = 'ANYBABA|LOGOUT';
				$this->load->view('partials/header', $data);
				$this->load->view('partials/navbar');
				$this->load->view('partials/signup');
				$this->load->view('partials/footer');
			}
			else
			{
				//if valid data
				$url = $this->config->item('serv_url').'/backend/users/addmember';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
				$response = \Httpful\Request::post($url)
				->body('{"email":"'.$user['email'].'", "password":"'.$user['password'].'", "first_name":"'.$user['first_name'].'", "last_name":"'.$user['last_name'].'"}')
				->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 

				$res =json_decode($response, true);

				if($res['Error']){

				}
				else {
					$this->session->set_flashdata('message', $res['Message']);
					redirect('/auth/login');
				}


				//redirect('/auth/login');
			}
		}
		else{
			$data['page_title'] = 'ANYBABA|LOGOUT';
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('partials/signup');
			$this->load->view('partials/footer');
		}

	}
}
