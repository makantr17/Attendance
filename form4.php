<h2>Edit Attendence</h2>
<div  onclick="closeit()" style="float:right; width:20px; height:20px; padding:5px; margin-top:-40px; background-color: rgba(233, 223, 223, 0.616); margin-right:25px; "><img style="width:20px; height:20px" id="supIcons" src="image/close.png"></div>
 <!--  Find the list of presence during a specific period  for the specific department-->
<form id="stylePopUp" action="updateLastAttendence.php" method="post">
   
   
<!-- Your level  -->
   <div>
   <img id="supIcons" src="image/column.png">
        <select name="level">
            <option>Choose the Level</option>
                <?php  foreach ($level as $levelName) { ?>
            <option><?php echo $levelName['level']; ?></option>    
                <?php } ?>
        </select>
    </div>
       


<!-- sear=  dpartment-->
  <div>
  <img id="supIcons" src="image/column.png">
        <select name="department" >
                <option>Choose the Department</option>
                <?php  foreach ($depart as $dapartName) { ?>
                <option><?php echo $dapartName['departmentName']; ?></option>    
                <?php } ?>
        </select> 
   </div>



 <div>
 <img id="supIcons" src="image/column.png">
  <select  name="course">
       <option>Choose the Course</option>
       <?php  foreach ($course as $courseN) { ?>
       <option><?php echo $courseN['courseName']; ?></option>    
       <?php } ?>
   </select> 

 </div>

   <!-- Specify the course-->
 <div>
 <img id="supIcons" src="image/column.png">
   <select  name="cohort">
       <option>Choose the Cohort</option>
       <?php  foreach ($cohort as $cohortN) { ?>
       <option><?php echo $cohortN['cohort']; ?></option>    
       <?php } ?>
   </select> 
 </div>

 <div>
   <img id="supIcons" src="image/column.png">
   <select name="week">
       <option>Week1</option>
       <option>Week2</option>
       <option>Week3</option>       
   </select> 
</div>
 
<div>
    <img id="supIcons" src="image/column.png">
 
   <input type="date" name="date" placeholder="Specify Day">
</div>

<div>
   <input style="background-color:aqua; margin-left:35px" type="submit" name="submit" value="LOAD ATTENDANCE">
</div>
</form>