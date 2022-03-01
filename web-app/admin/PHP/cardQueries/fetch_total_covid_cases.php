<?php

  session_start();
  include('../dbconnection.php');

 $sql = "SELECT count(*) FROM covid";
 /*to apotelesma apo to query ekxwreite sthn metavlhth result*/

 $result=mysqli_query($conn,$sql);


    $row = mysqli_fetch_row($result);
    echo json_encode($row);

?>
