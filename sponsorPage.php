<?php   
session_start();
include 'connect.php'; 
$_SESSION["track"]= 0;

$userName = $_SESSION['sponName'] ;
$emailStudent= $_SESSION['studentEmail'] ;
$email= $_SESSION['sponEmail'];
$password = $_SESSION['sponPassword'];

$sql = $_SESSION['spon'];
$result= mysqli_query($connect, $sql); 
$tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sqlUser = "SELECT `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Users`.`level`,
`Users`.`cohort`, `Users`.`profession`, `Department`.`departmentId`, `Users`.`departmentId`, `Department`.`departmentName`
from `Users`, `Department`
where `Users`.`email` = '$emailStudent' and `Users`.`departmentId` = `Department`.`departmentId` ";
$resultUser= mysqli_query($connect, $sqlUser); 
$testUser = mysqli_fetch_all($resultUser, MYSQLI_ASSOC);

$courseUser = "SELECT Distinct `Users`.`email`, `Users`.`level`,  `Department`.`departmentId`, `Users`.`departmentId`, `Department`.`departmentName`,
`Course`.`departmentId`, `Course`.`courseName`, `Department`.`level`
from `Users`, `Department`, `Course`
where `Users`.`email` = '$emailStudent' and `Users`.`departmentId` = `Department`.`departmentId` and 
`Course`.`departmentId` = `Department`.`departmentId` and `Department`.`level` = `Users`.`level`";
$resultCourse= mysqli_query($connect, $courseUser); 
$testCourse = mysqli_fetch_all($resultCourse, MYSQLI_ASSOC);



// From the first date to the lastDate
$attendenceUser = "SELECT `RecordAtt`.`week`, `RecordAtt`.`dayOfWeek`, `RecordAtt`.`date`,
`RecordAtt`.`courseName`, `RecordAtt`.`departName`,
`Week2`.`email`, `Week1`.`email`, `Week3`.`email`, 
`Week1`.`Monday`, `Week1`.`Tuesday`,`Week1`.`Wednesday`, `Week1`.`Thursday`,`Week1`.`Friday`, `Week1`.`Saturday`, `Week1`.`Sunday`,
`Week2`.`Monday`, `Week2`.`Tuesday`,`Week2`.`Wednesday`, `Week2`.`Thursday`,`Week2`.`Friday`, `Week2`.`Saturday`,`Week2`.`Sunday`,
`Week3`.`Monday`, `Week3`.`Tuesday`,`Week3`.`Wednesday`, `Week3`.`Thursday`,`Week3`.`Friday`, `Week3`.`Saturday`, `Week3`.`Sunday`

from `RecordAtt`, `Week2`, `Week1`, `Week3`
where (`RecordAtt`.`week` = 'Week2' or `RecordAtt`.`week` = 'Week1' or `RecordAtt`.`week` = 'Week3') 
 and `Week2`.`email` = '$emailStudent' and `Week1`.`email` = `Week3`.`email` and
`Week1`.`email` = `Week2`.`email` and `Week2`.`email` = `Week3`.`email` ";
$attendUser= mysqli_query($connect, $attendenceUser); 
$attended = mysqli_fetch_all($attendUser, MYSQLI_ASSOC);




// Select weekly presence
// $attendWeekly = "SELECT * from `Week2` where `email` = 'makante17@alustudent.com' ";
// $weekly= mysqli_query($connect, $attendWeekly); 
// $checkWeekly = mysqli_fetch_all($weekly, MYSQLI_ASSOC);

$monthTochange= '';

// $_SESSION['changeMonth'] = '';
$monthTochange = $_SESSION['changeMonth'];

$checkThe = "SELECT * FROM `dashboard`.`$monthTochange` where `email`= '$emailStudent' LIMIT 1";
$fetchCheck= mysqli_query($connect, $checkThe); 
$resultCheck = mysqli_fetch_all($fetchCheck, MYSQLI_ASSOC);






?>


<!DOCTYPE html>
<html>
    <head>
            <link rel="stylesheet" href="styleHome.css">
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>

    <body id="sponsor1">
        
    <!-- Section profile -->
        <section id="profile">
           
            <div>
                <img src="image/fred.jpg">
                <?php  
                     foreach ($tes2 as $sponsorData) {       
                ?>
                <p> <?php echo $sponsorData['userName']; ?> </p>
                <p> <?php echo $sponsorData['emailSponsor']; ?> </p>
                <p> <?php echo $sponsorData['role']; ?> </p>
                     <?php } ?>
            </div>

            <div>
                <img src="image/makant.jpg">
                <?php  
                     foreach ($testUser as $studentData) {       
                ?>
                <p> <?php echo $studentData['firstName']." ".$studentData['lastName']; ?> </p>
                <p> <?php echo $studentData['email']; ?> </p>
                <p> <?php echo $studentData['level']; ?> </p>
                <p> <?php echo $studentData['departmentName']; ?> </p>
               
                     <?php } ?>
            </div>




        </section>
        <section id="sponsor">
            <!-- Possible operation that can be executed by users -->
            <div id="opera">
                <h1>Make single research by Date</h1>

                <div id="search">
                     <div style="width:100%; height:35px; float:left">
                        <h1 style="font-size:14px; margin-top:0px; margin-right:10px; color:rgb(39, 233, 207); float:left">SELECT DATE</h1>
                            <form action="changeMonth.php" method="post">
                                <select name="selectMonth" style="width:150px; heigh:28px; border-radius: 5px; 
                                border:1px solid rgb(39, 233, 207); background-color:white">
                                    <option>January</option>
                                    <option>February</option>
                                    <option>Mars</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                            </select>
                            <input style="width:70px; heigh:25px; border-radius: 5px; 
                                border:1px solid rgb(39, 233, 207); background-color:rgb(39, 233, 207)"  type="submit" value="load">
                        </form>
                     </div>
                     <div style="width:100%; height:30px; float:left">
                        <button>Seearch</button>
                        <button>Check</button>
                        <button>Seearch</button>
                     </div>
                </div>

                <div id="result">
                    <div id="resultData">
                       <?php include "tablePresence.php"; ?>
                    </div>
                    
                    <div id="resultChart"> 
                          <h1> <?php echo $monthTochange; ?></h1>
                          <div id="apexchart"></div>
                    </div>
                
                </div>

            </div>


            <!-- General data loaded on the platform -->
        <div id="report">
            <h1>Student Report</h1>

            <div id="attendence">
                <h1>Courses</h1>
                <ul style="margin-left:-40px;">
                    <?php foreach ($testCourse as $respCourse) {?>
                    <li><img src="image/cou.png"><p> <?php echo $respCourse['courseName']; ?></p></li><?php } ?>
                </ul>
            </div>
                

               
            <div id="attendence" style="height:250px;">
                 <h1>Information by Course</h1>
                 <div id="iclude">
                 <script>
                 for (let key in presenceCourse){
                     var intact = presenceCourse[key];
                     document.getElementById("iclude").innerHTML +=
                      "<div style='width:100%;   height:50px; float:left'>" 
                            + "<h2 style='font-size: 12px; font-weight:normal; float:left'>" + key + ": </h2>" 
                            + "<ul style='font-size: 12px; display:inline;'>" +
                                  " <li style='  margin-left:10px;  height:20px; float:left'>"+ "Presence" + "<div style='width:25px; margin-right:5px; background-color:white; font-size:12px; text-align:center; height:25px; border:5px solid rgb(39, 233, 207); border-radius:25px; float:left'>"+ "<p style='margin-top:5px; font-size:15px'>"+ intact["Present"]  + "</p>"+ "</div>"  +"</li>" +
                                  " <li style=' margin-left:10px; height:20px; float:left'>"+ "Absence" + "<div style='width:25px; margin-right:5px; background-color:white; font-size:12px; text-align:center; height:25px; border:5px solid rgb(49, 151, 235); border-radius:25px; float:left'>"+ "<p style='margin-top:5px; font-size:15px'>"+ intact["Absent"]  + "</p>"+ "</div>"  +"</li>" 
                            + "</ul>" +
                      "</div>";
                    //  document.getElementById("iclude").innerHTML += "<h1>"+ key + ":  Present " + intact["Present"] + "-  Absence " + intact["Absent"] + "</h1>";
                 }

                 </script>
                 </div>
            </div>
            
            <div id="attendence" style="height: 250px">
                <h1>Monthly Presence</h1>
                <div style="width:300px; color:black" id="chartI"></div>
            </div>

            <!-- <div id="attendence">
               
            </div> -->



        </div>
        
    </section>




    </body>


<!-- Donut Chart -->
    <script>
                var options = {
                    chart: {
                        type: 'donut',
                    },
                    series: [ <?php echo $counterPresent; ?>, <?php echo $counterAbsent; ?>],
                    labels: ['Presented','Absented'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                // width: 150,
                                // // heigth: 250
                            },
                            
                
                            legend: {
                                position: 'center'
                            }
                        }
                     }]
                   }
                var chartJ = new ApexCharts(
                    document.querySelector("#chartI"),
                    options
                );
                
                chartJ.render();

</script>

  <!-- Morris CHart settling to display data -->
 <script>
            var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'monthly presence',
                data: newArr
            }],
            xaxis: {
                categories: secondArr
            }
            }

            var chart = new ApexCharts(document.querySelector("#apexchart"), options);

            chart.render();
        
    </script>



</html>