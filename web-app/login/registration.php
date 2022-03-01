<?php

session_start();

$connection = mysqli_connect('localhost', 'root', '', 'web');
if($connection->connect_error) {
  exit('Could not connect');
}

$mail = $_POST['email'];
$name = $_POST['username'];
$pass = $_POST['password'];

$s = "SELECT * FROM users WHERE email = '$mail'";

$result = mysqli_query($connection, $s);
$num_rows = mysqli_num_rows($result);

if($num_rows >= 1){
  $msg = json_encode(array("status"=>false));

  @header("Content-type: application/json; charset=utf-8");
  
  echo $msg;	//AJAX request
}
else {
  $reg = "INSERT INTO users(email, username, password) values('$mail', '$name', '$pass')";
  mysqli_query($connection, $reg);
  $msg =  json_encode(array("status"=>true));

  @header("Content-type: application/json; charset=utf-8");
  
  echo $msg;	//AJAX request
}

mysqli_close($connection);

?>
