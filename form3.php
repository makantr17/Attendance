      <!--  Find the list of presence during a specific period  for the specific department-->
        <form id="form3" style="display:none;"  action="fileAttendence.php" method="post">

            <div id="searchMenu">
                <img id="imageIcon" src="image/add.png"> 
                <input type="email" name="email" placeholder="User Email">
            </div>
      

            <!-- Cohort -->
            <div id="searchMenu">
                <img id="imageIcon" src="image/add.png"> 
                <select style="height:25px" name= 'week'>
                    <option>Choose Week Name</option> 
                    <option>Week1</option>
                    <option>Week2</option>
                    <option>Week3</option>
                    <option>Week4</option>
                    
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
                

            <!-- Submit the form -->
            <input type="submit" value="Load">
            
        </form>

