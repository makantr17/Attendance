<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcom.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstName = $email = "";
$firstName_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["firstName"]))){
        $firstName_err = "Please enter username.";
    } else{
        $firstName = trim($_POST["firstName"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }
   
    
    // Validate credentials
    if(empty($firstName_err) && empty($email_err)){
        // Prepare a select statement
        $sql = "SELECT `userId`, `firstName`, `email` FROM `Users` WHERE `email` = '$email' 
        and firstName =  '$firstName' ";
        // $result = mysql_query($sql);
        // $fetch = mysql_fetch_assoc($result);

        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            
            mysqli_stmt_bind_param($stmt, "s", $parfirstName);
            
            // Set parameters
            $parfirstName = $firstName;
            // $paremail = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $userId, $firstName, $shared_email);
                    if(mysqli_stmt_fetch($stmt)){
                        if($email == $shared_email){
                            // Password is correct, so start a new session
                          
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["userId"] = $userId;
                            $_SESSION["firstName"] = $firstName;   
                            $_SESSION["email"] = $email;                         
                            
                            // Redirect user to welcome page
                            header("location: project.php");
                        } else{
                            // Display an error message if password is not valid
                            $email_err = "The email you entered was not valid.";
                        }
                    }
                } else{
                  
                    // Display an error message if username doesn't exist
                    $firstName_err = "No account found with that firstName.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="dash.css">
          
    <style type="text/css">
        body{ 
            font: 14px sans-serif;
            background-image: url("image/imag.jpg");
          
         }
        .wrapper{ width: 400px; background-color:black; opacity:0.9; padding: 20px; padding-top:10px; padding-left:70px}
        
        .wrapper #logo{
            width:100px;
            height:100px;
            margin-left:-60px;
            border-radius:100px;
            
        }
        .wrapper #dashboard{
            font-size:40px;
            float:right;
            color:orange;
            
        }
        #backStyleImage{
            width:50%; 
            height:637px;
             background-image: url("image/ALU.jpg"); 
             float:right; background-color: white;
             background-position: center;
            background-repeat: no-repeat;
             background-size: cover;
             opacity:0.8;
            }
        #backStyleImage #logImage{
            width:300px;
            height:250px;
            margin-top:120px;
            margin-left:20px;
            z-index:5px;
            float:left;
            opacity:0.9;
        }
        #backStyleImage #logImage1{
            width:300px;
            height:250px;
            margin-left:100px;
            z-index:5px;
            margin-top:0px;
        }
        #backStyleImage #logImage2{
            width:300px;
            height:250px;
            margin-left:0px;
            z-index:5px;
            margin-top:0px;
            position:fixed;
        }
    </style>
</head>
<body>
    <div id="backStyleImage">
        <img id="logImage" src="image/dash.jpg">
        <img id="logImage2" src="image/dash1.png">
        <img id="logImage1" src="image/dash1.png">
       
    </div>
    <div class="wrapper">
        <img id="logo" src="image/logoAlu.png">
        <h2 id="dashboard">DASHBOARD</h2>
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                <label>FirstName</label>
                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
                <span class="help-block"><?php echo $firstName_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="registration.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>