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
      <link rel="stylesheet" href="admin_index_styles.css">
      <!-- import font -->
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <!-- import jquery -->
      <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
      <!-- load cards stats-->
      <script language="javascript" src="admin_index.js"></script>
      <!-- for charts -->
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="topbar">
            <div class="logo">
               <h2>Administrator</h2>
            </div>
            <a class="logout" href="../login/login.php">
               <button type="button" class="logout-btn">Logout</button>
            </a>

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
         <div class="main">
            <div class="cards">
               <div class="card">
                  <div class="card-cont">
                     <div class="card-name">Visits:</div>
                  </div>
                  <div class="visit-count">
                     <div id="outputvisits"></div>
                  </div>
                  <div class="icons">
                     <i class="fas fa-users"></i>
                  </div>
               </div>
               <div class="card">
                  <div class="card-cont">
                     <div class="card-name">Total Covid Cases:</div>
                  </div>
                  <div class="covid-count">
                     <div id="outputcovid"></div>
                  </div>
                  <div class="icons">
                     <i class="fas fa-syringe"></i>
                  </div>
               </div>
               <div class="card">
                  <div class="card-cont">
                     <div class="card-name">Visits by Active Cases:</div>
                  </div>
                  <div class="active-count">
                     <div id="outputactive"></div>
                  </div>
                  <div class="icons">
                     <i class="fas fa-user-check"></i>
                  </div>
               </div>
            </div>
            <div class="charts">
               <div class="chart">
                  <h3>Visits Per Day</h3>
                  <canvas id="myChart1"></canvas>
                  <input type="checkbox" checked="" name="chooseBox" value="0">Visits
                  <input type="checkbox" checked="" name="chooseBox" value="1">Covid Cases
                  <br>
                  <!-- Default range: last week -->
                  Start:<input type="date" id="startdate" name="datepicker" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' - 30 days')) ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' - 6 days')); ?>"/>
                  End:  <input type="date" id="enddate" name="datepicker" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' - 30 days')) ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>"/>
                  <script type="text/javascript" src="create_first_chart.js"></script> 
                  <script>chartIt('myChart1');</script>
               </div>
               <div class="chart">
                  <h3>Visits Per Hour</h3>
                  <canvas id="myChart2"></canvas>
                  <input type="checkbox" checked="" name="chooseBox2" value="0"> Visits
                  <input type="checkbox" checked="" name="chooseBox2" value="1"> Covid Cases
                  <input type="date" id="onlyDate" name="datepicker2" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' - 30 days')) ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>"/>
                  <script type="text/javascript" src="create_second_chart.js"></script> 
                  <script>chartItSecond('myChart2');</script>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>