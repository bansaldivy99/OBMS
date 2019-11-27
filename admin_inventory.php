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
	<title>Add Items in Stock</title>
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

	<button onclick="location.href='admin_home.php'" type="button" class ="btn btn-primary"> Go Back </button>
</div>
	<br>
	<div class="container">

	<div class="row">


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
		<h4 class="text-danger">Item Sold - <?php echo $row["qty_sold"]; ?></h4>
		<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
		<h4 class="text-info"><?php echo $row["item"]; ?></h4>
		<h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>
		<h4 class="text-info">Quantity available - <?php echo $row["qty_current"]; ?></h4>
  		<h4 class="text-danger">Sold By <?php echo $row["salesman_username"]; ?></h4>

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