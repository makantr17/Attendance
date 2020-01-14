<?php
// Initialize the session
session_start();
 
// Define variables and initialize with empty values
$userName = $email = $password = $emailStudent =  "";
$user_Err = $email_err = $passErr = $emailS_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if($_POST["userName"] == "None" ){
        $user_Err = "Pleas enter correct Name";     
    } else{
        $userName = trim($_POST["userName"]);
       

    // Validate new password
    if($_POST["email"] == "None" ){
        $email_err = "Pleas enter correct email";     
    } else{
        $email = trim($_POST["email"]);
            

        if($_POST["emailStudent"] == "None" ){
            $emailS_err = "Pleas select your Level";     
        } else{
            $emailStudent = trim($_POST["emailStudent"]);

            if($_POST["password"] == "None" ){
                $passErr = "Pleas select your Course";     
            } else{
                $password = trim($_POST["password"]);  
              
                
                include 'connect.php';
    
                $sql = "SELECT * from `sponsorship` where `sponsorship`.`userName` = '$userName'
                and `sponsorship`.`emailSponsor` = '$email' and `sponsorship`.`emailStudent` = '$emailStudent' 
                and `sponsorship`.`password` = '$password' limit 1 ";
              
                $result= mysqli_query($connect, $sql); 
                $tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                $_SESSION['spon'] = "SELECT * from `sponsorship` where `sponsorship`.`userName` = '$userName'
                and `sponsorship`.`emailSponsor` = '$email' and `sponsorship`.`emailStudent` = '$emailStudent' 
                and `sponsorship`.`password` = '$password' limit 1 ";
                // echo $_SESSION['sc'];
                $counter = 0;
                foreach ($tes2 as $dataGot) {
                    $counter = $counter + 1;
                }

                if ($counter == 1) {
                   $_SESSION['sponName'] = $userName;
                   $_SESSION['studentEmail'] = $emailStudent;
                   $_SESSION['sponEmail'] = $email;
                   $_SESSION['sponPassword'] = $password;
                   header('location: sponsorPage.php');
                }
                else {
                    header('location: facilitatorLogin.php');
                }
              

               


            }
        }
    

       }
    
}
}

?>