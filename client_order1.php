<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$item_id = $_POST['item_id'] ;
$item_qty = $_POST['item_qty'] ;
$client_username=$_SESSION['user'] ;

$query = "select price from inventory where item_id='$item_id' limit 1";
$result = mysqli_query($conn,$query);
$value = mysqli_fetch_object($result);
$amount = $value->price*$item_qty ;

$query = "select salesman_username from inventory where item_id='$item_id' limit 1";
$result = mysqli_query($conn,$query);
$value = mysqli_fetch_object($result);
$salesman_username = $value->salesman_username ;

$query = "select item_id from inventory where item_id='$item_id'";

 $result = mysqli_query($conn,$query);

    if (!$result) {
        echo "Could not successfully run query ($query) from DB: " . mysqli_error();
        exit;
    }
    
    if (mysqli_num_rows($result) == 0) {

    	echo "<script>
		alert('Item Id Entered Is Not There Please Enter Correct Item Id ');
		window.location.href='client_home.php';
		</script>";

    }else{
		$query_reg = "insert into orders (client_username, item_id, item_qty, amount,salesman_username) values ('$client_username','$item_id','$item_qty','$amount','$salesman_username')";
		mysqli_query($conn,$query_reg);
		echo "<script>
		alert('Order Is Placed');
		window.location.href='client_home.php';
		</script>";
	}

?>