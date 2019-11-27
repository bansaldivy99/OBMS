<?php

session_start();
if(!isset($_SESSION['user'])){
    header('location:index.php');
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
    <title>See Orders Placed Through Salesman </title>
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

    <button onclick="location.href='salesman_home.php'" type="button" class ="btn btn-primary"> Go Back </button>

<div class="container">

    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>

            </div>
            <table class="table">
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Order Id" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Client Username" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Item Id" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Item Quantity" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Order Amount" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Order Status" disabled></th>
                    </tr>
                <?php
            $conn = mysqli_connect("localhost","root","","rbms");

            if($conn-> connect_error) {
                die("Connection Failed:". $conn-> connect_error);
            }

            $salesman_username=$_SESSION['user'] ;

            $query = "select order_id,client_username,item_id,item_qty,amount,order_status from orders where salesman_username='$salesman_username'";
            $result = $conn-> query($query);

            if($result-> num_rows >0){
                while($row = $result-> fetch_assoc()){
                    echo "<tr><td>". $row["order_id"]."</td><td>".$row["client_username"]."</td><td>".$row["item_id"]."</td><td>". $row["item_qty"]."</td><td>". $row["amount"]."</td><td>". $row["order_status"]."</td></tr>";
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

<div class="container">
<div class ="row">

                <div class = "col-lg-6">
                <h2> To Update Order Status </h2>
                <form action="salesman_order_update.php" method="post">
                    <div class="form-group">
                        <label> Order Number </label>
                        <input type="Number" name="order_id" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label> Change Status To </label>
                        <input type="text" name="order_status" class="form-control"required>
                    </div>
                    
                    <button type="submit" name="update_order_status" class ="btn btn-primary"> Update Status </button>
                </form> 

    </div>

</body>
</html>