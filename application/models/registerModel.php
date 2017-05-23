<?php

class RegisterModel extends CI_Model{
	
	
	
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