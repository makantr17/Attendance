<!DOCTYPE html>      
          
<html>
    <head>
            <!-- Start morris code -->
            <title>HomePage</title>
            <link rel="stylesheet" href="styleHome.css">
         
    </head>
    

    <body>

        <!--  -->
        <section id="homepage">
            <!-- Menu bar -->
            <div id="menuBar">
                <div id="menu">
                    <ul>
                        <li><a style="text-decoration: none; color:white" href ="http://localhost:8000/home.php">Home</a></li>
                        <li><a  style="text-decoration: none; color:white" href ="http://localhost:8000/processDash.php">Dashboard</a></li>
                        <li>Log in
                            <ul> 
                                <li><a href="http://localhost:8000/logInsystem.php">Facilitator</a></li>
                                <li><a href="http://localhost:8000/logInsystem.php">Student</a></li>
                                <li><a href="http://localhost:8000/facilitatorLogin.php">Sponshor</a></li>
                            </ul>
                        </li>
                    </ul>
                </div> 

                <div id="imageLef">
                    <div id="description">
                        <h1>SPONSORS </h1>
                        <p>- Check my presence through a period</p>
                        <p>- General Presence through month</p>
                        <p>- Make a report</p>
                    </div>

                    <div id="description">
                        <h1>STUDENT </h1>
                        <p>- Check my presence through a period</p>
                        <p>- Make a request for my presence</p>
                        <p>- Notified my Absence</p>
                    </div>

                    <div id="description">
                        <h1>FACILITATOR </h1>
                        <p>- Check Student presence through a period and general info related to his class</p>
                        <p>- Make new attendence and update existing attendence</p>
                        <p>- Being Notified by Students</p>
                        <p>- Make a report</p>
                    </div>
                </div>



            </div>


            <!-- All the content -->
            <div id="content">
                <h1>TRACK STUDENT' ATTENDENCE</h1>
                <div id="cover">
                    <img id="replace" src="image/backG.jpg">
                </div>

                <div id="about">
                   
                    <p id="message">ALU University is a Panafrican University the most growing leadership
                       and connectivity. Extended in 2017 from the previous University of Ile moris by the 
                       the most powerful African leader Fred Swaniker.
                       ALU Community African leadership University community know for his quality 
                     </p>
                </div>

                <div id="slide">
                    <div id="icons">
                        <img id="simage1" src="image/backG.jpg">
                        <button onclick="slide1Function()" id="slide1">1</button>
                        <p style="display:none" id="smessage1">
                            Extended in 2017 from the previous University of Ile moris by the 
                            the most powerful African leader F
                        </p>
                    </div>

                    <div id="icons">
                        <img id="simage2" src="image/communi.jpg">
                        <button onclick="slide2Function()" id="slide2">2</button>
                        <p style="display:none" id="smessage2">
                        ul African leader Fred Swaniker.
                       ALU Community African lead
                        </p>
                    </div>

                    <div id="icons">
                        <img id="simage3" src="image/proALU.jpg">
                        <button onclick="slide3Function()" id="slide3">3</button>
                        <p style="display:none" id="smessage3">
                        ALU University is a Panafrican University the most growing leadership
                       and connect
                        </p>
                    </div>
                
                </div>

                <script>
                    
                    function slide1Function() {
                        document.getElementById('simage2').style.width = "60px";
                        document.getElementById('simage2').style.height = "60px";
                        document.getElementById('simage2').style.position = "none";
                        document.getElementById('simage2').style.margin = "0px";
                        document.getElementById('simage2').style.marginBottom = "10px";
                        document.getElementById('simage2').style.border = "1px solid gray";

                        document.getElementById('simage3').style.width = "60px";
                        document.getElementById('simage3').style.height = "60px";
                        document.getElementById('simage3').style.position = "none";
                        document.getElementById('simage3').style.margin = "0px";
                        document.getElementById('simage3').style.marginBottom = "10px";
                        document.getElementById('simage3').style.border = "1px solid gray";


                        
                        document.getElementById('simage1').style.width = "70px";
                        document.getElementById('simage1').style.height = "70px";
                        document.getElementById('simage1').style.position = "relative";
                        document.getElementById('simage1').style.margin = "-5px";
                        document.getElementById('simage1').style.marginBottom = "15px";
                        document.getElementById('simage1').style.border = "1px solid tomato";

                        document.getElementById('replace').src=document.getElementById('simage1').src;
                        document.getElementById('message').textContent=document.getElementById('smessage1').textContent;
                     
                    }
                    function slide2Function() {
                        
                        document.getElementById('simage1').style.width = "60px";
                        document.getElementById('simage1').style.height = "60px";
                        document.getElementById('simage1').style.position = "none";
                        document.getElementById('simage1').style.margin = "0px";
                        document.getElementById('simage1').style.marginBottom = "10px";
                        document.getElementById('simage1').style.border = "1px solid gray";

                        document.getElementById('simage3').style.width = "60px";
                        document.getElementById('simage3').style.height = "60px";
                        document.getElementById('simage3').style.position = "none";
                        document.getElementById('simage3').style.margin = "0px";
                        document.getElementById('simage3').style.marginBottom = "10px";
                        document.getElementById('simage3').style.border = "1px solid gray";

                        document.getElementById('simage2').style.width = "70px";
                        document.getElementById('simage2').style.height = "70px";
                        document.getElementById('simage2').style.position = "relative";
                        document.getElementById('simage2').style.margin = "-5px";
                        document.getElementById('simage2').style.marginBottom = "15px";
                        document.getElementById('simage2').style.border = "1px solid tomato";

                        document.getElementById('replace').src=document.getElementById('simage2').src;
                        document.getElementById('message').textContent=document.getElementById('smessage2').textContent;
                     
                    }
                    function slide3Function() {
                        document.getElementById('simage1').style.width = "60px";
                        document.getElementById('simage1').style.height = "60px";
                        document.getElementById('simage1').style.position = "none";
                        document.getElementById('simage1').style.margin = "0px";
                        document.getElementById('simage1').style.marginBottom = "10px";
                        document.getElementById('simage1').style.border = "1px solid gray";

                        document.getElementById('simage2').style.width = "60px";
                        document.getElementById('simage2').style.height = "60px";
                        document.getElementById('simage2').style.position = "none";
                        document.getElementById('simage2').style.margin = "0px";
                        document.getElementById('simage2').style.marginBottom = "10px";
                        document.getElementById('simage2').style.border = "1px solid gray";

                        document.getElementById('simage3').style.width = "70px";
                        document.getElementById('simage3').style.height = "70px";
                        document.getElementById('simage3').style.position = "relative";
                        document.getElementById('simage3').style.margin = "-5px";
                        document.getElementById('simage3').style.marginBottom = "15px";
                        document.getElementById('simage3').style.border = "1px solid tomato";


                        document.getElementById('replace').src=document.getElementById('simage3').src;
                        document.getElementById('message').textContent=document.getElementById('smessage3').textContent;
                     
                    }
                </script>
            </div>

            <div id="toutIci">
                <div id="processContent">
                <div id="contentIn">
                        <h1>Create or Edit Attendence</h1>
                        <p>To create a new attendence in the platform, you have to follow some processes and fulfill the
                        norme required to create or to edit the attandence. To be eligible with this process, check <a href="http://localhost:8000/home.php">this eligibility</a>
                        points. Below, find the next steps:
                        </p>
                        <ul>
                                 <li>Log-in with your facilitator account</li>
                                 <li>On the left menu, click on Mark Attendence. <br> The new window will open at the 
                                 right of the menu. And there we have both options Create or edit attandence.</li>  
                        </ul>
                    </div>
                    <div id="contentIn">
                        <img style="width:90%; height:300px; margin-top:20px; " src="image/dash12.png">
                    </div>
                    
                </div>

                <div id="processContent">
                    <div id="contentIn">
                        <h1>Excuses notification</h1>
                        <p>To send a new excuses for class in the platform, you have to follow some processes and fulfill the
                        norms required to send the notification. To be eligible with this process, check <a href="http://localhost:8000/home.php">this eligibility</a>
                        points. Below, find the next steps:
                        </p>
                        <ul>
                                 <li>Log-in with your student's account</li>
                                 <li>On the left menu, click on Excuse Notification. <br> The new window will open at the 
                                 right of the menu. And there we have both options list of the notification and Notify for an excuse.</li>  
                                 <li>Fill the form</li>
                                 <li>Submit</li>
                        </ul>
                    </div>

                    <div id="contentIn">
                        <h1>Request for Helps</h1>
                        <p>To request helps from the platform, you have to follow some processes and fulfill the
                        norms required. To be eligible with this process, check <a href="http://localhost:8000/home.php">this eligibility</a>
                        points. Below, find the next steps:
                        </p>
                        <ul>
                                 <li>Log-in with your account as facilitator, student or the user root</li>
                                 <li>On the left menu, click on Helps. <br> The new window will open at the 
                                 right of the menu. And there we have some options</li>  
                                 <li>Click on the button Book Ticket</li>
                                    <ul>
                                       <li>Fill well the form</li>
                                       <li>submit</li>
                                    </ul>
                                 
                                 <li>Click on See All which display all the updates</li>
                                 <li>Click on Fulfill which allows the admin to update the actual state of the job</li>
                                 <ul>
                                       <li>Fill well the form</li>
                                       <li>submit</li>
                                </ul>
                        </ul>
                    </div>

                    <div id="contentIn">
                        <h1>Update</h1>
                        <p>To Add or Delete new information from the database attendence in the platform, you have to follow some processes and fulfill the
                        norms required. To be eligible with this process, check <a href="http://localhost:8000/home.php">this eligibility</a>
                        points. Below, find the next steps:
                        </p>
                        <ul>
                                 <li>Log-in with your Admin account</li>
                                 <li>On the left menu, click on Update. <br> The new window will open at the 
                                 right of the menu. And there we have the list of options.</li>  
                                 <ul>
                                       <li>ADD NEW STUDENT </li>
                                       <li>ADD NEW FACILITATOR</li>
                                       <li>ADD NEW COURSE</li>
                                       <li>ADD GROUP OF STUDENT</li>
                                       <li>DELETE STUDENT</li>
                                       <li>DELETE FACILITATOR</li>

                                </ul>
                                <li>Click on the specific button and pursue the next steps:</li>
                                <ul>
                                       <li>Fill well the form</li>
                                       <li>submit</li>
                                </ul>
                                 
                        </ul>
                    </div>

                    <div id="contentIn">
                        <h1>DRS Attandence system</h1>
                        <img style="width:90%; height:300px; margin-top:20px; " src="image/dash12.png">
                        <p>DRS attandence system is a new attandence system that allows the community to store informations and retrieve it when needed.
                            It gives access to users and allow the university or school to take the presence of student and keep track of the daily
                            presence of their students from daily, weekly, monthly and yearly based.
                        </p>
                    </div>
                </div>

                <div id="processContent">
                    <div id="contentIn">
                        <h1>How to do a search</h1>
                        <p>To do a research about your presence in daily weekly monthly based, the DRS attandence platform
                            provides a simple way of accessing information. We system explode five searching element outlined below:<br>
                        </p>
                        <p>- Student attandence to a class's course between days of the month</p>
                        <p>- Student attandence to the class's courses between days of the month</p>
                        <p>- Student weekly attandence to all classes from a month</p>
                        <p>- Student daily cohort attandence to the class's courses</p>
                        <p>- Check the existance of student</p>
                        <p>- Student monthly presence</p>

                    <div>
                </div>



            </div>

            <!-- Search operation -->
              

        </section>

        <footer>
            <div>
                <h1>Helps</h1>
                <ul>
                    <li>Need helps</li>
                    <li>Accessibility</li>
                    <li>Charts</li>
                    <li>Data explaination</li>
                </ul>
               
            </div>

            <div>
                <h1>About DRS</h1>
                <ul>
                    <li>Utility</li>
                    <li>Process</li>
                    <li>Accessibility</li>
                    <li>Account</li>
                </ul>
               
            </div>

            <div>
                <h1>Users</h1>
                <ul>
                    <li>DRS Users</li>
                    <li>Log in</li>
                    <li>Create Account</li>
                    
                </ul>
               
            </div>
        
        </footer>

    </body>

   

</html>