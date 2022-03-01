<?php

session_start();

$email = $_SESSION['email'];

$fullname = $_POST['fl'];
$user = $_POST['us'];
$pass = $_POST['pass'];


$con = mysqli_connect('localhost','root','','web');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$query = "UPDATE users SET username='$user',password='$pass',fullname='$fullname' WHERE email like '$email'";

$msg = json_encode(array("status"=>false), true);

if(mysqli_query($con,$query))
{   
    // execute query
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    // store data
    $data = mysqli_fetch_assoc($result);

    // update session variables
    $_SESSION['fullname'] = $data['fullname'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    
    $msg = json_encode(array("status"=>true), true);
    echo $msg;	//AJAX request

}else
{   
    die('Could not connect: ' . mysqli_error($con));
}

  mysqli_close($con);

?>