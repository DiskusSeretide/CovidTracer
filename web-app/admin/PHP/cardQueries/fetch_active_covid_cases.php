<?php

  session_start();
  include('../dbconnection.php');

  $sql = "SELECT count(*) FROM visits AS v
          INNER JOIN covid AS c ON v.email = c.cemail
          WHERE (v.reg_date >= c.date - INTERVAL 7 DAY)  AND (v.reg_date <= c.date + INTERVAL 14 DAY);";

  $result=mysqli_query($conn,$sql);


    $row = mysqli_fetch_row($result);
    echo json_encode($row);

?>
