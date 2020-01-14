<?php
// Initialize the session
session_start();
include 'connect.php';
$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$group = "";
$group_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
     // Validate new password
     if ($_POST["allHere"] == "" ) {
        $group_err = "Please enter course Name";
    }
    else{
        $group = trim($_POST["allHere"]);

        $addor = 0;

        $groupSplit = explode(',', $group);
        foreach ($groupSplit as $data) {
            
                $explodeValue = explode('/', $data);
                $checkWrong = explode('//', $data);
                if (sizeof($checkWrong) >1) {
                   echo "Wrong input".'<br>';
                }
                else if (sizeof($explodeValue) <= 5) {
                    echo "Missing value".'<br>';
                }
                else {
                    if ($explodeValue[0]== ' ' or $explodeValue[1] == ' ' or $explodeValue[2] == ' '
                    or $explodeValue[3]== ' ' or $explodeValue[4] == ' ' or $explodeValue[5]==' ' or  $explodeValue[6] ==' ') {
                        echo "Find null value".'<br>';
                    }else {
                        echo "print okey".'<br>';
                      

                       $depart =$explodeValue[4];
                       $level = $explodeValue[3];
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
                      $Id = $counter + 1 ;

                      $email = $explodeValue[2];
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
                          echo "Exist this email";
                          echo $email;

                        //   header('location: project.php');
                      } 
                      // Insert info in the database
                      else {
                          // Insert into User table
                          $firstName = $explodeValue[0];
                          $lastName = $explodeValue[1];
                          $phone = $explodeValue[5];

                          $general = "INSERT into  `Users`(`userId`, `firstName`, `lastName`, `email`, `phoneNumber`, `profession`, `level`, `departmentId`)
                           values('$Id', '$firstName', '$lastName', '$email', '$phone', 'Student', '$level', '$departId') ";
                          $generalResult= mysqli_query($connect, $general); 
                        // echo $general.'<br>';
                          
                       
                          // Insert into all the user table    
                          $month = array('January', 'February', 'April', 'May', 'June', 'Jully', 'August','September', 'October', 'November', 'Deccember');
                          foreach ($month as $keymonth) {
                              $generalMonth = "INSERT into  `$keymonth`(`Id`,`email`)
                              values('$Id', '$email') ";
                              $resultMonth= mysqli_query($connect, $generalMonth); 
                              
                          }
                          
                        }

                    }
                }
              
                    }
                // echo $general;
                   header('location: project.php');
                }



            }
                                
                        
                            
                              
            
        
?>

  




    
   