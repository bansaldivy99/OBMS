<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$item_name = $_POST['item_name'] ;
$item_price = $_POST['item_price'] ;
$image_name = $_POST['image_name'] ;
$qty_current = $_POST['qty_current'] ;

$salesman_username=$_SESSION['user'];

 $query = "select item from inventory where item='$item_name'";
 $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) > 0 ) {

    	echo "<script>
		alert('Item is Already Present');
		window.location.href='salesman_home.php';
		</script>";

    }else {
		$query_reg = "insert into inventory (item, price, salesman_username,image,qty_current) values ('$item_name','$item_price','$salesman_username','$image_name','$qty_current')";
		mysqli_query($conn,$query_reg);
		echo "<script>
		alert('Item Added');
		window.location.href='salesman_home.php';
		</script>";
	}

?>