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
$item_id = $_POST['remove_item_id'] ;
			
		echo $_SESSION['user'] ;

		//$query_reg = "insert into cart (client_username,item_id,item_qty) values ('$client_username','$item_id','1')";
		$query_reg = "delete from cart where client_username='$client_username' and item_id=$item_id ";
		mysqli_query($conn,$query_reg);
		echo "<script>					
		alert('!! Item Removed !! ');
		window.location.href='client_cart.php';
		</script>";

?>