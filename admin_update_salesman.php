<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$salesman_id = $_POST['salesman_id'] ;
$salesman_salary = $_POST['salesman_salary'] ;

$query = "select id from salesman where id ='$salesman_id'";

 $result = mysqli_query($conn,$query);

    if (!$result) {
        echo "Could not successfully run query ($query) from DB: " . mysqli_error();
        exit;
    }
    
    if (mysqli_num_rows($result) == 0) {

    	echo "<script>					
		alert('Wrong Salesman Id');
		window.location.href='admin_see_salesman.php';
		</script>";

    }else{
		$query_reg = "update salesman SET salary = '$salesman_salary'where id = $salesman_id;";
		mysqli_query($conn,$query_reg);
		echo "<script>
		alert('Salary Updated Succesfully');
		window.location.href='admin_see_salesman.php';
		</script>";
	}

?>