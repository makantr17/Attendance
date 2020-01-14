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
                        <li><a style="text-decoration: none; color:white" href ="http://localhost:8000/processDash.php">Dashboard</a></li>
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

            <div id="allHere">
                <div id="contentDiv">
                    <h1>ALU Attandence system</h1>
                    
                    <p>African leadership University has an amazing marketing known for its professionalism and
                        educational background quality to attrack more students. From 2017 to 2019, the community has triple
                        which was estimated at 300 students to 940 students. To predict this grow, the analysis proved that 
                        the demande is high according to student's registration, which appears to  be an important parameter for the future growth of ALU community.
                        The question is that, how can ALU manage the presence of all students during a year? 
                        how import is to have an automatic system that handle the presence of students and give the accessibility to 
                        all users?</p>
                </div>

                <div id="contentDiv">
                    <h1>DRS Attandence system</h1>
                    <img style="width:98%; height:380px; margin-top:20px; " src="image/imgDash.png">
                      <p>DRS attandence system is a new attandence system that allows the community to store informations and retrieve it when needed.
                         It gives access to users and allow the university or school to take the presence of student and keep track of the daily
                         presence of their students from daily, weekly, monthly and yearly based.

                      </p>
                </div>

                <div id="contentDiv">
                    <!-- Users Student -->
                     <h1>Users of The system</h1>
                     <div id="users">
                         <img src="image/community.jpg">
                         <h2>Student</h2>
                         <p>Student data are used for limit purpose which is beneficiary for 
                             your professional career
                         </p>
                     </div>
                     <!-- Users Facilitator -->
                     <div id="users">
                         <img src="image/sensor.jpg">
                         <h2>Facilitator</h2>
                         <p>They are the second users of the platform their objectif is to handle student's presence
                             during classes and respond to their notificatios
                         </p>
                     </div>
                     <!-- Users Sponsor -->
                     <div id="users">
                         <img src="image/fred.jpg">
                         <h2>Sponsor</h2>
                         <p>Check the presence of their student to assure their availability.
                         </p>
                     </div>
                </div>

                <div id="contentDiv">
                    <h1>The utility of the system</h1>
                    <p>The DRS attendence has an important role in the management of student's presence during the whole term.
                        It provides a limit functionality that allow users to perform specific tasks and fetch them 
                        when needed. 
                    </p>
                   
                </div>

                <div id="contentDiv">
                    <h1>Accessibility and Limits of the system</h1>
                    <p style="margin-bottom:30px">The DRS attendence Student grants full access to the general information assigned to them and allows users to 
                        fulfill their tasks with limit access. In the next line, we will cite some features
                         crucial for a good fonctioonality of the system:
                    </p>
                    <div id="line"> </div>
                    <div id="grantedAcess">
                         <div style="width:15px; height:15px; border-radius:15px; background-color:aqua; float:left "></div> <p style=" width:90%; margin: -5px; margin-left:10px; float:left">All users facilitators, students, and Sponsor have access to students data</p>
                    </div>

                    <div id="grantedAcess">
                         <div style="width:15px; height:15px; border-radius:15px; background-color:aqua; float:left "></div> <p style=" width:90%; margin: -5px; margin-left:10px; float:left">Facilitators is the only one able to make new and edit an existing attendence</p>
                    </div>

                    <div id="grantedAcess">
                         <div style="width:15px; height:15px; border-radius:15px; background-color:aqua; float:left "></div> <p style=" width:90%; margin: -5px; margin-left:10px; float:left">Users can notify his abssence before and after class</p>
                    </div>

                    <div id="grantedAcess">
                        <div style="width:15px; height:15px; border-radius:15px; background-color:aqua; float:left "></div> 
                        <p style=" width:90%; margin: -5px; margin-left:10px; float:left"> All users can do research during a period of time such as monthly, weekly or daily about
                        specific student presence</p>
                    </div>

                    <div id="grantedAcess">
                        <div style="width:15px; height:15px; border-radius:15px; background-color:aqua; float:left "></div> 
                        <p style=" width:90%; margin: -5px; margin-left:10px; float:left">Provide helps to students</p>
                    </div>

                    <div id="grantedAcess">
                        <div style="width:15px; height:15px; border-radius:15px; background-color:aqua; float:left "></div> 
                        <p style=" width:90%; margin: -5px; margin-left:10px; float:left">Automatic update of data is accessible to all concerned users</p>
                    </div>
                   
                </div>
            </div>
            <!-- Couvercle -->
            <div id="couvercle">
                 <div>
                    <h1>Community</h1> 
                    <p>
                    In other elements. To allow a drop, we must prevent the default handling 
                        of the element. leadership and ability to The ondragover event specifies where the dragged 
                        data can be dropped. By default, data/elements cannot be dropped in other elements. 
                        To allow a drop, we must prevent the default handling of the element</p>
                    <img style="width:200px; height:200px; border-radius:200px; margin-top:30px; " src="image/proALU.jpg">
                </div>

                <div>
                    <h1>Data Record Attendence</h1> 
                    <p>
                    In other elements. To allow a drop, we must prevent the default handling 
                        of the element. leadership and ability to The ondragover event specifies where the dragged 
                        data can be dropped. By default, data/elements cannot be dropped in other elements. 
                        To allow a drop, we must prevent the default handling of the element</p>
                    <img style="width:200px; height:200px; border-radius:200px; margin-top:30px; " src="image/communi.jpg">
                </div>
            </div>

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