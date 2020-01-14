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
                            $delFromUser = "DELETE from  `Users` where `Users`.`email` = '$email'  ";
                            $resultDelete= mysqli_query($connect, $delFromUser); 
                            // echo $delFromUser;
                          
                            
                            
                         
                            // Insert into all the user table    
                            $generalMonth = "DELETE from  `Facilitator` where `Facilitator`.`email` = '$email' ";
                            $resultMonth= mysqli_query($connect, $generalMonth); 
                                // echo $generalMonth.'<br>';
                           
                            
                               // echo $general;
                               header('location: project.php');
                        }
                  }
                    
            }
                    ?>
            