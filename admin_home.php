 <?php

session_start();
if($_SESSION['user']==NULL || $_SESSION['user']!='admin'){
	header('location:admin_login.php');
}

?>

<html>
<head>
	<title>Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css.css"> 

		<style>
body {
  background-image: url('images/bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
</head>

<body>



	<div class="container">

	<a href="admin_logout.php"> LOGOUT </a>
	<h1>Welcome <?php echo $_SESSION['user']; ?> </h1>
	<h2> Available Functions </h2>
	<button onclick="location.href='admin_inventory.php'" type="button" class ="btn btn-primary"> Inventory </button>
	<button onclick="location.href='admin_orders.php'" type="button" class ="btn btn-primary"> See Orders Placed </button>

	</div>
</body>
</html>