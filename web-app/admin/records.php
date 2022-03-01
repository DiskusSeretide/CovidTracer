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
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
      <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
      <link rel="stylesheet" href="admin_records_styles.css">
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
      <div class="con box">
         <div class="">
            <div align="right">
               <button type="button" class="btn btn-info" id="delete-all-btn">Drop Table</button>
               <button type="button" name="add" id="add" class="btn btn-info">Add Row</button>
               <input type="button" id="load-file" class="btn btn-info" value="Load File">
               <input type="file" name="my_file" id="my-file">
               <script>
                  $('#load-file').click( () => {
                     $('#my-file').click();
                  });

                  $("#my-file").change( () => {
                        insertFiledata();
                     });
               </script>
            </div>
            <div id="alert_message"></div>
            <table id="user_data" class="">
               <thead class="table-head">
                  <tr>
                     <th><!-- collumn for delete buttons --></th>
                     <th>Name</th>
                     <th>Adress</th>
                     <th>Types</th>
                     <th>Geolocation</th>
                     <th>Rating</th>
                     <th>Reviews</th>
                     <th>Population</th>
                     <th>Monday</th>
                     <th>Tuesday</th>
                     <th>Wednesday</th>
                     <th>Thursday</th>
                     <th>Friday</th>
                     <th>Saturday</th>
                     <th>Sunday</th>
                     <th>Duration</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
      <script src="admin_records.js"></script>
      <script>
         $(document).ready( () => {
            fetch_data();

            $(document).on('blur', '.update', function() {
               const id = $(this).data("id");
               const column_name = $(this).data("column");
               const value = $(this).text();
               update_data(id, column_name, value);
            });

            $(document).on('click', '.delete', function() {
               const id = $(this).attr("id");
               if(confirm("Are you sure you want to remove this?"))
                  delete_record(id);
            });

            $(document).on('click', '#insert', function(){
               const name = $('#data1').text();
               const address = $('#data2').text();
               const types = $('#data3').text();
               const coords = $('#data4').text();
               const rating = $('#data5').text();
               const votes = $('#data6').text();
               const cp = $('#data7').text();
               const mon = $('#data8').text();
               const tue = $('#data9').text();
               const wedn = $('#data10').text();
               const thur = $('#data11').text();
               const frid = $('#data12').text();
               const sat = $('#data13').text();
               const sun = $('#data14').text();
               const dur = $('#data15').text();

               if(name != '' && address != '' && types != '' && coords != ''){
                  insert_record(name, address, types, coords, rating, votes, cp, mon, tue, wedn, thur, frid, sat, sun, dur);
                  console.log('vziiioun');
               }
               else{
                  $('#alert_message').html("<div class='alert alert-warning'>First four fields are required</div>");
                  setTimeout( () => { $('#alert_message').html('');}, 5000);
               }
            });

            $(document).on('click', '#delete-all-btn', function() {
               if(confirm("Are you sure you want to drop table?"))
                  delete_all();
            });

         });
      </script>
   </body>
</html>