<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//use \League\OAuth2\Client\Provider\Facebook;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Httpful\Httpful;
use \Firebase\JWT\JWT;
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
				//print_r(json_encode($user));
				$jwt = JWT::encode(json_encode($user), $this->config->item('service_secret'));
				//print_r($jwt);exit();
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
				$response = \Httpful\Request::post($url)
				->body('{"data":"'.$jwt.'"}')
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
				$jwt = JWT::encode(json_encode($user), $this->config->item('service_secret'));
				$url = $this->config->item('serv_url').'/backend/users/login';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
				$response = \Httpful\Request::post($url)
				->body('{"data":"'.$jwt.'"}')
				->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 

				$res =json_decode($response, true);
				
				$res = JWT::decode($res, $this->config->item('service_secret'), array('HS256'));
				
				$res = json_decode(json_encode($res), true);
				if($res['Error']){

					$data['page_title'] = 'ANYBABA|LOGIN';
					$data['message'] = 'Invalid email or password !';
					$this->load->view('partials/header', $data);
					$this->load->view('partials/navbar');
					$this->load->view('partials/login');
					$this->load->view('partials/footer');
				}
				else {
					$this->session->name = $res['name'];
					$this->session->email = $res['email'];
					$this->session->credentials = $res['credentials'];
					$this->session->id = $res['id'];
					$this->session->type = 'manual';	
					$this->session->set_flashdata('message', 'Login Success');
					
					//check credentials
					if($res['credentials'] == 'member')
					{
						redirect('pages');
					}
					else if ($res['credentials'] == 'administrator' || $res['credentials'] == 'manager')
					{
						redirect('backend');	
					}
					
				}
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


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('pages');		
	}	

	public function loginFacebook()
	{

		
		$fb = new Facebook\Facebook([
			'app_id' => '527659474057676',
			'app_secret' => '54c9dbc57f17ef6e17d28d68566dcf53',
			'default_graph_version' => 'v2.2',
			]);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; // optional
		$redirect = site_url().'/auth/cb_facebook';
		$loginUrl = $helper->getLoginUrl($redirect, $permissions);
		redirect($loginUrl);
	}
	public function cb_facebook()
	{
		$fb = new Facebook\Facebook([
			'app_id' => '527659474057676',
			'app_secret' => '54c9dbc57f17ef6e17d28d68566dcf53',
			'default_graph_version' => 'v2.2',
			]);

		$helper = $fb->getRedirectLoginHelper();
		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (isset($accessToken)) {
  // Logged in!
			
			try {
  // Returns a `Facebook\FacebookResponse` object
				$response = $fb->get('/me?fields=id,name,email', $accessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			$user = $response->getGraphUser();

			//register user to table oauth if not found

			$url = $this->config->item('serv_url').'/backend/users/addoauth';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			$response = \Httpful\Request::post($url)
			->body('{"type":"facebook", "user_email":"'.$user['email'].'", "credentials":"member", "user_id" :"'.$user['id'].'", "user_name" :"'.$user['name'].'"}')
			->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 

			$url = $this->config->item('serv_url').'/backend/users/findEmail';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			$response = \Httpful\Request::post($url)
			->body('{ "email":"'.$user['email'].'"}')
			->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 		
			$res =json_decode($response, true);
			$res = $res[0];
			//print_r($res);exit();
			$this->session->name = $res['first_name'];
			$this->session->email = $res['email'];
			$this->session->credentials = $res['credentials'];
			$this->session->id = $res['id'];
			$this->session->type = 'manual';	
			$this->session->set_flashdata('message', 'Login Success');

					//check credentials
			if($res['credentials'] == 'member')
			{
				redirect('pages');
			}
			else if ($res['credentials'] == 'administrator' || $res['credentials'] == 'manager')
			{
				redirect('backend');	
			}

					//check credentials
		}
	}

	public function loginGoogle(){
		
		if(isset($_GET['error'])){
			redirect('auth/login');
		}
		$client_id = '863576228912-j98f00u2sf7qvk94u4r2tpi2jt72jdpd.apps.googleusercontent.com';
		$client_secret = 'ugwpjoh9Qd_0DK6KaxQ-o1yN';
		$redirect = site_url().'/auth/loginGoogle';
		$redirect_uri = $redirect;
		//$simple_api_key = '<Your-API-Key>';


		$client = new Google_Client();
		$client->setApplicationName("ANYBABA");
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");

		$objOAuthService = new Google_Service_Oauth2($client);

		$authUrl = $client->createAuthUrl();
		
		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			if ($client->getAccessToken()) {
				$user = $objOAuthService->userinfo->get();
				

				$url = $this->config->item('serv_url').'/backend/users/addoauth';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
				$response = \Httpful\Request::post($url)
				->body('{"type":"google", "user_email":"'.$user['email'].'", "credentials":"member", "user_id" :"'.$user['id'].'", "user_name" :"'.$user['givenName'].' '.$user['familyName'].'"}')
				->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 


				$url = $this->config->item('serv_url').'/backend/users/findEmail';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
				$response = \Httpful\Request::post($url)
				->body('{ "email":"'.$user['email'].'"}')
				->addHeader('x-access-token', $this->config->item('token')) ->sendsJson()->send(); 		
				$res =json_decode($response, true);
				$res = $res[0];
			//print_r($res);exit();
				$this->session->name = $res['first_name'];
				$this->session->email = $res['email'];
				$this->session->credentials = $res['credentials'];
				$this->session->id = $res['id'];
				$this->session->type = 'manual';	
				$this->session->set_flashdata('message', 'Login Success');

					//check credentials
				if($res['credentials'] == 'member')
				{
					redirect('pages');
				}
				else if ($res['credentials'] == 'administrator' || $res['credentials'] == 'manager')
				{
					redirect('backend');	
				}
				
				
			} else {
				redirect($client->createAuthUrl());
			}
		}
		else{
			redirect($client->createAuthUrl());
		}

	}


}
