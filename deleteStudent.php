<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$level = $email= $phone = "";
$level_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
            // Validate email
            if ($_POST["email"] == "" ) {
                $email_err = "Please select your cohort";
            }
            else{
                $email = trim($_POST["email"]);

                // select level
                if($_POST["level"] == "Choose the level" ){
                    $level_err = "Please select level";     
                } else{
                    $level = trim($_POST["level"]);

                     
                        
                        // Find out the last index of the table
                        $lastIndex = "SELECT * from `Users` ";
                        $findlastIndex= mysqli_query($connect, $lastIndex); 
                        $resultLastIndex = mysqli_fetch_all($findlastIndex, MYSQLI_ASSOC);

                        $counter = 1;
                        foreach ($resultLastIndex as $foundIndex) {
                            $counter = $counter + 1;
                        }
                        $Id = $counter + 1;

                        
                        // Check if the email already exist
                        $general = "SELECT * from `Users` where `Users`.`email` = '$email' limit 1 ";
                        $generalResult= mysqli_query($connect, $general); 
                        $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);

                        $conter = 0;
                        foreach ($testResult as $resultTest) {
                            $conter = $conter + 1;
                        }
                            
                        // Condition if the the email already exist in the database
                        if ($conter == 0) {
                            echo $conter;
                            header('location: project.php');
                        } 
                        // Insert info in the database
                        else {
                            // Insert into User table
                            $delFromUser = "DELETE from  `Users` where `Users`.`email` = '$email' and `Users`.`level` = '$level' ";
                            $resultDelete= mysqli_query($connect, $delFromUser); 
                            // echo $delFromUser;
                          
                            
                            
                         
                            // Insert into all the user table    
                            $month = array('January', 'February', 'April', 'May', 'June', 'Jully', 'August','September', 'October', 'November', 'Deccember');
                            foreach ($month as $keymonth) {
                                $generalMonth = "DELETE from  `$keymonth` where `$keymonth`.`email` = '$email' ";
                                $resultMonth= mysqli_query($connect, $generalMonth); 
                                // echo $generalMonth.'<br>';
                            }
                            
                               // echo $general;
                               header('location: project.php');
                        }
                    
                    }
                }
            }
       
?>

  




    
   