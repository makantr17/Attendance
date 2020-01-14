<?php
// Initialize the session
session_start();
 
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$searchEmail =  "";
$errorEmail = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if($_POST["email"] == "" ){
        $errorEmail = "Incorrect email";     
    } else{
        $searchEmail = trim($_POST["email"]);
            
             $_SESSION['searchByemail'] =   $searchEmail;
            
             $_SESSION['script'] = "SELECT `Users`.`userId`, `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Department`.`departmentId`,
             `Users`.`departmentId`, `Department`.`departmentName`, `Users`.`profession`, `Users`.`email`,
             `Users`.`level`,`Users`.`lastName`
             FROM `Users`, `Department`
             Where `Users`.`departmentId` = `Department`.`departmentId` and `Users`.`email` = '$searchEmail' ";
         
             header('location: project.php');


            }
        

        header('location: project.php');
       }
    
?>

  




    
   