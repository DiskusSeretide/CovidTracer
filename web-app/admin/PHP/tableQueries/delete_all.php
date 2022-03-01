<?php

    include('../dbconnection.php');

    $query = "DELETE FROM pois";
    if(mysqli_query($conn, $query))
        echo true;
    else 
        echo false;
    
?>