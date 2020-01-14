<?php
// Initialize the session
session_start();

$_SESSION['script'] = "";
 
// Define variables and initialize with empty values
$departmentName = $courseName = $level = $cohort= $dateFrom = $week = "";
$depart_err = $course_err = $level_err = $cohort_err =$from_err = $week_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if ($_POST["cohort"] == "" ) {
        $cohort_err = "Please select your cohort";
    }
    else{
        $cohort = trim($_POST["cohort"]);
    
    if($_POST["department"] == "Choose the Department" ){
        $depart_err = "Pleas select your Department";     
    } else{
        $departmentName = trim($_POST["department"]);
            

        if($_POST["level"] == "Choose the Level" ){
            $level_err = "Pleas select your Level";     
        } else{
            $level = trim($_POST["level"]);
                
                if($_POST["course"] == "Choose the Course" ){
                    $course_err = "Pleas select your Course";     
                } else{
                    $courseName = trim($_POST["course"]);

                    if ($_POST["date"] == "") {
                        $from_err = "Choose the right date";
                    }
                    else {
                        $dateFrom = trim($_POST["date"]);


                        if ($_POST["week"] == "") {
                            $week_err = "Choose the right date";
                        }
                        else {
                            $week = trim($_POST["week"]);

                            // Let convert find the dayOfWeek;
                            include 'connect.php';

                            // Select query
                            $serchDay = "SELECT DAYOFWEEK('$dateFrom')";
                            $mm= mysqli_query($connect, $serchDay); 
                            $mn = mysqli_fetch_all($mm, MYSQLI_ASSOC);

                            // Loop and find the exact date
                            foreach ($mn as $kue) {
                            $valt = $kue["DAYOFWEEK('$dateFrom')"];
                            // echo $valt."</br>";
                            }
                            // Find the exact day name from the array
                            $theArr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                            $DayWeek = $theArr[$valt];


                            $_SESSION["updWeek"] = $week;
                            $_SESSION["dayWeek"] = $DayWeek;
                            $_SESSION["updDate"] = $dateFrom;   
                            $_SESSION["apdLevel"] = $level;
                            $_SESSION["upddepartment"] = $departmentName;
                            $_SESSION["updCourse"] = $courseName;   
                            $_SESSION["updCohort"] = $cohort;
    
    
                            header('location: updatePage.php');



                        }
                    }

               


               


            }
        }


       }
    
  }
}
?>

  




    
   