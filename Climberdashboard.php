<?php

$servername="localhost";
$username="root";
$password= "";

//creating connection for php and mysql
$conn= new mysqli("localhost",$username, $password);

//check connection 
 if($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
 
 }
 echo "Connected successfully";

?>