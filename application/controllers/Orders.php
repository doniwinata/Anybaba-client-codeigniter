<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

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
		
		if(!$this->session->userdata('credentials'))
		{
			redirect('auth/login');
		}
		
                // Your own constructor code
	}
	public function makeHistories($res)
	{
		$result = '<thead><tr>
		<th>Code</th>
		<th>Total</th>
		<th>Order Date</th>
		<th>Status</th>
		<th>Actions</th>
		</tr></thead><tbody>';

		foreach($res as $row){
			
			$created = date("l, d-m-Y", strtotime($row['created_at']));
			$detail = site_url().'/orders/detail/'.$row['code'];
			$paid = site_url().'/orders/paid/'.$row['code'];
			$buttonEdit = '			
			<div class="btn-group">
			<a href="'.$paid.'" type="button" class="btn btn-primary btn-lg actionTable"  data-item-id="'.$row['code'].'">Paid</a>
			';
			$result .= '<tr>';
			$result .= '<td>'.$row['code'].'</td>';
			$result .= '<td>'.$row['total'].' $ </td>';
			$result .= '<td>'.$created.'</td>';
			$result .= '<td>'.$row['status'].'</td>';
			$result .= '<td>'.$buttonEdit.'</td>';
			$result .= '</tr>';
		}
		return $result;
	}


	public function index()
	{
		$url = $this->config->item('serv_url').'/backend/products/';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		$this->data = $res;

		$data['page_title'] = 'ANYBABA|PRODUCTS';
		//$data['link_add'] = '/products/add';
		$data['type'] = 'Products';
		$data['addLink'] = site_url().'/products/add';

		$data['table'] = $this->makeTable($this->data);
		$this->load->view('partials/backend/header', $data);
		$this->load->view('partials/backend/navbar');
		$this->load->view('partials/backend/table');
		//$this->load->view('partials/backend/form/products');
		$this->load->view('partials/backend/footer');
		$this->load->view('partials/backend/script/products');	
	}
	public function history(){
		$url = $this->config->item('serv_url').'/backend/orders/histories/'.$this->session->id;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		print_r($res);exit();
		//$data['table'] = $this->makeTable($this->data);
		$data['histories'] = $this->makeHistories($res);
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/home');
		//$this->load->view('partials/backend/form/products');
		$this->load->view('partials/footer');

		
	}
	
	public function getCarts(){
		$url = $this->config->item('serv_url').'/backend/carts/find/'.$this->session->id;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		if(!isset($res['Error']))
		{
			return $response;
		}else{
			return  false;
		}

	}
	public function orderCarts(){
		$url = $this->config->item('serv_url').'/backend/orders/'.$this->session->id;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		$this->session->set_flashdata('message', $res['Message']);
		redirect('/');
		
		
		
	}

	public function edit($id){
		$input = $this->input->post();
		if($input){
			$input = $input['item'];
			$url = $this->config->item('serv_url').'/backend/products/edit';
			$response = \Httpful\Request::post($url)
			->body(json_encode($input))
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$res =json_decode($response, true);
			$this->session->set_flashdata('message', $res['Message']);
			redirect('/products/');
		}else{
			$url = $this->config->item('serv_url').'/backend/products/find/'.$id;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$res =json_decode($response, true);

			$data['page_title'] = 'ANYBABA|EDIT PRODUCTS';
			$data['type'] = 'Products';
			$data['title'] = 'Edit Product';
			$data['data'] = $res[0];
			$this->load->view('partials/backend/header', $data);
			$this->load->view('partials/backend/navbar');
			$this->load->view('partials/backend/form/products');
			$this->load->view('partials/backend/footer');
			$this->load->view('partials/backend/script/products');	
		}
		
		

	}
	public function update(){

	}

}
