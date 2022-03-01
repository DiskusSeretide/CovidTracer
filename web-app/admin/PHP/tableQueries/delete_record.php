<?php

    include('../dbconnection.php');

    if(isset($_POST["id"]))
    {
        $query = "DELETE FROM pois WHERE id = '".$_POST["id"]."'";
        if(mysqli_query($conn, $query))
            echo true;
        else 
            echo false;
    }
?>