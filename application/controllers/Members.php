<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

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
	public $data = '';
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('credentials') == 'member' || !$this->session->userdata('credentials'))
		{
			redirect('auth/login');
		}
		
                // Your own constructor code
	}
	public function makeTable($res)
	{
		$result = '<thead><tr>
		<th>Name</th>
		<th>Email</th>
		<th>Status</th>
		<th>Updated At</th>
		<th>Created At</th>
		<th>Actions</th>
		</tr></thead><tbody>';
		foreach($res as $row){
			$updated = date("l, d-m-Y", strtotime($row['updated_at']));
			$created = date("l, d-m-Y", strtotime($row['created_at']));

			$buttonEdit = '			
			<div class="btn-group">
			<button type="button" class="btn btn-primary btn-lg actionTable" data-toggle="modal" data-target="#editModal" data-item-id="'.$row['id'].'"><span data-item-id="'.$row['id'].'" class="fui-new"></span></button>
			<button type="button" class="btn btn-danger btn-lg actionTable" data-toggle="modal" data-target="#deleteModal"  data-item-id="'.$row['id'].'" ><span  data-item-id="'.$row['id'].'" class="fui-trash" ></span></button>
			</div>';
			$result .= '<tr>';
			$result .= '<td>'.$row['first_name']. ' '.$row['last_name'].'</td>';
			$result .= '<td>'.$row['email'].'</td>';
			$result .= '<td>'.$row['status'].'</td>';
			$result .= '<td>'.$updated.'</td>';
			$result .= '<td>'.$created.'</td>';
			$result .= '<td>'.$buttonEdit.'</td>';
			$result .= '</tr>';
		}
		return $result;
	}
	public function makeTableReport($res)
	{
		$result = '<thead><tr>
		<th>Name</th>
		<th>Email</th>
		<th>Status</th>
		<th>Updated At</th>
		<th>Created At</th>
		
		</tr></thead><tbody>';
		foreach($res as $row){
			$updated = date("l, d-m-Y", strtotime($row['updated_at']));
			$created = date("l, d-m-Y", strtotime($row['created_at']));

		
			$result .= '<tr>';
			$result .= '<td>'.$row['first_name']. ' '.$row['last_name'].'</td>';
			$result .= '<td>'.$row['email'].'</td>';
			$result .= '<td>'.$row['status'].'</td>';
			$result .= '<td>'.$updated.'</td>';
			$result .= '<td>'.$created.'</td>';
			$result .= '</tr>';
		}
		return $result;
	}
	public function index()
	{
		$url = $this->config->item('serv_url').'/backend/users/members';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		$this->data = $res;

		$data['page_title'] = 'ANYBABA|MEMBERS';
		$data['link_add'] = '/auth/signupMember';
		$data['type'] = 'Member';
		$data['table'] = $this->makeTable($this->data);
		$this->load->view('partials/backend/header', $data);
		$this->load->view('partials/backend/navbar');
		$this->load->view('partials/backend/tableMember');
		$this->load->view('partials/backend/form/members');
		$this->load->view('partials/backend/footer');
		$this->load->view('partials/backend/script/members');	
	}
	public function get(){
		$input = $this->input->post();
		if($input){
			$id = $input['id'];
			$url = $this->config->item('serv_url').'/backend/users/members/find/'.$id;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			echo $response;

		}
	}
	public function delete(){
		$input = $this->input->post();
		if($input){
			$id = $input['id'];

			$url = $this->config->item('serv_url').'/backend/users/members/delete/'.$id;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 

			$url = $this->config->item('serv_url').'/backend/users/members';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$res =json_decode($response, true);
			$this->data = $res;

			echo  $this->makeTable($this->data);;
			//redirect('members');

		}
	}
	public function reportMember(){
		$url = $this->config->item('serv_url').'/backend/users/members';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		$this->data = $res;

		$data['page_title'] = 'ANYBABA|MEMBERS';
		$data['link_add'] = '/auth/signupMember';
		$data['type'] = 'Member';
		$data['table'] = $this->makeTableReport($this->data);
		$this->load->view('partials/backend/header', $data);
		$this->load->view('partials/backend/navbar');
		$this->load->view('partials/backend/tableMember');
		$this->load->view('partials/backend/form/members');
		$this->load->view('partials/backend/footer');
		$this->load->view('partials/backend/script/members');	
	}

}
