<?php

class LoginModel extends CI_Model{
	
	public function login($username,$password){
		$this->db->select('username,password');
		$this->db->from('customer');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		
		$query=$this->db->get();
		
		if($query->num_rows()==1)
		{
			return true;
		}else
		{
			return false;
		}
		
	}
	
	public function registerUser($username,$pass,$address,$phone,$email)
	{
		//Filling user information
		 $dataUser = array(
        'username' => $username,
        'password' => $pass,
		'address'=>$address,
		'phone'=>$phone,
		'email'=>$email
        
);
 $this->db->insert('customer', $dataUser);
	}
}


?>