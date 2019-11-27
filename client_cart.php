<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

?>
		

<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
		<style>
body {
  background-image: url('images/bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
	<link rel="stylesheet" type="text/css" href="bootstrap.css.css"> 
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script></head>
<body>

	<div class = "container">

		<div class="row">

    <button onclick="location.href='client_home.php'" type="button" class ="btn btn-primary"> Go Back </button>
</div>
<br>

   
		<?php
		$connect = mysqli_connect("localhost","root","","rbms");

		$client_username = $_SESSION['user'] ;


		$query = "SELECT cart.item_id as item_id ,item,price,image,item_qty FROM cart inner join inventory on inventory.item_id=cart.item_id and client_username='$client_username'";	

			$result = mysqli_query($connect, $query);

		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		?>
		<div class="col-md-4">
		<form method="post" action="client_update_cart.php">
		<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">

		<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
 
		<h4 class="text-info"><?php echo $row["item"]; ?></h4>
 
		<h4 class="text-danger">Price Rs. <?php echo $row["price"]; ?></h4>
		<h4 class="text-danger"> Qty -  <?php echo $row["item_qty"]; ?></h4>

		<h4 class="text-danger">Amount <?php echo $row["price"]*$row["item_qty"]; ?></h4>

 
		<input type="hidden" name="remove_item_id" value="<?php echo $row["item_id"]; ?>" />
 
		<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

		<input type="submit" name="remove" style="margin-top:5px;" class="btn btn-success" value="Remove" />


 
		</div>
		</form>
		</div>
		<?php
		}
		}
		?>


	</div>

	<br>

<div class="container">
	<div class="row">

	<button onclick="location.href='client_order.php'" type="button" class ="btn btn-primary"> Place Order </button>
</div>
</div>


</body>
</html>



