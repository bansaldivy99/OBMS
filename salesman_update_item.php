<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$item_id = $_POST['hidden_name'] ;
$qty_current = $_POST['qty_current_update'] ;
$salesman_username=$_SESSION['user'];

 $query = "select item from inventory where item_id='$item_id'";
 $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) <= 0 ) {

    	echo "<script>
		alert('Item is Not Present');
		window.location.href='salesman_home.php';
		</script>";

    }else {
		$query_reg = "update inventory set qty_current='$qty_current' where item_id='$item_id'";
		mysqli_query($conn,$query_reg);
		echo "<script>
		alert('Item Qty Updated');
		window.location.href='salesman_home.php';
		</script>";
	}

?>