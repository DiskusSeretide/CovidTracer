<?php

session_start();

$user = $_SESSION['email'];

$con = mysqli_connect('localhost','root','','web');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_set_charset($con, "utf8");
@header("Content-type: application/json; charset=utf-8");

$query = "SELECT v.reg_date, p.name, v.store_id
          FROM visits AS v
          INNER JOIN pois AS p
          ON p.id = v.store_id
          WHERE v.email = '$user'
          ORDER BY v.reg_date";

$result = mysqli_query($con,$query);

$myVisits = array();
$myStoreIds = array();
$myVisitDates = array();
$myNames = array();

if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        $myVisits[] = $row;
        $myNames[] = $row['name'];
        $myStoreIds[] = $row['store_id'];
        $myVisitDates[] = $row['reg_date'];
    }
}


//find
$storesQuery = "SELECT v.store_id, v.reg_date FROM visits AS v 
                INNER JOIN covid AS c 
                ON v.email = c.cemail
                WHERE c.cemail <> '$user'
                AND (v.reg_date >= c.date - INTERVAL 7 DAY) 
                AND (v.reg_date <= c.date + INTERVAL 7 DAY)";

$result = mysqli_query($con,$storesQuery);

$covidStores = array();
$covidDates = array();
if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        $covidStores[] = $row['store_id'];
        $covidDates[] = $row['reg_date'];
    }
} 

$i = 0;
$threats = 0;
$indexes = array();
// for every store i've been to 
foreach ($myStoreIds as $mystore)
{
    // check if anyone has submitted covid outbreak (under date restrictions)
    $indexes = array_keys($covidStores, $mystore);
    if(!empty($indexes))
    {
        foreach ($indexes as $index)
        {
          //convert dates from db
          $myDate = date_create($myVisitDates[$i]);
          $covidDate = date_create($covidDates[$index]);
                        
          //compare em
          $time_diff = $myDate->diff($covidDate);
            //if same day and time diff +- 2 hours and same day
            if ( abs((intval($time_diff->format("%r%a")))==0) && ( abs(intval($time_diff->format("%r%h"))) <= 2) )
                $threats++;        
        }
    }
    // replace store id with the amount of people that got sick and have been to this store
    $myVisits[$i]['store_id'] = $threats;
    $threats = 0;
    $i++;
  }
  
  $JSON = json_encode($myVisits,true);

  echo $JSON;	//AJAX request

?>