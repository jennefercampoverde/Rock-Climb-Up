<?php

$servername="localhost";
$username="root";
$password= "siMbawatermelon";

//creating connection for php and mysql
$conn= new mysqli("localhost",$username, $password);

//check connection 
 if($conn->connect_error){
    die( "Connection failed" . $conn->connect_error);
 
 }
 echo "Connected successfully";

 $login= $_POST['login'];
 echo' ';





?>