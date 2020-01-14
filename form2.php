      <!--  Find the list of presence during a specific period  for the specific department-->
        <form id="preNumber" style="display:none;"  action="specificSearch.php" method="post">
                
                <!--Select user name -->
                <div id="searchMenu">
                    <img id="imageIcon" src="image/add.png"> 
                    <input type="email" name="email" placeholder="Student email">
                </div>


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

                
                <input  type="submit" name="submit" value="Load">
    </form>