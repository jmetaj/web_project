<?php
 
 $db_host = "localhost";
 $db_name= "mydb";
 $db_user = "root";
 $db_pass = "";


 //connection to database
 try{
     $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass );
     $conn-> SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "connection successfully";

 } catch(PDOException $e){
     echo "connection failed" . $e;
     $e->getMessage();
 }

 

?>
