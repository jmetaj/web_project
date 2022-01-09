<?php
require_once('config.php');
?>

<?php

if(isset($_POST)){

     $username = $_POST['username'];
     $email = $_POST['email'];
     $pass = $_POST['pass'];

     $sql = " INSERT INTO users (username, email, pass) values('$username','$email','$pass')";
     
     $stmtinsert = $conn->prepare($sql);
     $result = $stmtinsert->execute([$username, $email, $pass]);

     if($result){
         echo "successfully saved";
     } else {
         echo "error!";
     }
    }
?>