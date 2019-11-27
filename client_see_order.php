<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

?>

<!DOCTYPE html>
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
	<title>See Previous Orders </title>
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

	<button onclick="location.href='client_home.php'" type="button" class ="btn btn-primary"> Go Back </button>

<div class="container">

	<div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Orders Placed</h3>

            </div>
            <table class="table">
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Order Id" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Item Id" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Item Qty" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Order Amount" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Order Status" disabled></th>
                    </tr>

		<?php
			$conn = mysqli_connect("localhost","root","","rbms");

			if($conn-> connect_error) {
				die("Connection Failed:". $conn-> connect_error);
			}

			$client_username=$_SESSION['user'] ;

			$query = "select order_id,item_id,item_qty,amount,order_status from orders where client_username='$client_username'";
			$result = $conn-> query($query);

			if($result-> num_rows >0){
				while($row = $result-> fetch_assoc()){
					echo "<tr><td>". $row["order_id"]."</td><td>".$row["item_id"]."</td><td>". $row["item_qty"]."</td><td>". $row["amount"]."</td><td>". $row["order_status"]."</td></tr>";
				}
				echo"</table>";
			}
			else{
				echo "0 Result";
			}

			$conn-> close()	
		?>

	</table>

</body>
</html>