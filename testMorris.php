<?php

session_start();

$department = $_SESSION["department"] ;
$course = $_SESSION["course"];
$level = $_SESSION["level"] ;


$connect = mysqli_connect("localhost", "root", "kantemamady92", "dashboard");
$query = "SELECT `Users`.`userId`, `Department`.`departmentId`,
`Attendence`.`numberAttended`, `Attendence`.`dateCreated`,
`Attendence`.`courseId`, `Attendence`.`departmentId`, `Users`.`departmentId`, `Department`.`departmentName`, `Users`.`departmentId`,
 `Users`.`level`, `Course`.`courseId`, `Course`.`courseName`, `Course`.`departmentId`
FROM `Users`, `Department`, `Course`, `Attendence`
Where `Users`.`userId`= 2 and `Attendence`.`userId` = `Users`.`userId` and `Attendence`.`departmentId` = `Department`.`departmentId`
and `Users`.`level` = '$level' and `Course`.`courseName` = '$course' and `Attendence`.`departmentId` = `Department`.`departmentId`";

$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
//    $chart_data .= "{ price :'".$row["price"]."', cost :".$row["cost"].", 
//     balance:".$row["balance"].", year:".$row["year"]." }, ";
      $chart_data .= "{ numberAttended :'".$row["numberAttended"]."', dateCreated :".$row["dateCreated"]." }, ";

}
$chart_data = substr($chart_data, 0, -2);

echo $_SESSION["department"];
echo "<br>";
echo  $_SESSION["course"];
echo "<br>";
echo $_SESSION["level"];



?>



<html> 
       <head>

            <title> Soft Tutorial zone find us on lisenme.com</title>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

       </head>
       <body>
            <br/> <br/>
            <div class="container" style="width:900px">
                <h2 align="center"> Morris.js chart with PHP & Mysql</h2>
		        <h3 align="center">Last 10 years profile </h3>
	         	<br /> <br />
	         	<div id="chart" style="width: 500px; height:350px"></div>
            </div>

        </body>

</html>

<script>
   Morris.Bar({

       element:'chart',
       data:[<?php echo $chart_data; ?>],
// xkey:'year',
// ykeys:['price', 'cost', 'balance'],
// labels:['price', 'cost', 'balance'],
xkey:'attendenceId',
ykeys:['numberAttended'],
labels:['numberAttended'],
hideHover:'auto'
// stacked:true 

});

</script>