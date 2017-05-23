
<!DOCTYPE html>

<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 

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
      <a class="navbar-brand" href="#" style="color:white">Welcome to CheapBooks.com</a>
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
    
<!-- Search buttons -->
<div class="container" style="text-align:center">
        <div class="col-lg-12" style="margin-bottom:60px">
            <div style="margin-bottom:60px">
			<?php echo form_open("Welcome_ShopController/buyout");?>
			<div class="pull-right" style="margin-bottom:60px">
            <p class="lead snipp-title">
			
	    		<button type="submit" class="btn btn-info" name="buyout">
				<span class="glyphicon glyphicon-shopping-cart"></span> 
				(<?php if(!empty($cart_check)) { echo $this->cart->total_items();}else echo '0'; ?>) Shopping Basket</button>
	    	
			</p>
			</div>
			</form>
			</div>
			
			<div class="form-head" style="margin-bottom:20px;margin-left:150px">
              <h2>Search books</h2>
            </div>
			
		<?php $cart_check = $this->cart->contents();?>	
			<?php echo form_open("Welcome_ShopController/buyout");?>
			<div class="pull-right">
           
			</div>
			</form>	
            <div class="highlight">
			<div class="" style="margin-bottom:20px">
			<?php echo form_open('Welcome_ShopController/search',array('onsubmit' => 'return checkDifferance();'));?>
			
                <!--Title text box-->    
 <div class="form-group has-feedback" style="width:50%;margin-left:270px">
							
				<input type="text" class="form-control" id="search" name="search"/>
			
			<span class="glyphicon glyphicon-search form-control-feedback"></span>
                <br />
</div>
                <!--Filter button-->
				
				<button type="submit" class="btn btn-info" name="btn" value="btnAuthor">SearchByAuthor</button> 
                <button type="submit" class="btn btn-info" name="btn" value="btnTitle">SearchByBookTitle</button> <br>
            </form>
            <!--End of col-lg-12 highlight-->
            </div>
            
		</div>
	</div>


<?php
	?>
  <?php if($result): ?>
  <?php foreach($result as $index=>$item):?>
	<div class = "col-sm-3 ">
	 <?php
	 $dbh = new PDO("mysql:host=127.0.0.1;dbname=cheapbooks","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      $dbh->beginTransaction();     
	 //Query to find total stock
	  $stmtStock = $dbh->prepare("SELECT SUM(`number`) as stock FROM `stocks` WHERE `ISBN` LIKE '".$item->ISBN."'");
	  $stmtStock->execute(); 
	  while ($result = $stmtStock->fetch()){
		 $bookStock=$result['stock'];
	  }	   
     if($bookStock>0)
	 {
	?>
							<?php echo form_open("Welcome_ShopController/buy");?>
                            
                            <div class = "panel panel-default""style = "background-color:;border-radius:5px;padding:16px;" >
							
							
                            
                           <!--Book info-->
						   <div style = "text-align:center;width:100%;height:60pxcolor:white margin-top:5px">
                          <?php echo $item->title."<br>ISBN:".$item->ISBN."<br>In Stock:".$bookStock."<br>Price:$".$item->price ?> 
                          </div>
                            <br />
                            <!--ArtWork buttons-->
							<div style="margin-bottom:px;">
                          <center>                           
						   <!--Quantity-->
                            <div class="highlight">
                             <input type="number" name="quantity"  style="width:30%;margin-left:;margin-bottom:10px" class="form-control"  placeholder = "quantity" /> 
							
							
							
							 </div> 
                            <!--Wish link-->
                          <input type="hidden" name="hidden_title" value="<?php echo $item->title ?>" />
						  <input type="hidden" name="hidden_ISBN" value=<?php echo $item->ISBN ?> />
						  <input type="hidden" name="hidden_price" value=<?php echo $item->price ?> />
						  <?php echo form_hidden('id', $item->ISBN);?>
						  <?php echo form_hidden('name', $item->title); 
						  echo form_hidden('price', $item->price);
                           
						  ?>
                           <button type="submit" class="btn btn-info btn-lg btn-block" name="add_to_cart" style="margin-top:5px;margin-bottom:3px;"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button> 
                         </center> 
						 
                        <!--End of thumbnail-->
						</div>
						</div>
						</form>
	 <?php } ?>                  </div>
	<?php endforeach;?>
	<?php endif; ?>
	<?php
	
	
?>

<script>
function checkDifferance()
{
	
	if($.trim($("#search").val())=="")
		{
			alert("Enter Search value");
		return false;
		}
}

</script>
<!-- end div of container -->	
</div>

<!-- End Search buttons -->