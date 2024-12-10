<?php

session_start();

if(!isset($_SESSION)){
  header("Location:index.html");
  exit();
}
$userID=$_SESSION['user_id'];
$firstNameofUser= $_SESSION['first_name'];


//db
$servername="localhost";
$username="bageguqo_root";
$password= "D@neUp!4567";
$database= "bageguqo_SEProject2";
$conn=new mysqli($servername, $username, $password, $database);


//check connection 
if($conn->connect_error){
   die("Connection failed" . $conn->connect_error);
   }
 else{

#EVENT

if(isset($_POST['unenrollUserEvent']))
{

  $submittedEventID=$_POST['submittedEventID'];

  $DeleteEvent="DELETE FROM ConfirmEvent WHERE EventID='$submittedEventID' AND UserID='$userID'";

if($conn->query($DeleteEvent)==TRUE){
  header("Location:Climberdashboard.php");
    exit();
  
}
else{
    echo"Not able to delete event";
}

#CLASS
}
else if(isset($_POST['unenrollUserClass'])){


  $submittedClassID=$_POST['submittedClassID'];

  $DeleteClass="DELETE FROM ConfirmClass WHERE ClassID='$submittedClassID' AND UserID='$userID'";
  if($conn->query($DeleteClass)==TRUE){
    header("Location:Climberdashboard.php");
    exit();

  }
  else{
    echo"Not able to delete class";
}
}
    $conn->close();
}
?>