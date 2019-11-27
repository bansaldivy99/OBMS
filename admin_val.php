<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$user = $_POST['user'] ;
$pass = $_POST['pass'] ;

$pass = md5($pass) ; //added


$query_reg = "select * from admin where username='$user' && password = '$pass' ";

$result = mysqli_query($conn,$query_reg);
$num_reg = mysqli_num_rows($result);


if($num_reg ==1){
	$_SESSION['user'] = $user;
	header('location:admin_home.php');
}else{
		echo "<script>					
		alert('Username / Password Incorrect Login Again');
		window.location.href='admin_login.php';
		</script>";
}


?>