<?php

//db info.
$servername="localhost";
$username="root";
$password="";
$database="SEPreoject2";

//creating connection for php and mysql
$conn= new mysqli("localhost",$username, $password, $database);

//check connection 
 if($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
 
 }
 else
 {


 if(!empty($_POST["loginButton"]))
 {
   $emailAddress=$_POST['emailAddress'];
   $password=$_POST['password'];
   $encryptedPassword=sha1($password);



   $verifyUser= "SELECT * from Users WHERE Email='$emailAddress' AND Password='$encryptedPassword'";

   if ($conn->QUERY($verifyUser)==TRUE){
      echo"Verified user";
   }
   else{
      echo "WRONG";
   }
   }
   

 else{
   echo"Please enter valid login information";
 }
}





?>