
<html lang="en">
<head>
  <title>Checkout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
// To conform clear all data in cart.
function clear_cart() {
var result = confirm('Are you sure want to clear all bookings?');

if (result) {
window.location = "<?php echo base_url(); ?>index.php/shopping/remove/all";
} else {
return false; // cancel button
}
}
</script>
 

 </head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle"
data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="color:white" href="#">Welcome to CheapBooks.com</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
      </ul>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
		<?php echo form_open("Welcome_ShopController/logOut");?>
            <div class="form-group">
			<?php $cart_check = $this->cart->contents();?>	
			
	        <button type="submit" class="btn btn-info " name="logOut"><span class="glyphicon glyphicon-log-out"></span> Log Out</button>
          </div>
		  </form>
        </div>
    </div>
  </div>
</nav>

<!-- End of header -->
<br /><br />
    <div class="topSpacing"></div>


<div class="container">
<div id='content'>

<div id="cart"  >
<?php echo form_open("Welcome_ShopController/index");?>
<button style="margin-left:130px" type="submit" class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping </button></td>
<?php echo form_close(); ?>

<div id = "heading" style ="margin-bottom:40px">
<h2 align="center">Shopping Cart items</h2>
</div>

<div id="text" style="text-align:center;color:red">
<?php $cart_check = $this->cart->contents();

// If cart is empty, this will show below message.
if(empty($cart_check)) {
echo 'Click continue shopping for adding items to cart';
} ?> </div>

<table id="table" class="table" style="margin-left:130px">
<?php
// All values of cart store in "$cart".
if ($cart = $this->cart->contents()): ?>
<tr id= "main_heading">
<td bgcolor="#FF0000"><b>ISBN</b></td>
<td bgcolor="#FF0000"><b>book Name<b></td>
<td bgcolor="#FF0000"> <b>Price</b></td>
<td bgcolor="#FF0000"><b>Qantity</b></td>
<td bgcolor="#FF0000" style="width: 280px;
    overflow: hidden;
    display: inline-block;
    white-space: nowrap;"><b>Price</b></td>
</tr>
<?php
// Create form and send all values in "shopping/update_cart" function.
echo form_open('shopping/update_cart');
$grand_total = 0;
$i = 1;

foreach ($cart as $item):
// echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
// Will produce the following output.
// <input type="hidden" name="cart[1][id]" value="1" />

echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
?>
<tr>
<td>
<?php echo $item['id']; ?>
</td>
<td>
<?php echo $item['name']; ?>
</td>
<td>
$ <?php echo number_format($item['price'], 2); ?>
</td>
<td>
<?php echo  number_format($item['qty']); ?>
</td>
<?php $grand_total = $grand_total + $item['subtotal']; ?>
<td style="width: 280px;
    overflow: hidden;
    display: inline-block;
    white-space: nowrap;">
$ <?php echo number_format($item['subtotal'], 2) ?>
</td>

<?php endforeach; ?>
</tr>
<tr class="noBorder">
<td class=" bottomBorderOnly"></td>

<td></td>
<td></td>
<td></td>

<?php // "clear cart" button call javascript confirmation message ?>
<td style="width: 280px;
    overflow: hidden;
    display: inline-block;
    white-space: nowrap;">
<b>Total Price: $<?php

//Grand Total.
echo number_format($grand_total, 2); ?></b>
<?php //submit button. ?>

<?php echo form_close(); ?>
<?php echo form_open("Welcome_ShopController/buyDone");?>
<button type="submit" class="pull-left btn btn-info" style="display:inline-block;
min-width: 50px;
width: 200px;
padding:5px 10px;margin-top:10px" name="btnCheckOut">Buy</button> 
<?php echo form_close(); ?>
<!-- "Place order button" on click send "billing" controller --><br>
</td>
</tr>
<?php endif; ?>
</table>
</div>
</div></div>
</body>
</html>