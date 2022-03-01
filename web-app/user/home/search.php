<?php

// check for empty search
if(!isset($_GET['store']) or empty($_GET['store']))
	die( json_encode(array('ok'=>0, 'errmsg'=>'specify s parameter') ) );

$store = $_GET['store'];
$connection = mysqli_connect('localhost', 'root', '', 'web');
if($connection->connect_error) {
  exit('Could not connect');
}

mysqli_set_charset($connection, "utf8");

$query = "SELECT id, name, co_lat, co_lng, current_pop, mon, tue, wedn, thurs, frid, sat, sun FROM pois WHERE name LIKE '$store'";
$result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));

if (mysqli_num_rows($result) > 0)
{
	$data = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $data[] = $row;
        $name = $row['name'];
    }
} 
$query = "SELECT AVG(current_pop) FROM visits WHERE store_id = (SELECT id FROM pois WHERE name like '$name')
AND (reg_date <= now() && reg_date >= now() - INTERVAL 2 HOUR)";

$result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));;

  while($row = mysqli_fetch_assoc($result))
  {
      if(!empty($row))
      {
        $data[] = $row;
      }
  }

echo json_encode($data,true);

/*
	function searchInit($text)	//search initial text in titles
{
	$reg = "/^".$store."/i";	//initial case insensitive searching
	return (bool)@preg_match($reg, $text['name']);
}

$fdata = array_filter($data, 'searchInit');	//filter data
$fdata = array_values($fdata);	//reset $fdata indexs
*/

?>
