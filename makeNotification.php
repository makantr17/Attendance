<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$email =$course = $emailF= $message = $date = "";
$email_err = $course_err = $emailF_err = $message_err = $date_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //   email
    if ($_POST["email"] == "" ) {
        $email_err = "Please enter email";
    }
    else{
        $email = trim($_POST["email"]);
     // Validate new password
        if ($_POST["course"] == "" ) {
            $course_err = "Please enter course Name";
        }
        else{
            $course = trim($_POST["course"]);

            if($_POST["emailF"] == "" ){
                $emailF_err = "Please enter facilitator email";     
            } else{
                $emailF = trim($_POST["emailF"]);

                        // Validate new password
                if ($_POST["date"] == "" ) {
                    $date_err = "Please Enter a valid date";
                }
                else{
                    $date = trim($_POST["date"]);
                    // message
                    if ($_POST["message"] == "" ) {
                        $message_err = "Please describe your motif";
                    }
                    else{
                        $message = trim($_POST["message"]);
 

    
                // Find department id
                    $department = "SELECT * FROM `dashboard`.`Department` where
                    `Department`.`departmentName` = '$depart' and `Department`.`level`= '$level'
                    LIMIT 1";
                    $resultD= mysqli_query($connect, $department); 
                    $departR = mysqli_fetch_all($resultD, MYSQLI_ASSOC);
                    foreach ($departR as $key) {
                        $departId = $key['departmentId'];
                    }
                        
                        // Find out the last index of the table
                        $lastIndex = "SELECT * from `Notification` ";
                        $findlastIndex= mysqli_query($connect, $lastIndex); 
                        $resultLastIndex = mysqli_fetch_all($findlastIndex, MYSQLI_ASSOC);

                        $counter = 1;
                        foreach ($resultLastIndex as $foundIndex) {
                            $counter = $counter + 1;
                        }
                        if ($counter == 1) {
                            $notifyId = 1;
                        }
                        else {
                            $notifyId = $counter;
                        }

                        // Insert into User table
                        $general = "INSERT into  `Notification`(`notifyId`, `email`, `message`, `date`, `facilitator`, `courseName`)
                            values('$notifyId', '$email', '$message', '$date', '$emailF', '$course') ";
                        $generalResult= mysqli_query($connect, $general); 
                            
                        // echo $general;
                        header('location: project.php');
                                
                            }
                            
                              
                        }
                    
                    }
                }
            }
        }
            
        
?>

  




    
   