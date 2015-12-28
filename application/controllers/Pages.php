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
		$url = $this->config->item('serv_url').'/backend/products/';
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		$data['products'] = $this->makeProducts($res);
		if($this->session->has_userdata('credentials')){
			$cartData =  $this -> getCarts();
			$data['carts'] =$cartData['element'];
			$data['numcarts'] =$cartData['number']; 
		}
		
		$data['page_title'] = 'ANYBABA|HOME';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/home');
		$this->load->view('partials/footer');
	}
	public function deletecarts($id){
		$url = $this->config->item('serv_url').'/backend/carts/delete';
		$response = \Httpful\Request::post($url)
		->body('{"id":"'.$id.'"}')			
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		$this->session->set_flashdata('message', $res['Message']);
		redirect('/');

	}
	public function makeCarts($res){
		$orderLink = site_url().'/orders/orderCarts';
		$this->session->id;
		$element = '<ul class="dropdown-menu dropdown-cart" role="menu">';
		$conter= 0;
		foreach($res as $row){
			$conter++;
			
			$linkDelete = site_url().'/pages/deletecarts/'.$row['id'];
			$element .= ' 

			<li>
			<span class="item">
			<span class="item-left">
			<img width="60" height="60"  src="'.$row['picture_name'].'" alt="" />
			<span class="item-info">
			<span>'.$row['name'].'</span>
			<span>'.$row['price'].'$</span>
			</span>
			</span>
			<span class="item-right">
			<a href="'.$linkDelete.'" class="btn btn-xs btn-danger pull-right">x</a>
			</span>
			</span>
			</li>
			' ;
			
		}
		
		$element.='<li class="divider"></li>
		<li><a class="text-center" href="'.$orderLink.'">Order</a></li>
		</ul>';
		$element = $conter == 0 ? '': $element;
		$data = array();
		$data['number'] = $conter;
		$data['element'] =$element;
		return  $data;
	}
	public function getCarts(){
		$url = $this->config->item('serv_url').'/backend/carts/find/'.$this->session->id;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		//print_r($res);
		if(!isset($res['Error']))
		{

			return $this->makeCarts($res);
		}else{

			return   'No Data';
		}

	}

	public function makeProducts($res){
		$element = "";
		$conter= 0;
		foreach($res as $row){
			$conter++;
			if($conter%3 == 0){
				$element.= '<div class="row">';
			}
			$linkCarts = site_url().'/pages/addcarts/'.$row['id'];
			$element .= '<div class="col-md-4">
			<div class="products">
			<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="This is my title" data-caption="Some lovely red flowers" data-image="'.$row['picture_name'].'" data-target="#image-gallery">
			<img class="img-responsive" src="'.$row['picture_name'].'"  alt="Short alt text">
			</a>

			<h3 class="tile-title">'. $row['name'].' | '. $row['price'].'$</h3>
			<p>'.$row['description'].'</p>
			<p>
			<a class="btn btn-primary" href="'.$linkCarts.'" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a>
			</p>
			</div>
			</div>' ;
			if($conter%3 == 0){
				$element.= '</div>';
			}
			//$element.=$this->load->view('partials/product_element', $data);
		}
		return $element;

	}
	public function categories($type){
		//print_r($type);
		$url = $this->config->item('serv_url').'/backend/products/categories/'.$type;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		if(!isset($res['Error']))
		{
			$data['products'] = $this->makeProducts($res);
		}else{
			$data['products'] = 'No Data';
		}

		if($this->session->has_userdata('credentials')){
			$cartData =  $this -> getCarts();
			$data['carts'] =$cartData['element'];
			$data['numcarts'] =$cartData['number']; 
		}
		
		$data['page_title'] = 'ANYBABA|HOME';
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/home');
		$this->load->view('partials/footer');	
	}
	public function addcarts($id){
		$url = $this->config->item('serv_url').'/backend/carts/add';
		$response = \Httpful\Request::post($url)
		->body('{"products_id":"'.$id.'", "user_id":"'.$this->session->id.'"}')			
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		$this->session->set_flashdata('message', $res['Message']);
		redirect('/');
		//print_r($res);
		
	}

	public function history(){
		$url = $this->config->item('serv_url').'/backend/orders/histories/'.$this->session->id;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		$cartData =  $this -> getCarts();
		//print_r($cartData);exit();
		$data['carts'] =$cartData['element'];
		$data['numcarts'] =$cartData['number'];  
		$data['page_title'] = 'ANYBABA|Order History';

		$data['histories'] = $this->makeHistories($res);
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('partials/history');
		//$this->load->view('partials/backend/form/products');
		$this->load->view('partials/footer');

		
	}
	public function makeHistories($res)
	{
		$result = '<thead><tr>
		<th>Code</th>
		<th>Total</th>
		<th>Order Date</th>
		<th>Status</th>
		
		</tr></thead><tbody>';

		foreach($res as $row){
			
			$created = date("l, d-m-Y", strtotime($row['created_at']));
			$detail = site_url().'/orders/detail/'.$row['code'];
			$paid = site_url().'/orders/paid/'.$row['code'];
			
			$result .= '<tr>';
			$result .= '<td>'.$row['code'].'</td>';
			$result .= '<td>'.$row['total'].' $ </td>';
			$result .= '<td>'.$created.'</td>';
			$result .= '<td>'.$row['status'].'</td>';
			
			$result .= '</tr>';
		}
		return $result;
	}
	
}
