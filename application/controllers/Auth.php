<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include('/httpful.phar');

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
		$input = $this->input->post();

		if($input){

			$user = $input['user'];

			$this->load->library('form_validation');

			$this->form_validation->set_rules('user[email]', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('user[password]', 'Password', 'required');
		//$this->form_validation->set_rules('confirmation', 'Password Confirmation', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				//if something wrong
				$data['page_title'] = 'ANYBABA|LOGIN';
				$this->load->view('partials/header', $data);
				$this->load->view('partials/navbar');
				$this->load->view('partials/login');
				$this->load->view('partials/footer');
			}
			else
			{
				//if valid data
				
				$url = $this->config->item('serv_url').'/backend/users/login';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
				$response = \Httpful\Request::post($url)
				->body('{"email":"'.$user['email'].'", "password":"'.$user['password'].'"}')
				->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 

				$res =json_decode($response, true);

				if($res['Error']){

					$data['page_title'] = 'ANYBABA|LOGIN';
					$data['message'] = 'Invalid email or password !';
					$this->load->view('partials/header', $data);
					$this->load->view('partials/navbar');
					$this->load->view('partials/login');
					$this->load->view('partials/footer');
				}
				else {
					$this->session->set_flashdata('message', 'Login Success');
					redirect('/auth/login');
				}


				//redirect('/auth/login');
			}
		}
		else{
			$data['page_title'] = 'ANYBABA|LOGIN';
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('partials/login');
			$this->load->view('partials/footer');
		}
		
	}

	
}
