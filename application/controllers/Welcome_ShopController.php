<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_ShopController extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 
	 public function __construct()
{
parent::__construct();
//Load Library and model.
$this->load->library('cart');
$this->load->model('welcomeShopModel');
}
	 
	 
	public function index()
	{
		
		$this->data['result'] = $this->welcomeShopModel->get_search();
$this->load->view('welcome_shop', $this->data);
	}
	
	public	function search()
{
$this->load->model('welcomeShopModel');
$this->data['result'] = $this->welcomeShopModel->get_search();
$this->load->view('welcome_shop', $this->data);
}


public function buy(){	
	$data=array(
	'id' => $this->input->post('id'),
	'qty' => $this->input->post('quantity'),
	'price' => $this->input->post('price'),
	'name' =>$this->input->post('name')	
		);
		$this->cart->insert($data);
		
		
		// This will show insert data in cart.
         redirect('Welcome_ShopController');
}

public function buyout()
	{
		
		$this->load->view('checkout');
	}
	
	public function buyDone()
	{
		$this->welcomeShopModel->cartUpdate();
		$this->cart->destroy();
        redirect('Welcome_ShopController');
	}
	
	public function logOut()
	{
		
		$this->cart->destroy();
        // remove all session variables
       session_unset();

       // destroy the session
       session_destroy(); 
	   redirect('login_Controller/index');
	}
}

?>