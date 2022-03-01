<?php

$connection = mysqli_connect('localhost', 'root', '', 'web');

if($connection->connect_error) {
  exit('Could not connect');
}
mysqli_set_charset($connection, "utf8");

if(isset($_POST['ids']))
{

	$ids = $_POST['ids'];
	$names = $_POST['names'];
	$addresses = $_POST['addresses'];
	$typess = $_POST['typess'];
	$coords = $_POST['coords'];
	$ratings = $_POST['ratings'];
	$ratings_n = $_POST['ratings_n'];
	$current_popularities = $_POST['current_popularities']; 
	$populartimess = $_POST['populartimess'];
	$times_spent = $_POST['times_spent'];

	$query = '';
	$status = False;
	for($i = 0; $i<count($ids); $i++)
	{
		$id = $ids[$i];
		$name = $names[$i];
		$address = $addresses[$i];
		$types = $typess[$i];
		$coord = json_decode($coords[$i]);
		$latitude =  $coord->lat;
		$longitude =  $coord->lng;
		$rating = $ratings[$i];
		$rating_n = $ratings_n[$i];
		$current_popularity = $current_popularities[$i]; 
		$pop = $populartimess[$i];
		$monday = $pop[0];
		$tuesday = $pop[1];
		$wednesday = $pop[2];
		$thursday = $pop[3];
		$friday = $pop[4];
		$saturday = $pop[5];
		$sunday = $pop[6];
		$time_spent_min = $times_spent[$i][0];
		$time_spent_max = $times_spent[$i][1];


		if($id != '')
		{	
			$query = "INSERT INTO pois(id, name, address, types, co_lat, co_lng, rating, rating_n, current_pop, mon, tue, wedn, thurs, frid, sat, sun, ts_min, ts_max)
			VALUES ('$id', '$name', '$address', '$types', '$latitude', '$longitude', '$rating', '$rating_n', '$current_popularity', '$monday', '$tuesday',
			'$wednesday', '$thursday', '$friday', '$saturday', '$sunday', '$time_spent_min', '$time_spent_max');";
	
			if(mysqli_query($connection, $query))
				$status = True;
			else
				$status = False;
			
		}
	}
	echo json_encode(array("statusCode" => $status));
}		

?>