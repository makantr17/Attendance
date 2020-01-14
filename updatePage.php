<?php  
session_start(); 

include 'connect.php';

// Profile user
$userId = $_SESSION["userId"];
$email = $_SESSION["email"];

$fetch = "SELECT * from `Users` where `Users`.`email` = '$email'";
$resultFetch= mysqli_query($connect, $fetch); 
$fetchData = mysqli_fetch_all($resultFetch, MYSQLI_ASSOC);

$attWeek = $_SESSION["updWeek"];
$attDepart = $_SESSION["upddepartment"];
$attDate = $_SESSION["updDate"] ;   
$attLevel =$_SESSION["apdLevel"];
$attCourse =$_SESSION["updCourse"] ;   
$attCohort =$_SESSION["updCohort"] ;


$monthChosed = 'January' ;
?>


<?php 
     include 'connect.php';
      // Fetch information about User profile
      $sql = "SELECT Distinct `Users`.`firstName`, `Users`.`lastName`, `Users`.`email`, `Users`.`cohort`, `Users`.`level`
      ,`$monthChosed`.`Monday`, `$monthChosed`.`Tuesday`, `$monthChosed`.`Wednesday`, `$monthChosed`.`Thursday`,
      `$monthChosed`.`Friday`, `$monthChosed`.`Saturday`, `$monthChosed`.`Sunday`, `$monthChosed`.`email` 
      From `Users`, `$monthChosed`
      where `Users`.`email` = `$monthChosed`.`email` and `Users`.`cohort` = '$attCohort' "  ;

      $result= mysqli_query($connect, $sql); 
      $tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>  
     
<html>
     <head>
         <link rel="stylesheet" href="styleCreatedAtt.css">
         <title>Dashboard/CreateAttendence</title>
     </head>
    
    <body>

    <section id="sectionStyle">
      
         <div id="profile">
               
               <?php  foreach ($fetchData as $fetchResult) {
                  ?>
               <img src="/image/">
               <h2><?php echo $fetchResult['firstName']." ".$fetchResult['lastName']; ?></h2>
               <h2><?php echo $fetchResult['email']; ?></h2>
               <h2><?php echo $fetchResult['profession']." ".$fetchResult['level']; ?></h2>
            
               <?php } ?>
         </div>

         <div id="attInfo">
             <h2><?php echo $attDate; ?></h2>
             <h2><?php echo $attWeek; ?></h2>
             <?php
                 $_SESSION['actualMonth'] = $monthChosed;
             ?>
           

        </div>
        <!-- This is the form of updating the new Attendence -->
         <form name="update" method="post" action="udateEditAttendence.php"> 

         <div id="tableStyle">  
         <table>
                 <tr>
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Week</th>
                    <th>CourseName</th>
                 </tr>

                 <?php
                 
                 if ($fetchResult['profession'] == 'Student') {
                ?>
                <h1>You don't have acess to Take Attendence</h1>

                <?php  
                 }
                 else if ($fetchResult['profession'] == "Facilitator") {
                    $_SESSION['takingAttendence'] = $fetchResult['email'];
                    $varte = 0;
                 
                    
                // Loop the whole thing
                
                //  explode each element of the array
                   $myarr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                           
                   foreach ($tes2 as $data) {

                            foreach ($myarr as $nameDay) {  
                                    
                                $explodeValue = explode(',', $data["$nameDay"]);
                                for ($d=0; $d < sizeof($explodeValue) ; $d++) { 

                                    $simpleSliced = explode('/', $explodeValue[$d]);
                                    if ($simpleSliced[0] == $attDate and $simpleSliced[1] == $attWeek and $simpleSliced[2] == $attCourse) {
                                        ?> 
                                            <tr>                
                                                <td><?php echo $data['firstName']; ?></td>
                                                <td><?php echo $data['lastName'];  ?></td>
                                                <td>
                                                    <select id="selectEmail" name= '<?php echo "email".$varte; ?>'>
                                                        <option><?php echo $data['email']; ?></option>
                                                    </select>
                                                </td>
                                                <td><?php echo $simpleSliced[1]; ?></td>
                                                <td><?php echo $simpleSliced[0]; ?></td>
                                                <td><?php echo $simpleSliced[2]; ?></td>
                                                <td>
                                                    <select name= '<?php echo "record".$varte; ?>' >
                                                        <option><?php echo $simpleSliced[3]; ?></option>
                                                        <option>Present</option>
                                                        <option>Absent</option>
                                                        <option>Sick</option>
                                                        <option>Late</option>                             
                                                    </select>
                                                    
                                                </td>
                                                </tr>
                                        <?php  $varte = $varte + 1;    }
                                       
                                }  } }
               $_SESSION['varteNum'] =  $varte;
                            }
                       
            ?>
            

        </table>

        </div>
        <input style="width:120px; margin-left: 17%; height:30px; background-color:green;
         border:1px solid green; color:white;  margin-top:15px;" type="submit" value="UPDATE">
    
    </form>
    </section>

    </body>

</html>




