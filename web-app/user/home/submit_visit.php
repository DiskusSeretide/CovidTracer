<?php

session_start();

$connection = mysqli_connect('localhost', 'root', '', 'web');
if($connection->connect_error) {
  exit('Could not connect');
}

$people = $_POST['people'];
$email = $_SESSION['email'];
$storeId = $_POST['storeId'];

if(empty($people))
    $people = 0;

$query = "INSERT INTO visits(email, store_id, reg_date, current_pop) VALUES ('$email', '$storeId', CURRENT_TIMESTAMP, '$people')";

if(mysqli_query($connection, $query))
    echo json_encode(array("statusCode"=>200));
else
    echo json_encode(array("statusCode"=>201));
    
mysqli_close($connection);

?>