<?php

    include('../dbconnection.php');

    if(isset($_POST["name"], $_POST["address"], $_POST["types"], $_POST["coords"]))
    {

        $id = uniqid("ChIJ-f8_0D");
        $name = $_POST["name"];
        $address = $_POST["address"];
        $types = $_POST["types"];

        // spot coords
        preg_match_all('!\d+!', $_POST["coords"], $matches);
        $latitude = floatval($matches[0][0].'.'.$matches[0][1]);
        $longitude = floatval($matches[0][2].'.'.$matches[0][3]);

        $rating = !empty($_POST["rating"]) ? $_POST["rating"] : '0.0';
        $rating_n = !empty($_POST["votes"]) ? $_POST["votes"] : '0';
        $current_popularity = !empty($_POST["cp"]) ? $_POST["cp"] : '0';
        $monday = !empty($_POST["mon"]) ? $_POST["mon"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        $tuesday = !empty($_POST["tue"]) ? $_POST["tue"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        $wednesday = !empty($_POST["wedn"]) ? $_POST["wedn"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        $thursday = !empty($_POST["thu"]) ? $_POST["thu"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        $friday = !empty($_POST["frid"]) ? $_POST["frid"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        $saturday = !empty($_POST["sat"]) ? $_POST["sat"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        $sunday = !empty($_POST["sun"]) ? $_POST["sun"] : '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
        
        // spot ints
        if(!empty($_POST["time_spent"])){
            preg_match_all('!\d+!', $_POST["time_spent"], $matches);
            $time_spent_min = $matches[0][0];
            $time_spent_max = $matches[0][1];
        }
        else{
            $time_spent_min = 0;
            $time_spent_max = 0;
        }
        

        if($id != '')
		{	
			$query = "INSERT INTO pois(id, name, address, types, co_lat, co_lng, rating, rating_n, current_pop, mon, tue, wedn, thurs, frid, sat, sun, ts_min, ts_max)
			VALUES ('$id', '$name', '$address', '$types', '$latitude', '$longitude', '$rating', '$rating_n', '$current_popularity', '$monday', '$tuesday',
			'$wednesday', '$thursday', '$friday', '$saturday', '$sunday', '$time_spent_min', '$time_spent_max');";
	
			if(mysqli_query($conn, $query))
				echo true;
			else
				echo false;
		}
        else 
            echo false;

    }

?>