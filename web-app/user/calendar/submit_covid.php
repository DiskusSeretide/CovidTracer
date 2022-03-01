<?php

session_start();

$user = $_SESSION['email'];

$covidDateStr = $_GET['date'];
// convert to date
$covidDate = date('Y-m-d', strtotime($covidDateStr));

$con = mysqli_connect('localhost','root','','web');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

// check if there is a submited day which is less than 14 days 
$checkQuery = "SELECT * FROM covid WHERE cemail like '$user' AND ( (date + INTERVAL 14 DAY) > '$covidDate') ";

$result = mysqli_query($con, $checkQuery);


if (mysqli_num_rows($result) == 0)
{

  $query = "INSERT INTO covid(cemail, date) VALUES('$user', '$covidDate')";

  if(mysqli_query($con, $query))
      echo json_encode(array("statusCode"=>200), true);
  else
      echo json_encode(array("statusCode"=>201), true);
}
// if query empty
else
  echo json_encode(array("statusCode"=>202), true);

mysqli_close($con);

?>