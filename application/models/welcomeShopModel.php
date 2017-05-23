<?php

class WelcomeShopModel extends CI_Model{
	
public	function get_search()
{
$this->load->database();
$match=$this->input->post('search');
$button=$this->input->post('btn');
//$match='Web data mang';
//$match = $this->input->post(‘search’);

if($button=='btnTitle')
$sql = "SELECT * FROM `book` WHERE `title` LIKE  '%$match%' ";
else if($button=='btnAuthor')
$sql="SELECT `author`.`name`, `book`.* FROM `author` LEFT JOIN `writtenby` ON `author`.`SSN` = `writtenby`.`SSN` LEFT JOIN `book` ON `writtenby`.`ISBN` = `book`.`ISBN` WHERE (( `name` LIKE '%$match%'))";
else
$sql = "SELECT * FROM `book` WHERE `title` LIKE  '' ";	
$query =$this->db->query($sql);

//$query = $this->db->get('book');
return $query->result();
}

public function cartUpdate()	
{
	$data = array(
        'basketId' => NULL,
        'username' => $_SESSION['username']
        
);
$this->db->insert('ShoppingBasket', $data);
if ($cart = $this->cart->contents()): 
foreach ($cart as $item):
$sql ='SELECT * FROM ShoppingBasket where `username`="'.$_SESSION['username'].'"';
$query =$this->db->query($sql);

foreach($query->result() as $index=>$item1) {
    $_SESSION['basketID']=$item1->basketId;   
    }
	 
	 
	 $stmtStock = "SELECT * FROM `stocks` WHERE `ISBN` LIKE '".$item['id']."'";
	 $query1 =$this->db->query($stmtStock);
	 foreach($query1->result() as $index=>$result) {
		 if($item['qty'] <= $result->number)
		 {
			 //Update Contains table
			$dataContains = array(
        'ISBN' => $item['id'],
        'basketID' => $_SESSION['basketID'],
		'number'=>$item['qty']
        
); 
  $this->db->insert('Contains', $dataContains);
		 
		 //Filling shipping information
		 $dataShip = array(
        'ISBN' => $item['id'],
        'warehouseCode' => $result->warehouseCode,
		'username'=>$_SESSION['username'],
		'number'=>$item['qty']
        
);
 $this->db->insert('shippingorder', $dataShip);
 
 //Update stock in the warehouse
		 $dataWarehouse = array(
        'number' => $result->number-$item['qty'],
                
);
   
    $this->db->where('warehouseCode',$result->warehouseCode);
	$this->db->update('stocks', $dataWarehouse);
		 
		 break;
		 
		 }
	 }
 endforeach; 
endif;
}

}


?>