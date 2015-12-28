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
	

	public function manage($type)
	{
		if($type == 'ordering' ||$type == 'paid' ||$type == 'finished'){
			$url = $this->config->item('serv_url').'/backend/orders/manage/'.$type;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			//print_r($url);
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$res =json_decode($response, true);
			$this->data = $res;

			$data['page_title'] = 'ANYBABA|$type';
		//$data['link_add'] = '/products/add';
			$data['type'] = 'Products';

			$data['table'] = $this->makeTableOrder($this->data);
			$this->load->view('partials/backend/header', $data);
			$this->load->view('partials/backend/navbar');
			$this->load->view('partials/backend/tableOrder');
		//$this->load->view('partials/backend/form/products'); 
			$this->load->view('partials/backend/footer');
			$this->load->view('partials/backend/script/products');	
		}
		else{
			echo 'invalid url';
		}
	}

	public function reportOrder($type)
	{
		if($type == 'ordering' ||$type == 'paid' ||$type == 'finished'){
			$url = $this->config->item('serv_url').'/backend/orders/manage/'.$type;
			// [ req.body.email, hash, req.body.credentials, req.body.first_name, req.body.last_name];
			//print_r($url);
			$response = \Httpful\Request::get($url)
			->addHeader('x-access-token', $this->config->item('token')) 
			->sendsJson()->send(); 
			$res =json_decode($response, true);
			$this->data = $res;

			$data['page_title'] = 'ANYBABA|$type';
		//$data['link_add'] = '/products/add';
			$data['type'] = 'Products';

			$data['table'] = $this->makeTableOrder($this->data,'report');
			$this->load->view('partials/backend/header', $data);
			$this->load->view('partials/backend/navbar');
			$this->load->view('partials/backend/tableOrderReport');
		//$this->load->view('partials/backend/form/products'); 
			$this->load->view('partials/backend/footer');
			$this->load->view('partials/backend/script/products');	
		}
		else{
			echo 'invalid url';
		}
	}

	

	public function makeTableOrder($res,$type = 'manage')
	{
		$result = '<thead><tr>
		<th>Code</th>
		<th>Total</th>
		<th>Order Date</th>
		<th>Status</th>';
		if($type == 'manage'){
		$result .='<th>Actions</th>';
		}
		$result.= '</tr></thead><tbody>';

		foreach($res as $row){
			
			$created = date("l, d-m-Y", strtotime($row['created_at']));
			$detail = site_url().'/orders/detail/'.$row['code'];

			$paid = site_url().'/orders/paid/'.$row['code'];
			$finished = site_url().'/orders/finished/'.$row['code'];
			$ordering = site_url().'/orders/ordering/'.$row['code'];
			$buttonEdit = '			
			<div class="btn-group">
			<a type="button" class="btn btn-info btn-lg actionTable" href="'.$detail.'"><span  class="fui-search"></span>Detail</button>';
			$buttonEdit.= $row['status'] != 'ordering' ? '<a type="button" class="btn btn-primary btn-lg actionTable" href="'.$ordering.'"><span  class="fui-time"></span> Ordering</button>' :'';
			$buttonEdit.= $row['status'] != 'paid' ? '<a type="button" class="btn btn-success btn-lg actionTable" href="'.$paid.'"><span  class="fui-check"></span> Paid</button>':'';
			$buttonEdit.= $row['status'] != 'finished' ? '<a type="button" class="btn btn-danger btn-lg actionTable" href="'.$finished.'"><span  class="fui-star"></span> Finished</button>':'';
			$buttonEdit.='</div>';
			if($type != 'manage'){
				$buttonEdit = '			
			<div class="btn-group">
			<a type="button" class="btn btn-info btn-lg actionTable" href="'.$detail.'"><span  class="fui-search"></span>Detail</button></div>';
		
			}
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
	public function detail($orderCode){
		$data =  $this->getOrder($orderCode);
		$data['page_title'] = 'ANYBABA|EDIT PRODUCTS';
			$data['type'] = 'Products';
			$data['title'] = 'Edit Product';
			//$data['data'] = $res[0];
			$data['addLink'] = '';
			$this->load->view('partials/backend/header', $data);
			$this->load->view('partials/backend/navbar');
			$this->load->view('partials/backend/tableOrder');
			$this->load->view('partials/backend/footer');
		//	$this->load->view('partials/backend/script/products');	
	}
	public function getOrder($orderCode){
		$url = $this->config->item('serv_url').'/backend/orders/detail/'.$orderCode;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);

		//print_r($res);
		if(!isset($res['Error']))
		{
		
			return $this->makeDetail($res);
		}else{

			return   'No Data';
		}

	}

	public function makeDetail($res){		
		$conter= 0;
		$code = '';
		$created_at = '';
		$total = '';
		$email = '';
		$result = '<thead><tr>
		<th>Name</th>
		<th>Price</th>
		<th>Picture</th>
		</tr></thead><tbody>';
		$conter = 0;
		foreach($res as $row){
			$conter++;
			$created_at = date("l, d-m-Y", strtotime($row['created_at']));
			$code = $row['code'];
			$total = $row['total'];
			$email= $row['email'];
			$result .= '<tr>';
			$result .= '<td>'.$row['name'].'</td>';
			$result .= '<td>'.$row['price'].' $ </td>';
			$result .= '<td><img src="'.$row['picture_name'].'" width="50" height="50" /></td>';
			
			
			$result .= '</tr>';
		}
	
		$data = array();
		$data['table'] = $result;
		$data['total'] = $total;
		$data['code'] = $code;
		$data['email'] = $email;
		$data['created_at'] = $created_at;
		return $data;
	}

	public function paid($code){
		$url = $this->config->item('serv_url').'/backend/orders/status/paid/'.$code;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		$this->session->set_flashdata('message', $res['Message']);
		redirect('/orders/manage/ordering');
	}
	public function ordering($code){
		$url = $this->config->item('serv_url').'/backend/orders/status/ordering/'.$code;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		$this->session->set_flashdata('message', $res['Message']);
		redirect('/orders/manage/ordering');
	}
	public function finished($code){
		$url = $this->config->item('serv_url').'/backend/orders/status/finished/'.$code;
		$response = \Httpful\Request::get($url)
		->addHeader('x-access-token', $this->config->item('token')) 
		->sendsJson()->send(); 
		$res =json_decode($response, true);
		
		$this->session->set_flashdata('message', $res['Message']);
		redirect('/orders/manage/ordering');
	}

}
