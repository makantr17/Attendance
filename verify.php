
<?php 
     $db = mysqli_connect("localhost", "root", "kantemamady92", "mamady");
     $sql = "SELECT * FROM `Users` where `Users`.userId > 0 ";
     $result= mysqli_query($db, $sql); // Stores the submitted data into the database test
     $tes2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // $firstName = isset($_Post['firstName'])? $_Post['firstName'] = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['firstName'])) {
      echo "error";
    } else { 
        $username = $_POST['userName']; 
    }
}


?>