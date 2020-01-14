<?php
session_start();
// all needed information to update the Attendence
$month = $_POST["selectMonth"];
$error = '';

include 'connect.php';



// Let update when user click on submit button
include 'connect.php';
   if($_SERVER["REQUEST_METHOD"] == "POST"){
      if ($month == '') {
          $error = "Please choose a value";
      }else {
        $_SESSION['changeMonth'] = $month;
        header('location: project.php');
      }

      echo $_SESSION['changeMonth'] ;
     

   }


?>