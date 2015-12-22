<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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
		<th>Status</th>
		<th>Price</th>
		<th>Updated At</th>
		<th>Image</th>
		<th>Actions</th>
		</tr></thead><tbody>';

		foreach($res as $row){
			
			$updated = date("l, d-m-Y", strtotime($row['updated_at']));
			$created = date("l, d-m-Y", strtotime($row['created_at']));
			$editProduct = site_url().'/products/edit/'.$row['id'];
			$buttonEdit = '			
			<div class="btn-group">
			<a href="'.$editProduct.'" type="button" class="btn btn-primary btn-lg actionTable"  data-item-id="'.$row['id'].'"><span data-item-id="'.$row['id'].'" class="fui-new"></span></a>
			<a type="button" class="btn btn-danger btn-lg actionTable" data-toggle="modal" data-target="#deleteModal"  data-item-id="'.$row['id'].'" ><span  data-item-id="'.$row['id'].'" class="fui-trash" ></span></button>
			</div>';
			$result .= '<tr>';
			$result .= '<td>'.$row['name'].'</td>';
			$result .= '<td>'.$row['status'].'</td>';
			$result .= '<td>'.$row['price'].'</td>';
			$result .= '<td>'.$updated.'</td>';
			$result .= '<td> <img class="img-responsive" src="'.$row['picture_name'].'"></td>';
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
	public function delete($id){
			$url = $this->config->item('serv_url').'/backend/products/delete/'.$id;
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$this->session->set_flashdata('message', $res['Message']);
			redirect('/products/');
		
	}
	public function add(){

		$input = $this->input->post();
		if($input){
			$input = $input['item'];
			$url = $this->config->item('serv_url').'/backend/products/add';
			$response = \Httpful\Request::post($url)
			->body(json_encode($input))
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$res =json_decode($response, true);
			$this->session->set_flashdata('message', $res['Message']);
			redirect('/products/');
		}else{
			$data['page_title'] = 'ANYBABA|ADD PRODUCTS';
			$data['type'] = 'Products';
			$data['title'] = 'Add New Product';
			$this->load->view('partials/backend/header', $data);
			$this->load->view('partials/backend/navbar');
			$this->load->view('partials/backend/form/products');
			$this->load->view('partials/backend/footer');
			$this->load->view('partials/backend/script/products');	
		}
		
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
