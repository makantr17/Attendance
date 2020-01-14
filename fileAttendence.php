<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$month = $week = $level = $email= $dateFrom =  $dateTo = "";
$month_err = $week_err = $level_err = $email_err =$from_err = $to_errr ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if ($_POST["email"] == "" ) {
        $email_err = "Please select your email";
    }
    else{
        $email = trim($_POST["email"]);

         
        if($_POST["week"] == "Choose the month" ){
            $week_err = "Please select the week";     
        } else{
            $week = trim($_POST["week"]);
      
        
            if($_POST["month"] == "Choose the month" ){
                $month_err = "Pleas select your Month";     
            } else{
                $month = trim($_POST["month"]);

                       $_SESSION['header'] = 'Date/Week/CourseName/Status';

                        $general = "SELECT * from `$month` where `$month`.`email` = '$email' ";
                        // echo  $_SESSION['script'];
                        // echo $general;

                        $generalResult= mysqli_query($connect, $general); 
                        $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);
                        $myarr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                        $script = '';
                        $query = 'SELECT '."$email".' '."$week".' weekly attendence '.' of '."$month";
                        $_SESSION['query'] = $query;
                        ?>
                        <div id="hhh">
                            <?php
                        
                        foreach ($testResult as $data) {
                        //   loops by columns
                        foreach ($myarr as $nameDay) {
                            $explodeValue = explode(',', $data["$nameDay"]);
                            //  Get all the elements in that explode  
                            for ($d=0; $d < sizeof($explodeValue) ; $d++) { 
                                    $divide = explode('/', $explodeValue[$d]);
                                    
                                    if ($week == $divide[1]) {
                                        if ($script == '') {
                                            $script =  $divide[0].'/'.$divide[1].'/'.$divide[2].'/'.$divide[3];
                                        }else {
                                            $script = $script.','.$divide[0].'/'.$divide[1].'/'.$divide[2].'/'.$divide[3];
                                        }
                                    
                                
                                    } } } }
                        ?>   </div>  <?php
                
                    //   echo $script;
                    $_SESSION['dataTable'] = $script;
                    header('location: project.php');
                    }
        }


       }
    }
    
?>

  




    
   