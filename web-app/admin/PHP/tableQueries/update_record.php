<?php

    include('../dbconnection.php');

    $query = "";
    if(isset($_POST["id"]))
    {
        if($_POST["column_name"] == "coordinates")
        {
            $lat_lng = sscanf($_POST["value"], '%f, %f');
            $query .= "UPDATE pois SET co_lat=".$lat_lng[0].", co_lng=".$lat_lng[1]." WHERE id = '".$_POST["id"]."'";
        }
        else if($_POST["column_name"] == "duration")
        {
            $min_max = sscanf($_POST["value"], '%d-%d');
            $query .= "UPDATE pois SET ts_min=".$min_max[0].", ts_max=".$min_max[1]." WHERE id = '".$_POST["id"]."'";
        }
        else
        {
            $value = mysqli_real_escape_string($conn, $_POST["value"]);
            $query = "UPDATE pois SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
        }

        if(mysqli_query($conn, $query))
            echo true;
        else 
            echo false;
    }
?>