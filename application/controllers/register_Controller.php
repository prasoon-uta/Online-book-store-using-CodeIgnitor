<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Controller extends CI_Controller {

	 
	 	 public function __construct()
{
parent::__construct();
//Load Library and model.
$this->load->library('session');
$this->load->helper('url');
}
	 
	public function index()
	{
		$this->load->view('register');
	}
	
	
	
	
	public function register()
	{
		$username=$this->input->post('username');
		$pass=$this->input->post('password');
		$address=$this->input->post('address');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		
		$this->load->model('registerModel');
		$this->registerModel->registeruser($username,$pass,$address,$phone,$email);
	    
		$_SESSION['username']=$this->input->post('username');
	    redirect('Welcome_ShopController/index');
	
	
	}
	public function newUser()
	{
	$this->load->view('register');		
	}
	

	
}
?>