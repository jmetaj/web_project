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

 /*$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "mydb";// database name

$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);

$mysql_con->query ('SET CHARACTER SET utf8');
$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');

         $username = $_POST["username"];

         $email = $_POST["email"];
         $pass = $_POST["pass"];

	
$my_query = "INSERT  into 
users (username, email, pass) 
VALUES ("$username", "$email", "$pass")";

//echo $my_query;
	
$result = $mysql_con->query($my_query);

if (!$result)
	die('Invalid query: ' . $mysql_con->error);
else
	echo "Updated records: ".$mysql_con->affected_rows;
	
echo "<p><b>The last id: ".$mysql_con->insert_id."</b></p>";

$mysql_con->close;*/


?>