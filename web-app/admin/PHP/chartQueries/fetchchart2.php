<?php

  session_start();

  include('../dbconnection.php');

  $myDate = json_decode($_GET['q'])->date; 

  // although the the HOUR(reg_date) is not a date but hour time,
  // it helps to be left like that for future uses
  $sql = "SELECT HOUR(reg_date) AS date, COUNT(*) AS cnt
          FROM visits 
          WHERE DATE(reg_date) = '$myDate'
          GROUP BY date
          ORDER BY date
          ASC;";

  $result = mysqli_query($conn, $sql);


  while($row = mysqli_fetch_assoc($result)){
    $data[0][] = $row;
  }


   $s = "SELECT HOUR(v.reg_date) AS date, count(*) AS cnt FROM visits AS v
         INNER JOIN covid AS c ON v.email = c.cemail
         WHERE DATE(v.reg_date) = '2022-02-03'
         AND (v.reg_date >= c.date - INTERVAL 7 DAY)  AND (v.reg_date <= c.date + INTERVAL 14 DAY)
         GROUP BY HOUR(v.reg_date)
         ORDER BY date ASC;";


   $result = mysqli_query($conn, $s);


    while($row = mysqli_fetch_assoc($result)){
      $data[1][] = $row;
    }

    $json = json_encode($data, true);

    echo $json;

?>
