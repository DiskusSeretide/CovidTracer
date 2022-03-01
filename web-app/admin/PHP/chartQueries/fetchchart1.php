<?php

  session_start();
  include('../dbconnection.php');

  header('Content-type: application/json');

  $dates = json_decode($_GET['q']);
  $start = $dates->start;
  $end = $dates->end;

  
  /* query for visits per day */

  $data = array();

  $sql = "SELECT DATE(reg_date) AS date , count(*) AS cnt
          FROM visits
          WHERE DATE(reg_date) >= '$start' AND DATE(reg_date) <= '$end'
          GROUP BY DATE(reg_date) ORDER BY date ASC;";

  $result = mysqli_query($conn,$sql);


    while($row = mysqli_fetch_assoc($result)){
      $data[0][] = $row;
    }

    /* query for visits from active cases per day*/

    $s = "SELECT DATE(reg_date) AS date, count(*) AS cnt FROM visits AS v
          INNER JOIN covid AS c ON v.email = c.cemail
          WHERE (DATE(reg_date) >= '$start') AND (DATE(reg_date) <= '$end')
          AND (v.reg_date >= c.date - INTERVAL 7 DAY)  AND (v.reg_date <= c.date + INTERVAL 14 DAY)
          GROUP BY DATE(reg_date)
          ORDER BY date ASC";

    $result = mysqli_query($conn,$s);

      while($row = mysqli_fetch_assoc($result)){
        $data[1][] = $row;
      }
      
      $json = json_encode($data);

      echo $json;

?>
