<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
$_SESSION['header'] = "Name/Email/Date/Week/CourseName/Status";
// Define variables and initialize with empty values
$month = $level = $date = $depart = $course= $cohort=  "";
$month_err = $level_err= $date_err= $year_err= $depart_err= $course_err= $cohort_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if ($_POST["level"] == "" ) {
        $level_err = "Please select the year";
    }
    else{
        $level = trim($_POST["level"]);

     
        if ($_POST["cohort"] == "" ) {
            $cohort_err = "Please select the cohort";
        }
        else{
            $cohort = trim($_POST["cohort"]);


            if ($_POST["depart"] == "" ) {
                $depart_err = "Please select the depart";
            }
            else{
                $depart = trim($_POST["depart"]);


                if ($_POST["course"] == "" ) {
                    $course_err = "Please select the course";
                }
                else{
                    $course = trim($_POST["course"]);


                    if($_POST["month"] == "Choose the month" ){
                        $month_err = "Pleas select your Month";     
                    } else{
                        $month = trim($_POST["month"]);


                            if($_POST["date"] == "Choose the date" ){
                                $date_err = "Pleas select your Month";     
                            } else{
                                $date = trim($_POST["date"]);
    
        
                       


                        // $general = "SELECT * from `$month` where `$month`.`email` = '$email' ";
                        // echo  $_SESSION['script'];
                        // echo $general
                        $general = "SELECT Distinct `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Users`.`cohort`, `Users`.`level`
                        ,`$month`.`Monday`, `$month`.`Tuesday`, `$month`.`Wednesday`, `$month`.`Thursday`,
                        `$month`.`Friday`, `$month`.`Saturday`, `$month`.`Sunday`, `$month`.`email` 
                        From `Users`, `$month`
                        where `Users`.`email` = `$month`.`email` and `Users`.`cohort` = '$cohort' "  ;
                  
                        $result= mysqli_query($connect, $general); 
                        $tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
    

                        $generalResult= mysqli_query($connect, $general); 
                        $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);
                        $myarr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                        // $script = '';
                        $_SESSION['query'] = 'Select '."$depart".' Student from '."$level".' in '."$cohort".' that attended '."$course".' in '."$date";
                    
                        
                        foreach ($testResult as $data) {
                            $fullName = $data['firstName'].' '.$data['lastName'];
                        //   loops by columns
                        foreach ($myarr as $nameDay) {
                            $explodeValue = explode(',', $data["$nameDay"]);
                            //  Get all the elements in that explode  
                            for ($d=0; $d < sizeof($explodeValue) ; $d++) { 
                                    $divide = explode('/', $explodeValue[$d]);
                                    
                                    if ($date == $divide[0] and $course == $divide[2]) {
                                        if ($script == '') {
                                            $script =  $fullName.'/'.$data['email'].'/'.$divide[0].'/'.$divide[1].'/'.$divide[2].'/'.$divide[3];
                                        }else {
                                            $script = $script.','.$fullName.'/'.$data['email'].'/'.$divide[0].'/'.$divide[1].'/'.$divide[2].'/'.$divide[3];
                                        }
                                    
                                
                                    } } } }
                    
                
                    //   echo $script;
                    $_SESSION['dataTable'] = $script;
                    header('location: project.php');
                    }
        }
    }}}

       }
    }
    
?>

  




    