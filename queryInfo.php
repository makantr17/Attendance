<?php
session_start();

$queryZ = "SELECT `Users`.`userId`, `Department`.`departmentId`,
`Attendence`.`numberAttended`, `Attendence`.`Month`,`Attendence`.`Month`,
`Attendence`.`courseId`, `Attendence`.`departmentId`, `Users`.`departmentId`, `Department`.`departmentName`, `Users`.`departmentId`,
 `Users`.`level`, `Course`.`courseId`, `Course`.`courseName`, `Course`.`departmentId`
FROM `Users`, `Department`, `Course`, `Attendence`
Where `Users`.`userId`= '$userId' and `Attendence`.`userId` = `Users`.`userId` and `Attendence`.`departmentId` = `Department`.`departmentId`
and `Users`.`level` = '$level' and `Course`.`courseName` = '$course' and `Attendence`.`departmentId` = `Department`.`departmentId`";

?>