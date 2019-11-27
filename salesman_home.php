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
	<title>Salesman Home Page</title>
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

<div class="container">

	<a href="client_logout.php"> LOGOUT </a>
	<h1>Welcome Seller <?php echo $_SESSION['user']; ?> </h1>
<div>
	<button onclick="location.href='salesman_order_placed.php'" type="button" class ="btn btn-primary"> Orders </button>
</div>
<br>

<div class="container">

	<div class="row">


		<?php
		$connect = mysqli_connect("localhost","root","","rbms");

		$salesman_username=$_SESSION['user'];

		$query = "SELECT * FROM inventory where salesman_username= '$salesman_username' ";
		$result = mysqli_query($connect, $query);
		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		?>
		<div class="col-md-4">
		<form method="post" action="salesman_update_item.php">
		<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">

		<h4 class="text-danger">Item Sold - <?php echo $row["qty_sold"]; ?></h4>

		<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
		<h4 class="text-info"><?php echo $row["item"]; ?></h4>
		<h4 class="text-info">Quantity available - <?php echo $row["qty_current"]; ?></h4>
		<h4 class="text-danger">Price Rs. <?php echo $row["price"]; ?></h4>
		<input type="text" name="qty_current_update" value="10" class="form-control" />
		<input type="hidden" name="hidden_name" value="<?php echo $row["item_id"]; ?>" />
		<input type="submit" name="update_current_qty" style="margin-top:5px;" class="btn btn-success" value="Update Quantity" />

		</div>
		</form>
		</div>
		<?php
		}
		}
		?>
		<div style="clear:both"></div>
		<br>

<div class = "col-lg-6">
				<h2> Fill The Form To Add Item </h2>
				<form action="salesman_add_item.php" method="post">
					<div class="form-group">
						<label> Item Name </label>
						<input type="text" name="item_name" class="form-control" required>
					</div>

					<div class="form-group">
						<label> Item Price </label>
						<input type="text" name="item_price" class="form-control"required>
					</div>

					<div class="form-group">
						<label> Image Name </label>
						<input type="text" name="image_name" class="form-control"required>
					</div>

					<div class="form-group">
						<label> Item Quantity </label>
						<input type="text" name="qty_current" class="form-control"required>
					</div>

					<button type="submit" name="item_add" class ="btn btn-primary"> Add Item </button>
				</form>	

	</div>


</body>
</html>