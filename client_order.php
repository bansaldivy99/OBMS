<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

?>

<?php

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$client_username=$_SESSION['user'] ;

		$query = "SELECT * FROM cart where client_username='$client_username'";	

		$result = mysqli_query($conn, $query);

		$num=mysqli_num_rows($result);

		if($num<=0){
			echo "<script>					
		alert('!! No Item In Cart !! ');
		window.location.href='client_home.php';
		</script>";
		}
		else {
		while($num > 0)
		{

		$query = "SELECT * FROM cart where client_username='$client_username'";	
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		$num=mysqli_num_rows($result);

		$item_id=$row["item_id"];
		$item_qty=$row["item_qty"];

		$query = "select price from inventory where item_id='$item_id' limit 1";
		$result = mysqli_query($conn,$query);
		$value = mysqli_fetch_object($result);
		$amount = $value->price*$item_qty ;

		$query = "select salesman_username from inventory where item_id='$item_id' limit 1";
		$result = mysqli_query($conn,$query);
		$value = mysqli_fetch_object($result);
		$salesman_username = $value->salesman_username ;

		$query = "select qty_current from inventory where item_id='$item_id' limit 1";
		$result = mysqli_query($conn,$query);
		$value = mysqli_fetch_object($result);
		$qty_current = $value->qty_current ;
		$qty_current=$qty_current-$item_qty ;

		$query = "select qty_sold from inventory where item_id='$item_id' limit 1";
		$result = mysqli_query($conn,$query);
		$value = mysqli_fetch_object($result);
		$qty_sold = $value->qty_sold ;
		$qty_sold=$qty_sold+$item_qty ;

		$query_reg = "insert into orders (client_username, item_id, item_qty, amount,salesman_username) values ('$client_username','$item_id','$item_qty','$amount','$salesman_username')";
		mysqli_query($conn,$query_reg);

		$query_reg = "update inventory set qty_current='$qty_current' where item_id='$item_id' ";
		mysqli_query($conn,$query_reg);

		$query_reg = "update inventory set qty_sold='$qty_sold' where item_id='$item_id' ";
		mysqli_query($conn,$query_reg);

		$query_reg = "delete from cart where client_username='$client_username' and item_id=$item_id ";
		mysqli_query($conn,$query_reg); 


		$num=$num-1;

	}


	echo "<script>					
		alert('!! Order Placed !! ');
		window.location.href='client_cart.php';
		</script>";
	}
?>