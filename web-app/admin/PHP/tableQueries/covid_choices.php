<?php

include('../dbconnection.php');

  $sql = "SELECT p.types AS types, COUNT(p.id) AS cnt
          FROM pois AS p
          INNER JOIN visits AS v ON v.store_id = p.id
          INNER JOIN covid AS c ON  v.email = c.cemail
          WHERE (v.reg_date >= c.date - INTERVAL  7 DAY)  AND (v.reg_date <= c.date + INTERVAL 14 DAY)
          GROUP BY types
          ORDER BY cnt DESC;";

$result = mysqli_query($conn,$sql); 

if (mysqli_num_rows($result) > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
      $data[] = $row;
  }
}

echo json_encode($data);

?>
