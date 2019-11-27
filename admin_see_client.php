<?php

session_start();
if(!isset($_SESSION['user'])){
	header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
            <style>
body {
  background-image: url('images/bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
	<title>All Cleints</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css.css"> 
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style >
        .filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

    </style>
</head>
<body>
<div class="container">

<div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>

            </div>
            <table class="table">
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="ID" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Client Username" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Client Email" disabled></th>
                    </tr>
		<?php
			$conn = mysqli_connect("localhost","root","","rbms");

			if($conn-> connect_error) {
				die("Connection Failed:". $conn-> connect_error);
			}

			$query = "select id,username,email from client";
			$result = $conn-> query($query);

			if($result-> num_rows >0){
				while($row = $result-> fetch_assoc()){
					echo "<tr><td>". $row["id"]."</td><td>".$row["username"]."</td><td>". $row["email"]."</td></tr>";
				}
				echo"</table>";
			}
			else{
				echo "0 Result";
			}

			$conn-> close()	
		?>

	</table>

</div>
        </div>
    </div>
</div>

	
<div class="container">

	<button onclick="location.href='admin_home.php'" type="button" class ="btn btn-primary"> Go Back </button>


</body>
</html>