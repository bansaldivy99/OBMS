<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$user_reg = $_POST['user_reg'] ;
$email_reg = $_POST['email_reg'] ;
$pass1_reg = $_POST['pass1_reg'] ;
$pass2_reg = $_POST['pass2_reg'] ;


$query_reg = "select * from client where username='$user_reg' or email = '$email_reg' ";

$result = mysqli_query($conn,$query_reg);
$num_reg = mysqli_num_rows($result);

if($pass2_reg!=$pass1_reg){
	echo "<script>					
		alert('Password Do Not Match Enter Again');
		window.location.href='client_login1.php';
		</script>";
}else{
	if($num_reg >=1){
		echo "<script>					
		alert(' Username / Email Already Exist or INCORRECT');
		window.location.href='client_login1.php';
		</script>";
	}else{

		$pass1_reg=md5($pass1_reg); //added

		$query_reg = "insert into client (username,email,password) values ('$user_reg','$email_reg','$pass1_reg')";
		mysqli_query($conn,$query_reg);
		echo "<script>					
		alert('!! Registration Succesfll Login Now !! ');
		window.location.href='client_login.php';
		</script>";
}
}



?>