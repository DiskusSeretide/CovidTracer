<?php
 $host='localhost';
 $username='root';
 $password='';
 $dbname='web';

$conn = mysqli_connect($host,$username,$password);

mysqli_set_charset($conn, "utf8");

mysqli_select_db($conn, $dbname);

?>
