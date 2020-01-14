
 <form  id="nameFilter" name="nameFilter" action="searchByName.php" method="post">
            
          <!-- Cohort -->
        <div id="searchMenu">
            <img id="imageIcon" src="image/add.png"> 
            <select style="height:25px" name= 'level'>
                <option>Choose the level</option> 
                <option>Year1</option>
                <option>Year2</option>
                <option>Year3</option>
                <option>Year4</option>
                
            </select>  
        </div>

        
        <div id="searchMenu">
            <img id="imageIcon" src="image/add.png"> 
            <select style="height:25px" name= 'cohort'>
                <option>Choose Cohort Name</option> 
                <option>Cohort1</option>
                <option>Cohort2</option>
            </select>  
        </div>
        
        
        <div id="searchMenu">
            <img id="imageIcon" src="image/add.png">
            <select name="depart"> 
                <option>Chose Department Name</option>
                <?php foreach ($depart as $departEdit) {
                ?>
                <option> <?php echo $departEdit['departmentName']; ?></option>
                <?php } ?>
            </select>
        </div>

        
        <div id="searchMenu">
            <img id="imageIcon" src="image/add.png">
            <select name="course"> 
                <option>Chose Course Name</option>
                <?php foreach ($course as $courseEdit) {
                ?>
                <option> <?php echo $courseEdit['courseName']; ?></option>
                <?php } ?>
            </select>
        </div>
      

        <!-- Choose the month -->
        <!-- Select the Month -->
        <div id="searchMenu">
                <img id="imageIcon" src="image/add.png"> 
                <select style="height:25px" name="month">
                    <option>Choose the month</option>
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
            </div> 

            <div id="searchMenu">   
                    <label style="margin-top:10px;">Date</label>
                    <input type="date" name="date" placeholder="Chose date">
            </div>
            

        <!-- Submit the form -->
        <input type="submit" value="Load">

</form>

