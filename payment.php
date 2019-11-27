<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link rel='stylesheet' href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>Place Order</title>


</head> 

<body>

<div class='container'>

	<fieldset><legend><b>Order Details</b></legend>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='get'>
			<label for='textarea'>Address: </label><textarea id='textarea' name='address' required></textarea><br>
			<label for='phone'>Phone: </label><input type=text name='phone' class='formInputItem' required><br>
			<label for='payment'>Payment: </label><input type=radio name='payment' value='online' required> Online
			 								<input type=radio name='payment' value='COD' required> Cash On Delivery<br>
			<p>Total Amount:   <?php echo $totalPrice."&#8377;</p>"; ?>
			<label></label><button style='width:250px;height:5em;' type='submit' class='goBtn' name='submit' value='<?php echo $totalPrice; ?>'>Place Order</button>

		</form>	
	</fieldset>

	<?php
		if(isset($_GET['submit'])){
			$totalPrice=$_GET['submit'];
			$address=$_GET['address'];
			$phone=$_GET['phone'];
			$payment=$_GET['payment'];
			$custID=$_SESSION['loginUser'];
			$sql="insert into transaction(transaction_amount,customer_id,phone,address,payment,date) values('$totalPrice','$custID','$phone','$address','$payment',current_date())";
			$result=mysqli_query($conn,$sql);
			$sql="delete from cart where customer_id='$custID'";
			$result=mysqli_query($conn,$sql);
			echo "<script>alert('Order placed.\\nThe products will be delivered within 5 hours.');</script>";
			header("refresh:0;url=order.php");
		}

		?>
		</div>
</body>
</html>

