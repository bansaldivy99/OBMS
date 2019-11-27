<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$user_val = $_POST['user_val'] ;
$pass_val = $_POST['pass_val'] ;

$pass_val = md5($pass_val) ; //added


$query_reg = "select * from client where username='$user_val' && password = '$pass_val' ";

$result = mysqli_query($conn,$query_reg);
$num_reg = mysqli_num_rows($result);


if($num_reg ==1){
	$_SESSION['user'] = $user_val;
	header('location:client_home.php');
}else{
	echo "<script>					
		alert('Username / Password Incorrect Login Again');
		window.location.href='client_login.php';
		</script>";
}




?>