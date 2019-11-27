<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

?>
<?php

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$client_username = $_SESSION['user'] ;
$quantity = $_POST['quantity'] ;
$item_id = $_POST['hidden_name'] ;

		
$query_reg = "select * from cart where client_username='$client_username' && item_id = '$item_id' ";

$result = mysqli_query($conn,$query_reg);
$num_reg = mysqli_num_rows($result);

		$query = "select qty_current from inventory where item_id='$item_id'";
		$result = mysqli_query($conn,$query);
		$value = mysqli_fetch_object($result);
		$qty_current = $value->qty_current ;

		if($quantity > $qty_current){
			echo "<script>					
		alert('Quantity Entered Is Not available');
		window.location.href='client_home.php';
		</script>";
		}

else if($num_reg >0 or $quantity <= 0 ){

	echo "<script>					
		alert('Item Is Already In Cart / Item cannot be added');
		window.location.href='client_home.php';
		</script>";
}

else{

		$query_reg = "insert into cart (client_username,item_id,item_qty) values ('$client_username','$item_id','$quantity')";
		mysqli_query($conn,$query_reg);
		echo "<script>					
		alert('!! Item Added To Cart !! ');
		window.location.href='client_home.php';
		</script>";
}

?>