<?php
// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!-- Discussions -->
<!-- Summary -->

<!-- Use some command operation to fetch information -->
<?php
    // List of session created through forms
    $userId = $_SESSION["userId"];
    $email = $_SESSION["email"];
    $department = $_SESSION["department"] ;
    $course = $_SESSION["course"];
    $level = $_SESSION["level"] ;

    // Simple queries such as All department, level, course
    
    
    // Include databse information
    include 'connect.php';
    // Select information to prep the chart
    include 'queryInfo.php';
    // use query for queryInfo.php and assign to result
    $resultZ = mysqli_query($connect, $queryZ);


    // Let run our Chart using $chart_data  
    $chart_data = '';
    while($row = mysqli_fetch_array($resultZ))
    {
        $chart_data .= "{ numberAttended :'".$row["numberAttended"]."', Month :'".$row["Month"]."', userId :".$row["userId"]." }, ";
    }
    $chart_data = substr($chart_data, 0, -2);
?>


<?php 
    // Teacher Edit Possibility
     $editMethods = "SELECT `Users`.`userId`, `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Department`.`departmentId`,
     `Users`.`departmentId`, `Department`.`departmentName`, `Users`.`profession`, `Users`.`email`,
     `Users`.`level`,`Users`.`lastName`
     FROM `Users`, `Department`
     Where `Users`.`departmentId` = `Department`.`departmentId` "  ;
     $resultEdit= mysqli_query($connect, $editMethods); 
     $editFetch = mysqli_fetch_all($resultEdit, MYSQLI_ASSOC);
?>



<?php 
    // Fetch information about User profile
     $sql = "SELECT `Users`.`userId`, `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Department`.`departmentId`,
     `Users`.`departmentId`, `Department`.`departmentName`, `Users`.`profession`, `Users`.`email`,
     `Users`.`level`,`Users`.`lastName`
     FROM `Users`, `Department`
     Where `Users`.`departmentId` = `Department`.`departmentId` and `Users`.`userId` = '$userId' "  ;
     $result= mysqli_query($connect, $sql); 
     $tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php

$monthTochange= '';
// $_SESSION['changeMonth'] = '';
$monthTochange = $_SESSION['changeMonth'];

$checkThe = "SELECT * FROM `dashboard`.`$monthTochange` where `email`= '$email' LIMIT 1";
$fetchCheck= mysqli_query($connect, $checkThe); 
$resultCheck = mysqli_fetch_all($fetchCheck, MYSQLI_ASSOC);

?>





<?php 

    // Fetch the list of student, Name, email, Department
    if ($_SESSION['script'] == "") {
        // load general Query
        $general  = "SELECT `Users`.`userId`, `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Department`.`departmentId`,
        `Users`.`departmentId`, `Department`.`departmentName`, `Users`.`profession`, `Users`.`email`,
        `Users`.`level`,`Users`.`lastName`
        FROM `Users`, `Department`
        Where `Users`.`departmentId` = `Department`.`departmentId`";
       
    }else {
        //  Set the query to the one Updated
        $general = $_SESSION['script'];
    }
    
    //  echo $general;
     $generalResult= mysqli_query($connect, $general); 
     $testResult = mysqli_fetch_all($generalResult, MYSQLI_ASSOC);


     $searchRoot = "SELECT * from `Users` where  `Users`.`profession` = 'root' and `Users`.`email` = '$email' Limit 1";
     $fetchRoot= mysqli_query($connect, $searchRoot); 
     $resultRoot = mysqli_fetch_all($fetchRoot, MYSQLI_ASSOC);

     $dataIssue = "SELECT * from `Ticket`";
     $fetchIssueData= mysqli_query($connect, $dataIssue); 
     $resultData = mysqli_fetch_all($fetchIssueData, MYSQLI_ASSOC);


     $datanotification = "SELECT * from `Notification` where `email`= '$email' or `facilitator` = '$email' ";
     $fetchNotification= mysqli_query($connect, $datanotification); 
     $responseNotification = mysqli_fetch_all($fetchNotification, MYSQLI_ASSOC);


     
?>
   





<!DOCTYPE html>      
          
<html>
    <head>
    <!-- Start morris code -->
    <title>Dashboard</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
            <!-- Link to the css dash.css -->
            <link rel="stylesheet" href="dash.css">
            <!-- Apex chart -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    



    <body>
         
        <!-- Section containing all possible operations +++++++++++++++++++++++++++++++++++++++++-->
        <section id='Menu'>

            <!-- Create profile  ################################################-->
            <div id="profile">
                <!-- user picture -->
                <img id=picture src="image/makant.jpg">

                <!-- User name, lastname, profession -->
                <div id="userInfo">

                <!-- let fetch all information about user from the data -->
                <?php  foreach ($tes2 as $info) { ?>
                        <!-- User Name -->   
                        <h2><?php echo $info['firstName'].' '.$info['lastName'] ;?></h2>
                        <!-- Profession -->
                        <h2><?php echo $info['profession'];?></h2>
                        <!-- Level -->
                        <h2><?php echo $info['level'];?></h2>
                        <!-- email -->
                        <h2><?php echo $info['email'];?></h2>
                        <!-- Department -->
                        <h2><?php echo $info['departmentName'];?></h2>
          
                <?php } ?>
                </div>   
            </div>



            <!-- Search for statistics presence #########################################-->
            <div id="search">
                <!-- All simple qury from the tables -->
                <?php include 'simpleQuery.php'; ?>

                <!-- General Query -->
                <button id="buttonSearch" onclick="displayThing5()"><img id="imageIcon" src="image/Line-chart.png"> <h2>General Info</h2></button> 
                
                 <!-- You can revendicate if you really feel like the data load is not right by
                 sending to the facilitator the notices -->
                 <button id="buttonSearch" onclick="displayThing6()"><img id="imageIcon" src="image/icons8-attendance-24.png"> <h2>Mark Attendence</h2>
               
                </button> 

                <!-- Buttom that display the form -->
                <button id="buttonSearch" onclick="displayThing3()"><img id="imageIcon" src="image/Community_Help.png"> <h2>Community</h2>
                
                </button> 

                
                   <!-- Documentation help to know more about the use of the Dashboard -->
                <button id="buttonSearch" onclick="displayThing10()"><img id="imageIcon" src="image/Notification Center.png"> <h2>Excuse Notification</h2>
               
                </button> 
             
                <!-- Documentation help to know more about the use of the Dashboard -->
                <button id="buttonSearch" onclick="displayThing4()"><img id="imageIcon" src="image/Product-documentation.png"> <h2>Documentation</h2>
                
                </button> 

                <!-- Update information -->
                <?php 
                $isroot = 0;
                foreach ($resultRoot as $rootSearch) {
                    $isroot = $isroot + 1;
                } 
                if ($isroot == 1) {  ?>
                 
                <button id="buttonSearch" onclick="displayThing7()"><img id="imageIcon" src="image/db_update.png"> <h2>Update</h2>
                </button> 

                <?php  } ?>


                <!-- Helps-->
                <button id="buttonSearch" onclick="displayThing8()"><img id="imageIcon" src="image/icons8-request-service-50.png"> <h2>Helps</h2>
                
                </button>
                
                <button id="buttonSearch" onclick="displayThing9()"><img id="imageIcon" src="image/backup.png"> <h2>Back-up</h2>
                </button>

                
                
            </div> 
        </section>


        <!-- Cover the whole page -->
        <div id="cover"></div>
       
       
        <!--  Section that fetch all informations  +++++++++++++++++++++++++++++++++++++++-->
        <section id='contentFetch'>
             
            <!-- Edit and modify graphs #####################################################-->
            <div id="graphMenu">

                <!-- Down load Informations -->
                <div id="graphIcons"> <img id="supIcons" src="image/sentByEmail.png"><h2>Send Report</h2></div>
              
                <!-- List of ticket -->
                <div id="graphIcons" onclick="dropElement2()"> 
                    <img id="supIcons" src="image/icons8-new-ticket-80.png">
                    <h2>Ticket</h2>
                    <!-- loop -->
                    <?php
                     $countTicket = 0;
                     foreach ($resultData as $dataFor) {
                        $countTicket = $countTicket + 1;
                      } ?>
                    <!-- display it -->
                    <div style="width:20px; float:left; margin-top:10px; text-align:center; padding:1px; heigth:20px; border-radius:20px; font-size:12px; background-color:white; color:black">
                    <?php echo $countTicket; ?></div>
                    <!-- list of display notification -->
                    <div id="listTicket">
                            <?php
                            $idTicket = 0;
                            foreach ($resultData as $dataFor) { ?>
                                    <div id='noteTicket' onclick= <?php echo "noteTicket"."$idTicket"."()"; ?> >
                                        <img src="image/fred.jpg">
                                        <div id='infoIn'>
                                                <p><?php echo $dataFor['description']; ?></p>
                                                <p style="color:rgb(216, 124, 4)"><?php echo $dataFor['issueType']; ?></p>
                                                <p style="float:right; color:green"><?php echo $dataFor['submitDate']; ?></p>
                                        </div>
                                    </div>
                                   
                            <?php $idTicket = $idTicket + 1; } ?>
                    </div>
                    <!-- Script -->

                    <script>
                            <?php for ($p=0; $p < $idTicket; $p++) {
                                $phrase =  "noteTicket"."$p"."()";
                                $idphrase =  "noteStudent"."$p"; ?>
                                function <?php echo $phrase; ?>{
                                    document.getElementById('noteStudent').style.display="none";
                                    document.getElementById('notifyExcuses').style.display="none";
                                    document.getElementById('useIt').style.display="none";
                                    document.getElementById('updateinfo').style.display="none"; 
                                    document.getElementById('community').style.display="none";
                                    document.getElementById('documentation').style.display="none";
                                    document.getElementById('changeMark').style.display="none";
                                    document.getElementById('helpCenter').style.display="inline-block";   
                                }
                            <?php } ?>
                    </script>

                </div>


                <!-- Open List of notification -->
                <div id="graphIcons" onclick="dropElement1()">
                     <?php $countNotification = 0;
                         foreach ($responseNotification as $repNotified) {
                           $countNotification = $countNotification + 1; } ?>

                      <img id="supIcons" src="image/icons8-notification-50.png">
                      <!-- <h2> Notification</h2> -->
                      <div style="width:20px; float:left; margin-top:10px; text-align:center; padding:<h2> Notification</h2>1px; heigth:20px; border-radius:20px; font-size:12px; background-color:white; color:black">
                      <?php echo $countNotification; ?></div>
                      <!-- List of notification -->
                      <div id="listOfNotifier">
                            <?php
                            $idClock = 0;
                            foreach ($responseNotification as $repNotified) { ?>
                                    <div id='noteStudent' onclick= <?php echo "noteStudent"."$idClock"."()"; ?> >
                                        <img src="image/fred.jpg">
                                        <div id='infoIn'>
                                                <p><?php echo $repNotified['message']; ?></p>
                                                <p style="color:rgb(216, 124, 4)"><?php echo $repNotified['courseName']; ?></p>
                                                <p style="float:right; color:green"><?php echo $repNotified['date']; ?></p>
                                        </div>
                                    </div>
                                   
                            <?php $idClock = $idClock + 1; } ?>
                      </div>
                      <!-- Reply for notification -->
             

                        <script>
                            <?php for ($p=0; $p < $idClock; $p++) {
                                $phrase =  "noteStudent"."$p"."()";
                                $idphrase =  "noteStudent"."$p"; ?>
                                function <?php echo $phrase; ?>{
                                    document.getElementById('noteStudent').style.display="none";
                                    document.getElementById('notifyExcuses').style.display="inline-block";
                                    document.getElementById('useIt').style.display="none";
                                    document.getElementById('updateinfo').style.display="none"; 
                                    document.getElementById('community').style.display="none";
                                    document.getElementById('documentation').style.display="none";
                                    document.getElementById('changeMark').style.display="none";
                                    document.getElementById('helpCenter').style.display="none"; 
                                }
                                <?php } ?>
                        </script>
                    
                </div>

                <!-- logout buttom -->
                <div id="graphIcons" onclick="dropElement()"> 
                    <img id="supIcons" src="image/logout.png"><h2>Log-out</h2>
                    <div id="logoutPage">
                        <a href="reset-password.php" class="btn"><img id="log" src="image/logoutt.png"> Reset My Password</a>
                        <a href="logout.php" class="btn"><img id="log" src="image/logou.png"> Sign Out </a>
                    </div>
                </div>
                <div style="float:right; margin-right:30px; width:200px" id="graphIcons"> <img style="margin:3px; width:55px; height:25px; margin-right:10px" id="supIcons" src="image/alu.png"><h1 style="font-size:18px; margin:5px;">DASHBOARD</h1></div>
                   
            </div>

            
           <!-- Page to create Attendence content here ##################################################-->
           <!-- This div will help to actually make the attendence -->
           <div  id="changeMark">

                <h2>Mark Student Attendence</h2>
               
                <!-- Create/Edit Attendence -->
                
                <div id="popForms">
                     <h2>Create New Attendance</h2>
                     <div onclick="closeit()" style="float:right; width:20px; height:20px; padding:5px; margin-top:-40px; background-color: rgba(233, 223, 223, 0.616); margin-right:25px; ">
                     <img style="width:20px; height:20px" id="supIcons" src="image/close.png"></div>
                     <!-- New attendence created and edited by the facilitator -->
                     <form id="stylePopUp" action="createAttendence.php" method="post">
                     <!-- Include the query -->
                     <?php include 'simpleQuery.php'; ?>
                          
                          <div> 
                              <img id="supIcons" src="image/column.png">
                              <input type="text" name="attendenceName" placeholder="Attendence Name">                       
                         </div>

                         <div>
                             <img id="supIcons" src="image/column.png">
                             <input type="date" name="createDate">
                         </div>

                         <div>
                             <img id="supIcons" src="image/column.png">
                            <select name="choseWeek"> 
                                <option>Chose the Week</option>   
                                <option>Week1</option>
                                <option>Week2</option>
                                <option>Week3</option>
                                <option>Week4</option>
                            </select>
                          </div>
                          <div>
                               <img id="supIcons" src="image/column.png">
                                <select name="choseLevel"> 
                                    <option>Chose level</option>
                                    <?php foreach ($level as $levelEdit) {
                                        ?>
                                    <option> <?php echo $levelEdit['level']; ?></option>
                                    <?php } ?>
                                </select>
                          </div>

                          <div>
                                <img id="supIcons" src="image/column.png">
                                <select name="choseDepart"> 
                                    <option>Chose your Department</option>
                                    <?php foreach ($depart as $departEdit) {
                                        ?>
                                    <option> <?php echo $departEdit['departmentName']; ?></option>
                                    <?php } ?>
                                </select>
                          </div>
                          
                          <div>
                               <img id="supIcons" src="image/column.png">
                                <select name="choseCourse"> 
                                    <option>Chose Course Name</option>
                                    <?php foreach ($course as $courseEdit) {
                                        ?>
                                    <option> <?php echo $courseEdit['courseName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <img id="supIcons" src="image/column.png">
                                <select name="choseCohort"> 
                                    <option>Cohort Name</option>
                                    <option>Cohort1</option>
                                    <option>Cohort2</option>
                                </select>
                           </div>
                           <!-- Subnit the form edited -->
                           <div>
                                
                                <input style="background-color:aqua; margin-left:35px" type="submit" name="savr" value="LOAD ATTANDENCE">
                           </div>
                     </form>
                </div>

                <div id="updateAtt">   
                      <?php  include 'form4.php'; ?>
                </div>

                <!-- Create Edit button. How to open and close the popForm page
                Click on button to create new attendence and update by clicking on update buttom -->
                
                <div id="createEdit">
                    <!-- Create new attendence Div -->
                    <div id="buttonEdit">
                        
                        <button onclick="newAttendence()"><img src="image/icons8-attendance-50.png"><p>New Attendance</p></button>
                    </div>
                    <!-- Update existing Attendence -->

                    <div id="buttonEdit">
                       
                        <button onclick="updateAttendence()"> <img src="image/icons8-update-user-48.png"><p>Update</p></button>
                    </div>

                </div>

                                <!-- Pop up javaScript code below: Don't Delete -->
                                <!-- *********************************** -->
                                                        <!-- Script Query to Open and Close the PopForms-->
                                                        <script>
                                                        //  Fucittion that of button popForm
                                                            function newAttendence(){
                                                                if(document.getElementById('popForms').style.display!="none"){
                                                                    document.getElementById('popForms').style.display="none";
                                                                    document.getElementById('cover').style.display="none"
                                                                }else{
                                                                    document.getElementById('popForms').style.display="inline-block";
                                                                    document.getElementById('cover').style.display="inline-block";
                                                                }
                                                            }

                                                            function closeit(){
                                                                document.getElementById('popForms').style.display="none";
                                                                document.getElementById('cover').style.display="none";
                                                                document.getElementById('updateAtt').style.display="none";
                                                            }
                                                           
                                                            // Function update attendence
                                                            function updateAttendence(){
                                                                if(document.getElementById('updateAtt').style.display!="none"){
                                                                    document.getElementById('updateAtt').style.display="none";
                                                                    document.getElementById('cover').style.display="none"
                                                                }else{
                                                                    document.getElementById('updateAtt').style.display="inline-block";
                                                                    document.getElementById('cover').style.display="inline-block";
                                                                }
                                                            }
                                                        </script>
                                <!-- ************************************* -->
                                <!-- updateAttendence -->

                <!-- Attendence Content in the this div below -->
                <div id="onlyStaff" >
                    <!-- Table That contaion specific query of the Facilitator -->
                    <table>
                        <tr>
                            <th>First Name</th><th>Last Name</th><th>Email address</th>
                            <th>Department</th><th>Level</th>
                        </tr>
                        
                        <?php  foreach ($editFetch as $infoResult) { ?>
                        <tr>      
                            <td> <?php echo $infoResult['firstName']; ?></td> 
                            <td> <?php echo $infoResult['lastName']; ?></td> 
                            <td> <?php echo $infoResult['email']; ?></td> 
                            <td> <?php echo $infoResult['departmentName']; ?></td> 
                            <td> <?php echo $infoResult['level']; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                     
                </div>
            <!-- Close changeMark  -->
           </div>
           

           <!-- Issue and help center -->
           <div id="helpCenter" style="display:none">
                <h1>Help center and how to solve your problem</h1>
                <!-- All the buttom -->
                <div id="bottomBased">
                    <div style="width:90%; margin-left:10px; margin-top:10px; float:left">
                        <button onclick="seeAllIssues()"><img id="imageIcon" src="image/column.png"><p> All issues</p></button>
                    </div>

                    <div style="width:90%; margin-left:10px; margin-top:10px; float:left">
                        <button onclick="bookTicket()"> <img id="imageIcon" src="image/column.png"><p>Book Ticket</p></button>
                    </div>

                    <div style="width:90%; margin-left:10px; margin-top:10px; float:left">
                        <button onclick="fulfillAct()"> <img id="imageIcon" src="image/column.png"><p>Fulfill</p></button>
                    </div>

                </div>
                <script>
                    function bookTicket(){
                            document.getElementById('requestForm').style.display="inline-block";
                            document.getElementById('seeTableInformation').style.display="none";
                            document.getElementById('taskCompleted').style.display="none";
                    }

                    function seeAllIssues(){  
                            document.getElementById('seeTableInformation').style.display="inline-block";
                            document.getElementById('requestForm').style.display="none";
                            document.getElementById('taskCompleted').style.display="none";
                    }

                    function fulfillAct(){
                        document.getElementById('taskCompleted').style.display="inline-block";
                        document.getElementById('requestForm').style.display="none";
                        document.getElementById('seeTableInformation').style.display="none";
                    }
                  

                </script>

                <div id="taskCompleted" style="display:none">
                    <h1>Task Status</h1>
                    <form method="post" action= "TaskStatusCompleted.php"> 
                        <div><img id="imageIcon" src="image/check.png"> <input type="number" placeholder="Ticket number" name="ticket"></div> 
                        <div><img id="imageIcon" src="image/check.png"> <input type="email" placeholder="Email address" name="email"></div> 
                        <div><img id="imageIcon" src="image/check.png"> <input type="date" placeholder="Date" name="date"></div>  
                        <div><img id="imageIcon" src="image/check.png"> <select name="status">
                            <option>Select the issue status</option>
                            <option>Progress</option>
                            <option>Solved</option>
                            <option>Unresolved</option>
                        </select> </div>
                        <div><img id="imageIcon" src="image/check.png"><input type="text" placeholder="Leave the note" name="description"></div>
                        <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; color:black; background-color: aqua" type="submit"> </div>
                    </form>

                </div>

                <div id="seeTableInformation">
                    <h1>See all the information</h1>
                    <table>
                        <tr>
                            <th>Ticket Id</th>
                            <th>Email</th>
                            <th>Issue type</th>
                            <th>Description</th>
                            <th>Submit date</th>
                            <th>Status</th>
                            <th>Solve date</th>
                            <th>Note issue</th>
                        </tr>

                        <?php foreach ($resultData as $dataFor) { ?>
                        <tr>
                            <td><?php echo $dataFor['ticketId']; ?></td>
                            <td><?php echo $dataFor['email']; ?></td>
                            <td><?php echo $dataFor['issueType']; ?></td>
                            <td><?php echo $dataFor['description']; ?></td>
                            <td><?php echo $dataFor['submitDate']; ?></td>
                            <td><?php echo $dataFor['status']; ?></td>
                            <td><?php echo $dataFor['solvedDate']; ?></td>
                            <td><?php echo $dataFor['note']; ?></td>
                        </tr> <?php } ?>

                    </table>
                </div>

                <div id="requestForm" style="display:none">
                          <h1>Send your Request</h1>
                          <p>All the request are taken in consideration in between 48hours time. For any urgent case you are advised to 
                              submit a ticket and also contact via email the tech person so that your issue is solved.
                          </p>
                          <form method="post" action= "bookTicketIssue.php"> 
                                <div><img id="imageIcon" src="image/check.png"> <input type="email" placeholder="Email address" name="email"></div> 
                                <div><img id="imageIcon" src="image/check.png"> <input type="date" placeholder="Date" name="date"></div>  
                                <div><img id="imageIcon" src="image/check.png"> <select name="issue">
                                    <option>Select type of Issue</option>
                                    <option>Accessibility to the charts</option>
                                    <option>Research Center</option>
                                    <option>Send request</option>
                                    <option>Make attendance</option>
                                    <option>Create attendence</option>
                                    <option>Update attendance</option>
                                    <option>Delete</option>
                                </select> </div>
                                <div><img id="imageIcon" src="image/check.png"><input type="text" placeholder="Describe the issue" name="description"></div>
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; color:black; background-color: aqua" type="submit"> </div>
                           </form>

                </div>

           </div>
           <!-- The documentation is guide that help user familiar easily with the platform
           and get the answer to all their questions -->

           <!-- And We have the Documentation too -->
            <?php  include "comentAndDocument.php"  ?>

        

            <!-- This is the update function -->
            <div id="updateinfo" style="display:none">
                 
                 <h1>Update New info</h1>
                
                 <!-- Buttons -->
                 <div id="possibleAct">
                    <ul>
                        <li onclick="actAddStudent()"><img id="imageIcon" src="image/icons8-user-16.png"><button >Add new Student</button></li>
                        <li onclick="actAddFacilitator()"><img id="imageIcon" src="image/icons8-user-male-100.png"><button >Add new Facilitator</button></li>
                        <li onclick="actAddCourse()"><img id="imageIcon" src="image/icons8-class-48 (1).png"><button >Add new Course</button></li>
                      
                        <li onclick="addGroupStudent()"><img id="imageIcon" src="image/icons8-add-user-group-woman-man-48.png"><button >Add Group of Student</button></li>
                        <li onclick="deleteStudent()"><img id="imageIcon" src="image/icons8-remove-user-64.png"><button >Delete Student</button></li>
                        <li onclick="deleteFacilitator()"><img id="imageIcon" src="image/icons8-remove-user-64.png"><button >Delete Facilitator</button></li>
                       
                    </ul> 
                 </div>
                 <script>
                //  
                    function actAddStudent(){
                        document.getElementById('studentToAdd').innerHTML = document.getElementById('addstud').innerHTML;
                        document.getElementById('studentToAdd').style.display="inline-block";
                    }

                    function actAddFacilitator(){
                        document.getElementById('studentToAdd').innerHTML = document.getElementById('addfacil').innerHTML;
                        document.getElementById('studentToAdd').style.display="inline-block";
                    }

                    function actAddCourse(){
                        document.getElementById('studentToAdd').innerHTML = document.getElementById('addCourse').innerHTML;
                        document.getElementById('studentToAdd').style.display="inline-block";
                    }

                    function addGroupStudent(){
                        document.getElementById('studentToAdd').innerHTML = document.getElementById('addGroup').innerHTML;
                        document.getElementById('studentToAdd').style.display="inline-block";
                    }

                    function deleteStudent(){
                        document.getElementById('studentToAdd').innerHTML = document.getElementById('delStudent').innerHTML;
                        document.getElementById('studentToAdd').style.display="inline-block";
                    }

                    function deleteFacilitator(){
                        document.getElementById('studentToAdd').innerHTML = document.getElementById('delFacilitator').innerHTML;
                        document.getElementById('studentToAdd').style.display="inline-block";
                    }


                 </script>
                 <!-- Results of button research -->
                 <div id="researchResult">
                      <h1 style="border-bottom:1px solid rgba(241, 241, 241, 0.877); font-weight:normal; text-transform:uppercase; font-size:16px; color:rgb(8, 65, 8) ">Result Loaded</h1>

                      <!-- Put all here-->
                      <div id="studentToAdd"> </div>
                      
                      <!-- Add new student -->
                      <div id="addstud" style="display:none">
                          <h1>Add New Student</h1>
                          <form method="post" action= "updateStudentTo.php"> 
                                <div><img id="imageIcon" src="image/check.png"><input type="text" placeholder="First Name" name="firstName"></div>
                                <div><img id="imageIcon" src="image/check.png"> <input type="text" placeholder="Last Name" name="lastName"></div>
                                <div><img id="imageIcon" src="image/check.png"> <input type="email" placeholder="Email address" name="email"></div>
                                <div><img id="imageIcon" src="image/check.png"> <input type="number" placeholder="Phone number" name="phone"></div>   
                                <div><img id="imageIcon" src="image/check.png"> <select name="level">
                                    <option>Select the level</option>
                                    <option>YEAR1</option>
                                    <option>YEAR2</option>
                                    <option>YEAR3</option>
                                    <option>YEAR4</option>
                                </select> </div>
                                <div><img id="imageIcon" src="image/check.png"><select name="depart">
                                    <option>Chose Department Name</option>
                                    <?php foreach ($depart as $departEdit) {
                                    ?>
                                    <option> <?php echo $departEdit['departmentName']; ?></option>
                                    <?php } ?>
                                       </select></div>
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                           </form>
                      </div>

                      <!-- Add new facilitator -->
                      <div id="addfacil" style="display:none">
                          <h1>Add New Facilitator</h1>
                          <form method="post" action= "updateFacilitator.php"> 
                                <div><img id="imageIcon" src="image/check.png"><input type="text" placeholder="First Name" name="firstName"></div>
                                <div><img id="imageIcon" src="image/check.png"> <input type="text" placeholder="Last Name" name="lastName"></div>
                                <div><img id="imageIcon" src="image/check.png"> <input type="email" placeholder="Email address" name="email"></div>
                                <div><img id="imageIcon" src="image/check.png"> <input type="number" placeholder="Phone number" name="phone"></div>   
                                <div><img id="imageIcon" src="image/check.png"> <select name="level">
                                    <option>Select the level</option>
                                    <option>YEAR1</option>
                                    <option>YEAR2</option>
                                    <option>YEAR3</option>
                                    <option>YEAR4</option>
                                </select> </div>
                                <div><img id="imageIcon" src="image/check.png"><select name="depart">
                                    <option>Chose Department Name</option>
                                    <?php foreach ($depart as $departEdit) {
                                    ?>
                                    <option> <?php echo $departEdit['departmentName']; ?></option>
                                    <?php } ?>
                                </select></div>
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                           </form>
                      </div>


                       <!-- Add new Department -->
                       <div id="addCourse" style="display:none">
                          <h1>Add New Course</h1>
                          <form method="post" action= "updateCourse.php"> 
                                <div><img id="imageIcon" src="image/check.png"><input type="text" placeholder="Course Name" name="course"></div>
                                <div><img id="imageIcon" src="image/check.png"> <select name="level">
                                    <option>Select the level</option>
                                    <option>YEAR1</option>
                                    <option>YEAR2</option>
                                    <option>YEAR3</option>
                                    <option>YEAR4</option>
                                </select> </div>
                                <div><img id="imageIcon" src="image/check.png"><select name="depart">
                                    <option>Chose Department Name</option>
                                    <?php foreach ($depart as $departEdit) {
                                    ?>
                                    <option> <?php echo $departEdit['departmentName']; ?></option>
                                    <?php } ?>
                                </select></div>
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                           </form>
                      </div>


                      <!-- Add group of student -->
                      <div id="addGroup" style="display:none">
                          <h1>Add a group of Student</h1>
                          <form method="post" action= "updateGroup.php"> 
                          <label>Follow this format to register more than on student. All students parameters should be separated by slash / and
                          different information concerning each others should be separated by commer. No space allowed between parameters.</br></br></label>
                          <label>Format:</br> <i>firstName1/lastName1/email/level/Department Name/phone,firstName2/lastName3/email/level/DepartmentName/phone</i></br></label>
                          <label>ex:</br> <i>Mamady/Kante/makante17@alustudent.com/Year1/Computer Science/075852452,Kevin/Sabineza/kevin@alustudent.com/Year3/Global Challenge/075844252</i></label>
                         
                                <div> <input type="text" name="allHere" placeholder="All here"></div>
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                           </form>
                      </div>


                      <!-- Delete  new info -->
                      <div id="delStudent" style="display:none">
                          <h1>Delete a Student</h1>
                          <form method="post" action= "deleteStudent.php"> 
                                <div><img id="imageIcon" src="image/check.png"><input type="email" placeholder="email address" name="email"></div>
                                <div><img id="imageIcon" src="image/check.png"> <select name="level">
                                    <option>Select the level</option>
                                    <option>YEAR1</option>
                                    <option>YEAR2</option>
                                    <option>YEAR3</option>
                                    <option>YEAR4</option>
                                </select> </div>
                              
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                           </form>
                      </div>


                      <!-- Delete  Facilitator -->
                      <div id="delFacilitator" style="display:none">
                          <h1>Delete a facilitator</h1>
                          <form method="post" action= "deleteFacilitator.php"> 
                                <div><img id="imageIcon" src="image/check.png"><input type="email" placeholder="email address" name="email"></div>
                                <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                           </form>
                      </div>
                 </div>
            </div>





           <!-- Student's notification -->
            <div style="display:none" id="notifyExcuses">
                <h1>Student notifcation board</h1>
                <div id="listNotified">
                       <h1 style="margin-left:2px">
                       <img style="width:30px; height:30px; margin-top:-9px; margin-right:5px; float:left" src="image/icons8-list-64.png">
                        List of notification</h1>
                     <!-- List all students with their message -->
                     <?php foreach ($responseNotification as $repNotified) { ?>
                            <div id='noteStudent'>
                                <img src="image/fred.jpg">
                                <div id='infoIn'>
                                        <p><?php echo $repNotified['message']; ?></p>
                                        <p style="color:rgb(216, 124, 4)"><?php echo $repNotified['courseName']; ?></p>
                                        <p style="float:right; color:green"><?php echo $repNotified['date']; ?></p>
                                </div>
                            </div>
                     <?php } ?>
                </div>
                <div id="notifyFor">
                
                     <h1 style="margin-left:2px">
                     <img style="width:30px; height:30px; margin-top:-9px; margin-right:5px; opacity:1; float:left" src="image/icons8-form-24.png">
                    
                     Notify for an excuse</h1>
                    <!-- Form make new notification -->
                    <form method="post" action= "makeNotification.php"> 
                        <div><img id="imageIcon" src="image/check.png"><input type="email" placeholder="Student email" name="email"></div>
                        <div>
                            <img id="imageIcon" src="image/check.png">
                            <select name="course"> 
                                    <option>Chose Course Name</option>
                                    <?php foreach ($course as $courseEdit) {
                                        ?>
                                    <option> <?php echo $courseEdit['courseName']; ?></option>
                                    <?php } ?>
                            </select>
                            
                        </div> 

                        <div><img id="imageIcon" src="image/check.png"><input type="email" placeholder="Facilitator email" name="emailF"></div>
                        <div><img id="imageIcon" src="image/check.png"><input type="date" name="date"></div>      
                        <div><img id="imageIcon" src="image/check.png"><input type="text" placeholder="Describe your motif" name="message"></div>
                        <div> <input style="margin-left:35px; width:87%; border-radius:5px; height:30px; background-color: green" type="submit"> </div>
                    </form>
                </div>
            </div> 










            <!-- Graph + Table -->
            <div id="useIt">
                <!--Float Left Container  #######################################-->
                <div id="tableOfContent">
                    
                    <!-- All possible queries Container *******************************// -->
                    <div id="dataOperation">
                       
                        <!-- First form1 -->
                        <div id="Formbutt" >
                            <button id="searchName" onclick="displayThing()"><img id="imageIcon" src="image/Web Database.png"> <h2>course Att</h2></button>
                            <?php include 'form1.php';  ?>   
                        </div>

                        <!-- Second Form2 -->
                        <div id="Formbutt" >
                            <button id="searchName" onclick="displayThing1()"><img id="imageIcon" src="image/Web Database.png"> <h2>Att Between.</h2> </button>
                            <?php include 'form2.php'; ?>   
                        </div>


                        <!-- Second Form2 -->
                        <div id="Formbutt" >
                            <button id="searchName" onclick="displayForm3()"><img id="imageIcon" src="image/Web Database.png"> <h2>Weekly Att</h2> </button>
                            <?php include 'form3.php'; ?>   
                        </div>

                        <!-- Filter by name -->
                        <div id="Formbutt" >
                            <button id="searchName" onclick="nameFilter1()"><img id="imageIcon" src="image/Web Database.png"> <h2>Cohort Att</h2></button> 
                            <?php include 'form5.php'; ?> 
                        </div>
                        
                        <!-- Filter by email -->
                        <div id="Formbutt" onclick="emailFilter1()">
                            <button id="searchEmail" ><img id="imageIcon" src="image/Web Database.png"> <h2>By Email</h2></button>   
                            <form id="emailFilter" name="emailFilter" action="searchByemail.php" method="post">
                                <div id="searchMenu"> 
                                    <img id="imageIcon" src="image/add.png"> 
                                    <input type="email" name="email" placeholder="User email">
                                </div>
                                <input id="submit" type="submit" name="filter" value="Load">     
                            </form>
                        </div>

                     
                        

                        <!-- Filter By Attendence -->
                        

                    </div>
                    
                    <!-- Use it Data fetched on the page content **************************// -->
                    <div id="operationResult" style="display:none">

                        <table>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email address</th>
                                <th>Department</th>
                                <th>Level</th>
                            </tr>
                            <?php
                            // Calculate or count the number of elements belows
                                $counter = 0;
                                $CSNumber = 0;
                                $GCNumber =0;
                                $IBTNumber = 0;
                                $Y1Number = 0;
                                $Y2Number = 0;
                                $Y3Number = 0;
                            //  Condition to count them
                            foreach ($testResult as $data) {
                                $counter = $counter + 1;
                                if ($data['departmentName'] == "Computer Science") {
                                    $CSNumber = $CSNumber + 1;
                                }
                                if ($data['departmentName'] == "Global Challenge") {
                                    $GCNumber = $GCNumber + 1;
                                }
                                if ($data['departmentName'] == "IBT") {
                                    $IBTNumber = $IBTNumber + 1;
                                }
                                if ($data['level'] == "YEAR1") {
                                    $Y1Number =  $Y1Number + 1;
                                }
                                if ($data['level'] == "YEAR2") {
                                    $Y2Number =  $Y2Number + 1;
                                }
                                if ($data['level'] == "YEAR3") {
                                    $Y3Number =  $Y3Number + 1;
                                }
                            ?>

                            <tr>
                                <td> <?php echo $data['firstName'];  ?></td>
                                <td> <?php echo $data['lastName'];  ?></td>
                                <td> <?php echo $data['email'];  ?></td>
                                <td> <?php echo $data['departmentName'];  ?></td>
                                <td> <?php echo $data['level'];  ?></td>
                              
                            </tr>
                            <?php } ?>
                        
                        </table>

                        <!-- Second table -->
                        


                    </div>

                    <div id='resultFound'>
                       <h2 style="padding-top:15px"> <img style="width:25px; height:25px; margin-top:-5px; margin-right:5px; float:left" src="image/icons8-query-50.png">
                      Research Query </h2>
                        <?php $query = $_SESSION['query']; ?>
                        <p style="font-size:12px; padding-left:15px; line-height:22px;  color:rgb(44, 0, 152);"><?php echo $query; ?></p>
                       
                        <h2> <img style="width:25px; height:25px; margin-top:-5px; margin-right:5px; float:left" src="image/view.png">
                      Query Result </h2>
                      <div id="operationResult">
                      <table> 
                            <tr>
                            <?php  
                            //  create automatic header
                                $headTabble = $_SESSION['header'];
                                $trfetch = explode('/', $headTabble);
                                foreach ($trfetch as $allth) {
                                    ?>                
                                        <th><?php echo $allth; ?></th>
                                <?php } ?> 
                            </tr>

                            <?php  
                            // session_start();
                            $scripted= $_SESSION['dataTable'];
                            // echo $scripted;
                            // $phrase = '';
                            $scripts = explode(',', $scripted);
                            foreach ($scripts as $endScript) {
                                ?>
                                <tr>

                                <?php
                                $endScript2 = explode('/', $endScript);
                                
                                foreach ($endScript2 as $myscript) { ?>

                                    <td><?php echo $myscript; ?></td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            
                           </table>
                       </div> 
                   </div>



                   <!-- Select info by month -->

                    <div style="width:95%; height:30px; margin-left:10px; margin-top:20px; float:left">
                        <h1 style="font-size:14px; margin-top:0px; margin-right:10px; color:rgb(39, 233, 207); float:left">SELECT DATE</h1>
                            <form action="monthToChange.php" method="post">
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
                    <div id="operationResult">
                          <?php include "tablePresence.php"; ?>
                    </div>  


                    <!-- List the number of rows and columns for the **********************************//
                     research and fetch them as pie chart -->
                    <div id="ColRows">
                        <p>Rows: <?php echo $counter; ?>  Columns: 4</p> 
                        <!-- Chart that display Different student from ALU Department -->
                        <div style="width:250px; height:250px; float:left" id="chartI"></div>
                        <div style="width:270px; height:270px; float:left" id="chartJ"></div>
                    </div>

                </div>

            
                <!-- Float Right display the content of Graphs of every queries ####################################################-->
                <div id="graphDisplay">

                   <div>
                        <h2>Presence</h2>
                        <div id='chart1'></div>
                    </div>
                    <!-- End morris code -->
                    <div>
                        <h2>Monthly Presence</h2>
                        <div id="apexchart1"></div>
                    </div>

                    <div id="attendence" style="height:250px;">
                        <h1 style='font-size:14px; color:black'>Information by Course</h1>
                        <div id="iclude">
                        <script>
                        for (let key in presenceCourse){
                            var intact = presenceCourse[key];
                            document.getElementById("iclude").innerHTML +=
                            "<div style='width:100%; border-bottom:1px solid rgb(226, 226, 226); height:30px; margin-bottom:5px; float:left'>" 
                                    + "<h2 style='font-size: 12px; font-weight:normal; float:left'>" + key + ": </h2>" 
                                    + "<ul style='font-size: 12px; display:inline;'>"+
                                        " <li style='list-style:none; color:black;  margin-left:10px;  float:left'>"+"<p style='margin-top:3px; float:right; color:black; font-size:13px'>Present</p>"+ "<div style='width:20px; margin-top:0px; margin-right:5px; background-color:rgb(39, 233, 207); font-size:12px; text-align:center; height:20px; border:1px solid rgb(39, 233, 207); border-radius:25px; float:left'>"+ "<p style='margin-top:0px; color:white; font-size:15px'>"+ intact["Present"]  + "</p>"+ "</div>"  +"</li>" +
                                        " <li style='list-style:none; color:black; margin-left:10px; float:left'>"+ "<p style='margin-top:3px; float:right; color:black; font-size:13px'>Absent</p>"+ "<div style='width:20px; margin-top:0px; margin-right:5px; background-color:rgb(49, 151, 235); font-size:12px; text-align:center; height:20px; border:1px solid rgb(49, 151, 235); border-radius:25px; float:left'>"+ "<p style='margin-top:0px; color:white; font-size:15px'>"+ intact["Absent"]  + "</p>"+ "</div>"  +"</li>" 
                                    + "</ul>" +
                            "</div>";
                            //  document.getElementById("iclude").innerHTML += "<h1>"+ key + ":  Present " + intact["Present"] + "-  Absence " + intact["Absent"] + "</h1>";
                        }

                        </script>
                        </div>
                    </div>




                </div>
            </div>

        </section>

    </body>

    <!-- ============================================SCRIPYT============================================== -->


    <!-- Moris cript -->
    <script> 
         
        // Display the first form form1
        function displayThing(){
        
            if (document.getElementById('form1').style.display =="none") {
                document.getElementById('form1').style.display="inline-block";
                document.getElementById('preNumber').style.display="none"; 
                document.getElementById('form3').style.display="none";
                document.getElementById('nameFilter').style.display="none";
                document.getElementById('emailFilter').style.display="none";

            }else{
                document.getElementById('form1').style.display="none";
            } 
        }
        
        // Display the second form form2
        function displayThing1(){
            if (document.getElementById('preNumber').style.display =="none") {
                document.getElementById('preNumber').style.display="inline-block";
                document.getElementById('form1').style.display="none"; 
                document.getElementById('form3').style.display="none";
                document.getElementById('nameFilter').style.display="none";
                document.getElementById('emailFilter').style.display="none";
                
            }else{
                document.getElementById('preNumber').style.display="none";
            } 
        }
     
         // Display the second form form3
         function displayForm3(){
            if (document.getElementById('form3').style.display =="none") {
                document.getElementById('form3').style.display="inline-block";
                document.getElementById('form1').style.display="none"; 
                document.getElementById('preNumber').style.display="none";
                document.getElementById('nameFilter').style.display="none";
                document.getElementById('emailFilter').style.display="none";
                
            }else{
                document.getElementById('form3').style.display="none";
            }
        }

           // Drop down the nameFilter
           function nameFilter1(){
            if (document.getElementById('nameFilter').style.display =="none") {
                document.getElementById('nameFilter').style.display="inline-block";
                document.getElementById('form1').style.display="none"; 
                document.getElementById('preNumber').style.display="none";
                document.getElementById('form3').style.display="none";
                document.getElementById('emailFilter').style.display="none";
                
            }else{
                document.getElementById('nameFilter').style.display="none";
            }
           }

          // Drop down the nameFilter
          function emailFilter1() {
            if (document.getElementById('emailFilter').style.display =="none") {
                document.getElementById('emailFilter').style.display="inline-block";
                document.getElementById('form1').style.display="none"; 
                document.getElementById('preNumber').style.display="none";
                document.getElementById('form3').style.display="none";
                document.getElementById('nameFilter').style.display="none";
                
            }else{
                document.getElementById('emailFilter').style.display="none";
            }
          }

       
         // Table contents
           // General Info useIT
        function displayThing5(){
            document.getElementById('useIt').style.display="inline-block";
            document.getElementById('updateinfo').style.display="none"; 
            document.getElementById('community').style.display="none";
            document.getElementById('documentation').style.display="none";
            document.getElementById('changeMark').style.display="none";
            document.getElementById('helpCenter').style.display="none"; 
            document.getElementById('notifyExcuses').style.display="none";
         
        }

        // Excuse notification
        function displayThing10(){
            document.getElementById('notifyExcuses').style.display="inline-block";
            document.getElementById('useIt').style.display="none";
            document.getElementById('updateinfo').style.display="none"; 
            document.getElementById('community').style.display="none";
            document.getElementById('documentation').style.display="none";
            document.getElementById('changeMark').style.display="none";
            document.getElementById('helpCenter').style.display="none"; 
         
        }
        // Community
        function displayThing3(){
            document.getElementById('community').style.display="inline-block";
            document.getElementById('updateinfo').style.display="none"; 
            document.getElementById('useIt').style.display="none";
            document.getElementById('documentation').style.display="none";
            document.getElementById('changeMark').style.display="none";
            document.getElementById('helpCenter').style.display="none"; 
            document.getElementById('notifyExcuses').style.display="none";
        }


        //    Documentation
        function displayThing4(){
            document.getElementById('documentation').style.display="inline-block"; 
            document.getElementById('updateinfo').style.display="none"; 
            document.getElementById('useIt').style.display="none";
            document.getElementById('community').style.display="none";
            document.getElementById('changeMark').style.display="none";
            document.getElementById('helpCenter').style.display="none"; 
            document.getElementById('notifyExcuses').style.display="none";
        }

        function displayThing6(){
            // change Mark
            document.getElementById('changeMark').style.display="inline-block";
            document.getElementById('updateinfo').style.display="none"; 
            document.getElementById('useIt').style.display="none";
            document.getElementById('community').style.display="none";
            document.getElementById('documentation').style.display="none";
            document.getElementById('helpCenter').style.display="none"; 
            document.getElementById('notifyExcuses').style.display="none";
        }


       // Update the information
        function displayThing7(){
            document.getElementById('updateinfo').style.display="inline-block"; 
            document.getElementById('useIt').style.display="none";
            document.getElementById('community').style.display="none";
            document.getElementById('documentation').style.display="none";
            document.getElementById('changeMark').style.display="none";
            document.getElementById('helpCenter').style.display="none"; 
            document.getElementById('notifyExcuses').style.display="none";
        }

        // Help Center
        function displayThing8(){ 
            document.getElementById('helpCenter').style.display="inline-block"; 
            document.getElementById('updateinfo').style.display="none"; 
            document.getElementById('useIt').style.display="none";
            document.getElementById('community').style.display="none";
            document.getElementById('documentation').style.display="none";
            document.getElementById('changeMark').style.display="none";
            document.getElementById('notifyExcuses').style.display="none";
        
        }

        // Drop down logout in the menu bar
        function dropElement() {
            if (document.getElementById('logoutPage').style.display =="none") {
            document.getElementById('logoutPage').style.display="inline-block";
            document.getElementById('listOfNotifier').style.display="none";
            }else{
            document.getElementById('logoutPage').style.display="none";
            
            } 
        }
         // Ticket list
         function dropElement2() {
            if (document.getElementById('listTicket').style.display =="none") {
            document.getElementById('listTicket').style.display="inline-block";
            document.getElementById('noteTicket').style.display="inline-block";
            document.getElementById('logoutPage').style.display="none";
            }else{
            document.getElementById('listTicket').style.display="none";
            
            } 
        }

        // Notification list
        function dropElement1() {
            if (document.getElementById('listOfNotifier').style.display =="none") {
            document.getElementById('listOfNotifier').style.display="inline-block";
            document.getElementById('noteStudent').style.display="inline-block";
            document.getElementById('logoutPage').style.display="none";
            }else{
            document.getElementById('listOfNotifier').style.display="none";
            
            } 
        }
     
 </script>





 <script>

      var options = {
            chart: {
                type: 'donut',
            },
            series: [ <?php echo $Y2Number; ?>, <?php echo $Y1Number; ?>, <?php echo $Y3Number; ?>],
            labels: ['Year1 Students','Year2 Students','Year3 Students'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    
        
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }

       var chartJ = new ApexCharts(
            document.querySelector("#chartJ"),
            options
        );
        
        chartJ.render();

</script>


<script>
var options = {
            chart: {
                type: 'donut',
            },
            series: [<?php echo $CSNumber; ?>, <?php echo $IBTNumber; ?>, <?php echo $GCNumber; ?>],
            labels: ['CS Students','IBT Students','GC Students'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    
        
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }

       var chartI = new ApexCharts(
            document.querySelector("#chartI"),
            options
        );
        
        chartI.render();

</script>

    <!-- Create ApexChart.js -->
    <script>
            var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30,40,35,50,49,60,70,91,125]
            }],
            xaxis: {
                categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
            }
            }

            var chart = new ApexCharts(document.querySelector("#apexchart"), options);

            chart.render();
        
    </script>


    <!-- Morris CHart settling to display data -->
    <script>
        Morris.Bar({
            element:'chart',
            data:[<?php echo $chart_data; ?>],
    
            xkey:'userId',
            ykeys:['numberAttended', 'Month'],
            labels:['numberAttended', 'Month'],
            hideHover:'auto'
            // stacked:true

        });

    </script>

    <!-- Chart about user presence -->
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
                    document.querySelector("#chart1"),
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

            var chart = new ApexCharts(document.querySelector("#apexchart1"), options);

            chart.render();
        
    </script>

</html>
