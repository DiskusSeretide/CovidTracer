<?php

session_start();

$email = $_POST['email'];
$pass = $_POST['password'];

$connection = mysqli_connect('localhost', 'root', '', 'web');
if($connection->connect_error) {
  exit('Could not connect');
}


$query = "SELECT * FROM users WHERE email = '$email' && password = '$pass'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_array($result);

if($user)
{
  if(!empty($_POST["remember"])) {
    setcookie ("email", $email, time() + (365 * 24 * 3600));
    setcookie ("password", $pass, time() + (365 * 24 * 3600));
  }else
  {
    if(isset($_COOKIE["email"]))   
      setcookie ("email","");  

    if(isset($_COOKIE["password"]))    
      setcookie ("password","");  
  }
}


$num_rows = mysqli_num_rows($result);

if($num_rows == 1){
  if(!intval($user['role']))
  {
    // create session variables 
    $_SESSION['email'] = $user['email'];
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $user['password'];
  
    header('location:../user/home/home.php');
  }
  else if(intval($user['role']))
  {
    $_SESSION['email'] = $user['email'];
    header('location:../admin/index.php');
  }
}
else {
  header('location:login.php');
}

?>
