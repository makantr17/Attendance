<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$firstName = $lastName =$depart = $level = $email= $phone = "";
$firstName_err =$lastName_err= $depart_err = $level_err = $email_err =$phone_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
     // Validate new password
     if ($_POST["firstName"] == "" ) {
        $firstName_err = "Please enter your first Name";
    }
    else{
        $firstName = trim($_POST["firstName"]);

            // Validate new password
        if ($_POST["lastName"] == "" ) {
            $lastName_err = "Please enter your last Name";
        }
        else{
            $lastName = trim($_POST["lastName"]);

            // Validate new password
            if ($_POST["email"] == "" ) {
                $email_err = "Please select your cohort";
            }
            else{
                $email = trim($_POST["email"]);


                    // Validate new password
                if ($_POST["phone"] == "" ) {
                    $phone_err = "Please enter phone number";
                }
                else{
                    $phone = trim($_POST["phone"]);

          
                
                    if($_POST["level"] == "Choose the level" ){
                        $level_err = "Please select level";     
                    } else{
                        $level = trim($_POST["level"]);

                                // Validate new password
                        if ($_POST["depart"] == "Choose the department" ) {
                            $depart_err = "Please select a department";
                        }
                        else{
                            $depart = trim($_POST["depart"]);
         
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
                        $lastIndex = "SELECT * from `Users` ";
                        $findlastIndex= mysqli_query($connect, $lastIndex); 
                        $resultLastIndex = mysqli_fetch_all($findlastIndex, MYSQLI_ASSOC);

                        $counter = 1;
                        foreach ($resultLastIndex as $foundIndex) {
                            $counter = $counter + 1;
                        }
                        $Id = $counter + 1;

                        // Find out the last index of month
                        $lastIndexF = "SELECT * from `January` ";
                        $findlastIndexF= mysqli_query($connect, $lastIndexF); 
                        $resultLastIndexF = mysqli_fetch_all($findlastIndexF, MYSQLI_ASSOC);

                        $counterF = 1;
                        foreach ($resultLastIndexF as $foundIndexF) {
                            $counterF = $counterF + 1;
                        }
                        $IdF = $counterF;

                        
                        // Check if the email already exist
                        $general = "SELECT * from `Users` where `Users`.`email` = '$email' limit 1 ";
                        $generalResult= mysqli_query($connect, $general); 
                        $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);

                        $conter = 0;
                        foreach ($testResult as $resultTest) {
                            $conter = $conter + 1;
                        }
                            
                        // Condition if the the email already exist in the database
                        if ($conter > 0) {
                            echo $conter;
                            header('location: project.php');
                        } 
                        // Insert info in the database
                        else {
                            // Insert into User table
                            $general = "INSERT into  `Users`(`userId`, `firstName`, `lastName`, `email`, `phoneNumber`, `profession`, `level`, `departmentId`)
                             values('$Id', '$firstName', '$lastName', '$email', '$phone', 'Student', '$level', '$departId') ";
                            $generalResult= mysqli_query($connect, $general); 
                            
                         
                            // Insert into all the user table    
                            $month = array('January', 'February', 'April', 'May', 'June', 'Jully', 'August','September', 'October', 'November', 'Deccember');
                            foreach ($month as $keymonth) {
                                $generalMonth = "INSERT into  `$keymonth`(`Id`,`email`)
                                values('$IdF', '$email') ";
                                $resultMonth= mysqli_query($connect, $generalMonth); 
                                
                            }
                            
                               // echo $general;
                               header('location: project.php');
                        }
                    
                    }
                }
            }
        }
    }
  }
}
?>

  




    
   