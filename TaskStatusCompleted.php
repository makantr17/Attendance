<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$email = $date = $status = $description = $ticket =  "";
$date_err= $status_err = $description_err =  $email_err = $ticket_err= "";
 
// Processing form data when form is submitted  
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        if ($_POST["ticket"] == "" ) {
            $ticket_err = "Please select your email";
        }
        else{
            $ticket = trim($_POST["ticket"]);
            // Validate email
            if ($_POST["email"] == "" ) {
                $email_err = "Please select your email";
            }
            else{
                $email = trim($_POST["email"]);

                // select level
                if($_POST["date"] == "" ){
                    $date_err = "Please choose date";     
                } else{
                    $date = trim($_POST["date"]);

                      // select level
                        if($_POST["status"] == "" ){
                            $status_err = "Please choose error type";     
                        } else{
                            $status = trim($_POST["status"]);

                            // select level
                            if($_POST["description"] == "" ){
                                $description_err = "Please describe your issue";     
                            } else{
                                $description = trim($_POST["description"]);

                     
                              
                                // Check if the email already exist
                                $general = "UPDATE `Ticket` 
                                set `status` = '$status', `note` = '$description', `solvedDate` = '$date'
                                where `ticketId` = '$ticket' and `email` = '$email' ";
                                $generalResult= mysqli_query($connect, $general); 
                                $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);

                            
                               // echo $general;
                               header('location: project.php');
                        }
                    
                    }
                }
            }
        }
    }
?>

  




    
   