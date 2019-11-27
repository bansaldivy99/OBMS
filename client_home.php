<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

?>

<html>
<head>
			<style>
body {
  background-image: url('images/bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css.css"> 
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style >
        .filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

    </style>
</head>
<body>
	<div class="container">

	<a href="client_logout.php"> LOGOUT </a>
	<h1>Welcome User <?php echo $_SESSION['user']; ?> </h1>

	<button onclick="location.href='client_cart.php'" type="button" class ="btn btn-primary"> View Cart</button>
	<button onclick="location.href='client_see_order.php'" type="button" class ="btn btn-primary">Previous Orders Placed </button>

</div>
<br>


<div class="container">





		<?php
		$connect = mysqli_connect("localhost","root","","rbms");
		$query = "SELECT * FROM inventory";
		$result = mysqli_query($connect, $query);
		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		?>
		<div class="col-md-4">
		<form method="post" action="client_add_cart.php">
		<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">

		<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
 
		<h4 class="text-info"><?php echo $row["item"]; ?></h4>
 
		<h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>
 
		<input type="text" name="quantity" value="1" class="form-control" />
 
		<input type="hidden" name="hidden_name" value="<?php echo $row["item_id"]; ?>" />
 
		<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
 
		<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
 
		</div>
		</form>
		</div>
		<?php
		}
		}
		?>
		<div style="clear:both"></div>
		<br />







</body>
</html>