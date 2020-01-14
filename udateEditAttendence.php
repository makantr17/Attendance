<?php
session_start();
$val = $_SESSION['varteNum'];
$month = $_SESSION['actualMonth'];
// all needed information to update the Attendence


$week = $_SESSION["updWeek"];
$DayWeek =$_SESSION["dayWeek"] ;
$dateFrom = $_SESSION["updDate"] ;   
$level =$_SESSION["apdLevel"];
$departmentName =$_SESSION["upddepartment"] ;
$courseName =$_SESSION["updCourse"] ;   
$cohort =$_SESSION["updCohort"] ;
// echo $facilitator."</br>".$attWeek."</br>".$attDepart."</br>".$attCourse."</br>";

// Transform the date into the week day
include 'connect.php';



// Let update when user click on submit button
include 'connect.php';
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       for ($i=0; $i < $val ; $i++) { 
           $name = "record".$i;
           $email = "email".$i;
        // echo  $_POST["$email"]." ".$_POST["$name"];
           $_status = $_POST["$name"];
           $_email = $_POST["$email"];

           $_toInput = $week."/".$dateFrom."/".$courseName;

            $sql = "SELECT * from `$month` where `$month`.`email` = '$_email' limit 1 ";
            $result= mysqli_query($connect, $sql); 
            $tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //    $_toInput = $week."/".$dateFrom."/".$courseName."/".$_POST["$name"];
            $myarr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                          
            foreach ($tes2 as $data) {

                    foreach ($myarr as $nameDay) {  
                            
                        $explodeValue = explode(',', $data["$nameDay"]);
                        $myString = '';
                        $notify = 0;
                        $toUpdateDate = '';
                        for ($d=0; $d < sizeof($explodeValue) ; $d++) { 
                              
                            
                                if ($d == 0) {
                                    $phrase = '';
                                    $simpleSliced = explode('/', $explodeValue[$d]);
                                    if ($simpleSliced[0] == $dateFrom and $simpleSliced[1] == $week and $simpleSliced[2] == $courseName) {
                                        $myString = $simpleSliced[0].'/'.$simpleSliced[1].'/'.$simpleSliced[2].'/'.$_status;
                                        $notify = $notify + 1;
                                        $toUpdateDate = $nameDay;
                                    }
                                    else {
                                        $myString = $explodeValue[0];
                                    }

                                }
                                else {
                                    $phrase = '';
                                    $simpleSliced = explode('/', $explodeValue[$d]);
                                    if ($simpleSliced[0] == $dateFrom and $simpleSliced[1] == $week and $simpleSliced[2] == $courseName) {
                                        $myString = $myString.','.$simpleSliced[0].'/'.$simpleSliced[1].'/'.$simpleSliced[2].'/'.$_status;
                                        $notify = $notify + 1;
                                        $toUpdateDate = $nameDay;
                                    }
                                    else {
                                        $myString = $myString.','.$explodeValue[$d];
                                    }
                                } 
                            }
                           
                            if ($notify > 0) {
                                $insert = "UPDATE `dashboard`.`$month` 
                                SET `$toUpdateDate` = '$myString'
                                where `email` = '$_email' ";
                                $insertIt= mysqli_query($connect, $insert);
                            }
          } } }
    }
    header('location: project.php');


?>