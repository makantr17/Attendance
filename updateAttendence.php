<?php
session_start();
$val = $_SESSION['varteNum'];
// all needed information to update the Attendence
$attendenceName  = $_SESSION["attName"] ;
$attDate = $_SESSION["attDate"]  ;   
$attLevel = $_SESSION["attLevel"] ;
$attDepart = $_SESSION["attDepart"] ;
$attCourse = $_SESSION["attCourse"] ;   
$attCohort = $_SESSION["attCohort"] ;
$attWeek = $_SESSION["attWeek"] ;
$facilitator = $_SESSION['takingAttendence'];

// echo $facilitator."</br>".$attWeek."</br>".$attDepart."</br>".$attCourse."</br>";

// Transform the date into the week day
include 'connect.php';

// Select query
$serchDay = "SELECT DAYOFWEEK('$attDate')";
$mm= mysqli_query($connect, $serchDay); 
$mn = mysqli_fetch_all($mm, MYSQLI_ASSOC);

// Loop and find the exact date
foreach ($mn as $kue) {
   $valt = $kue["DAYOFWEEK('$attDate')"];
   // echo $valt."</br>";
}
// Find the exact day name from the array
$theArr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
$DayWeek = $theArr[$valt];

// Let select the actual id number
$sIndex = "SELECT * FROM `dashboard`.`RecordAtt` LIMIT 1000";
$indexN= mysqli_query($connect, $sIndex); 
$indexE = mysqli_fetch_all($indexN, MYSQLI_ASSOC);
$count = 1;
foreach ($indexE as $keyCount) {
   $count = $count + 1;
}



// Let update when user click on submit button
include 'connect.php';
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       for ($i=0; $i < $val ; $i++) { 
           $name = "record".$i;
           $email = "email".$i;
        // echo  $_POST["$email"]." ".$_POST["$name"];
           $_status = $_POST["$name"];
           $_email = trim($_POST["$email"]);
       
        // Let check the actual status.....
         $checkThe = "SELECT * FROM `dashboard`.`January` where `email`= '$_email' LIMIT 1";
         $fetchCheck= mysqli_query($connect, $checkThe); 
         $resultCheck = mysqli_fetch_all($fetchCheck, MYSQLI_ASSOC);
         
         foreach ($resultCheck as $verify) {
             $valueStatus = $verify["$DayWeek"];
            //  echo $valueStatus.'<br>';
         }
         $explodeValue = explode(',', $valueStatus);
         // echo sizeof($explodeValue);
         

         // // Exploide 
         if (sizeof($explodeValue) ==1 and $valueStatus == null) {
            $myStatus = $attDate.'/'.$attWeek.'/'.$attCourse.'/'.$_status;

               $insert = "UPDATE `dashboard`.`January` 
               SET `$DayWeek`= '$myStatus'
               where `email` = '$_email' ";
               $insertIt= mysqli_query($connect, $insert); 
         }
         elseif(sizeof($explodeValue) >=1 and $valueStatus != null ) {
            $formValue = '';
            for ($j=0; $j < sizeof($explodeValue); $j++) { 
               if ($j == 0) {
                   $formValue = $explodeValue[0];
               }
               
               else {
                  $formValue =  $formValue.','.$explodeValue[$j];
               }
               
            }

            $formValue = $formValue.','.$attDate.'/'.$attWeek.'/'.$attCourse.'/'.$_status;
            echo $formValue.'<br>';

            $insert = "UPDATE `dashboard`.`January` 
            SET `$DayWeek`= '$formValue'
            where `email` = '$_email' ";
            $insertIt= mysqli_query($connect, $insert); 

         }


        }

       $insertAttendence = "INSERT into `dashboard`.`RecordAtt`(`recordId`, `AttendenceName`, `date`, `user`, `courseName`, `departName`, `week`, `dayOfWeek`)
       values('$count', '$attendenceName', '$attDate', '$facilitator', '$attCourse', '$attDepart', '$attWeek', '$DayWeek') ";
       $insAtt= mysqli_query($connect, $insertAttendence); 

       echo "$insertAttendence";


    }
    header('location: project.php');


?>