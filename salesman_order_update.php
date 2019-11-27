<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$order_id = $_POST['order_id'] ;
$order_status = $_POST['order_status'] ;
$salesman_username=$_SESSION['user'] ;

$query = "select order_id from orders where order_id ='$order_id' && salesman_username = '$salesman_username'";

 $result = mysqli_query($conn,$query);

    if (!$result) {
        echo "Could not successfully run query ($query) from DB: " . mysqli_error();
        exit;
    }
    
    if (mysqli_num_rows($result) == 0) {

    	echo "<script>					
		alert('Wrong Order Id');
		window.location.href='salesman_order_placed.php';
		</script>";

    }else{
		$query_reg = "update orders SET order_status = '$order_status'where order_id = $order_id;";
		mysqli_query($conn,$query_reg);
		echo "<script>
		alert('Order Status Updated');
		window.location.href='salesman_order_placed.php';
		</script>";
	}

?>