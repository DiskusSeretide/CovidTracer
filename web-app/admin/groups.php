<?php
   session_start();
   if(!isset($_SESSION['email'])){
     header('location:../login/login.php');
   }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Administrator</title>
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link rel="stylesheet" href="groups.css">
       <!-- import jquery -->
       <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
      <!-- load cards stats-->
      <script language="javascript" src="groups.js"></script>
   </head>
   <body>
      <div class="my-container">
         <div class="topbar">
            <div class="logo">
               <h2>Administrator</h2>
            </div>
         </div>
         <div class="sidebar">
            <ul>
               <li>
                  <a href="index.php">
                     <i class="fas fa-chart-bar"></i>
                     <div>Graphs/Stats</div>
                  </a>
               </li>
               <li>
                  <a href="groups.php">
                     <i class="fas fa-layer-group"></i>
                     <div>U/D Table</div>
                  </a>
               </li>
               <li>
                  <a href="records.php">
                     <i class="fas fa-table"></i>
                     <div>POIS Table</div>
                  </a>
               </li>
            </ul>
         </div>
      </div>
      <div class="container">
         <div class="ranking">
            <div class="total-ranking">
               <h3>Categories Classification Based On Total Visits</h3>
               <table id='visit-group' class="table-box">
                  <thead  class='table-head'>
                     <tr>
                        <th>Point Of Interest</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     <!-- js takes over -->
                  </tbody>
               </table>
            </div>
            <div class="total-ranking">
               <h3>Categories Classification Based On Total Covid Visits</h3>
               <table id='covid-visit-group' class="table-box">
                  <thead class='table-head'>
                     <tr>
                        <th>Point Of Interest</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     <!-- js takes over -->
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </body>
</html>