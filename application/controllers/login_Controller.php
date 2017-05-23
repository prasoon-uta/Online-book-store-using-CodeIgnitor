<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {

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
$this->load->library('session');
$this->load->helper('url');
}
	 
	public function index()
	{
		$this->load->view('login');
	}
	public function checkLogin(){
		
		$this->form_validation->set_rules('username','Username,required');
		$this->form_validation->set_rules('password','Password','required|callback_verifyUser');
		
		if($this->form_validation->run() == false){
		
		$this->load->view('login');	
		}else{
			$_SESSION['username']=$this->input->post('username');
				redirect('Welcome_ShopController/index');
		}
	}
	
	public function verifyUser(){
		$name=$this->input->post('username');
		$pass=$this->input->post('password');
		
		$this->load->model('loginModel');
		
		if($this->loginModel->login($name,$pass)){
			return true;
		}else{
			$this->form_validation->set_message('verifyUser','Incorrect username/password');
			return false;
		}
	}
	
	
	public function newUser()
	{
	redirect('register_Controller/index');		
	}
	

	
}
?>