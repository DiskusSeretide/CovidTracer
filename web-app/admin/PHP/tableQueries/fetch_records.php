<?php

//fetch.php
include('../dbconnection.php');

$query = "SELECT * FROM pois ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
    WHERE name LIKE "%'.$_POST["search"]["value"].'%" 
    OR address LIKE "%'.$_POST["search"]["value"].'%" 
    ';
}


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();

    $sub_array[] = '<button type="button" class="btn btn-danger btn-xs delete"  class="delete" id="'.$row["id"].'">Delete</button>';
    //$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="id">' . $row["id"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="name">' . $row["name"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="address">' . $row["address"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="types">' . $row["types"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="coordinates">' . $row["co_lat"] . ', ' . $row["co_lng"] . '</div>';
    //$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="co_lng">' . $row["co_lng"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="rating">' . $row["rating"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="rating_n">' . $row["rating_n"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="current_pop">' . $row["current_pop"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="mon">' . $row["mon"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="tue">' . $row["tue"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="wedn">' . $row["wedn"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="thurs">' . $row["thurs"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="frid">' . $row["frid"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="sat">' . $row["sat"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="sun">' . $row["sun"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="duration">' . $row["ts_min"] . '-' . $row["ts_max"] . '</div>';
    //$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="last_name">' . $row["last_name"] . '</div>';

    $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT * FROM pois";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($conn),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);

?>