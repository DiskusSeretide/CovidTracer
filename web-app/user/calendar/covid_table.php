<?php

session_start();

$user = $_SESSION['email'];

$con = mysqli_connect('localhost','root','','web');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_set_charset($con, "utf8");
@header("Content-type: application/json; charset=utf-8");

$query = "SELECT date FROM covid WHERE cemail like '$user'";

$result = mysqli_query($con,$query);

$data = array();
if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        $data[] = $row;
    }
} 

$JSON = json_encode($data,true);

echo $JSON;	//AJAX request

?>