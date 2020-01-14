<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$course = $depart = $level = "";
$course_err = $depart_err = $level_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
     // Validate new password
     if ($_POST["course"] == "" ) {
        $course_err = "Please enter course Name";
    }
    else{
        $course = trim($_POST["course"]);

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

                        
                        // Check if the email already exist
                        $general = "SELECT * from `Course`";
                        $generalResult= mysqli_query($connect, $general); 
                        $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);

                        $conter = 0;
                        foreach ($testResult as $resultTest) {
                            $conter = $conter + 1;
                        }
                        $courseId = $counter + 1;
                            
                      
                    
                        // Insert into User table
                        $general = "INSERT into  `Course`(`courseId`, `courseName`, `departmentId`)
                            values('$courseId', '$course', '$departId') ";
                        $generalResult= mysqli_query($connect, $general); 
                            
                        // echo $general;
                        header('location: project.php');
                                
                            }
                            
                              
                        }
                    
                    }
                }
            
        
?>

  




    
   