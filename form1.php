
        <form id="form1" style="display:none;"  action="getForm.php" method="post">
          
            <div id="searchMenu">
                <img id="imageIcon" src="image/add.png"> 
                <input type="email" name="email" placeholder="User Email">
            </div>
      

            <!-- Cohort -->
            <div id="searchMenu">
                <img id="imageIcon" src="image/add.png"> 
                <select style="height:25px" name= 'course'>
                    <option>Chose Course Name</option>
                    <?php  foreach ($course as $option3) { ?>
                    <option><?php echo $option3['courseName']; ?></option>
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
                

               <!-- Date range -->
                <div id="searchMenu">   
                    <label >From</label>
                    <input type="date" name="From" placeholder="From">
                </div>


                <div id="searchMenu">
                    <label >To</label>
                    <input type="date" name="To" placeholder="To">
                </div>


            <!-- Submit the form -->
            <input type="submit" value="Load">
            
        </form>
