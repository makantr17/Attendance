<!-- Those queries fetch specific information from table -->
<?php

//  Fetch all the courses
$departmentFetch = "SELECT Distinct(`departmentName`) from `Department`";
$depresult= mysqli_query($connect, $departmentFetch); // Stores the submitted data into the database test
$depart = mysqli_fetch_all($depresult, MYSQLI_ASSOC);

// Fetch all the Level
$levelFetch= "SELECT Distinct(`level`) from `Department`";
$levelresult= mysqli_query($connect, $levelFetch); // Stores the submitted data into the database test
$level = mysqli_fetch_all($levelresult, MYSQLI_ASSOC);

// Select all the course
$courseFetch = "SELECT Distinct(`courseName`) from `Course`";
$courseresult= mysqli_query($connect, $courseFetch); // Stores the submitted data into the database test
$course = mysqli_fetch_all($courseresult, MYSQLI_ASSOC);

// Select all the date
$dateFetch = "SELECT Distinct(`Month`) from `Attendence`";
$dateresult= mysqli_query($connect, $dateFetch); // Stores the submitted data into the database test
$date = mysqli_fetch_all($dateresult, MYSQLI_ASSOC);


// Select all cohort
$cohortFetch = "SELECT Distinct(`cohort`) from `Users`";
$cohortresult= mysqli_query($connect, $cohortFetch); // Stores the submitted data into the database test
$cohort = mysqli_fetch_all($cohortresult, MYSQLI_ASSOC);
?>