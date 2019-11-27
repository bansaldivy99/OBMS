<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Salesman Account Details </title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css.css">
</head>
<body>
	<p> My Salary Is </p>

	<?php
			$conn = mysqli_connect("localhost","root","","rbms");

			if($conn-> connect_error) {
				die("Connection Failed:". $conn-> connect_error);
			}

			$salesman_id = $_SESSION['user'] ;

			$query = "select salary from salesman where username = '$salesman_id'";
			$result = $conn-> query($query);
			$value = mysqli_fetch_object($result);
			$salary = $value->salary ;

			echo "$salary";

			$conn-> close()	
		?>

		


</body>
</html>