<?php

  session_start();
  include('../dbconnection.php');

    $sql = "SELECT count(reg_id) FROM visits";

    $result=mysqli_query($conn,$sql);


    $row = mysqli_fetch_row($result);
    echo json_encode($row);
    
?>
