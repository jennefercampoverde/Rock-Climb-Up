<?php
$servername="localhost";
$username="root";
$password= "";
$database= "SEProject2";
$conn=new mysqli($servername, $username, $password, $database);


//check connection 
if($conn->connect_error){
   die("Connection failed" . $conn->connect_error);
   }
 else{

if(isset($_POST['unenrollUserEvent']))
{

  $ProvidedUserIDEvent=$_POST['ProvidedUserIDClass"'];
  $submittedEventID=$_POST['submittedEventID'];

$AddEvent="DELETE FROM ConfirmEvent WHERE EventID='$submittedEventID' AND UserID='$ProvidedUserIDEvent'";

if($conn->query($AddEvent)==TRUE){
  header("Location:Climberdashboard.php");
    exit();
  
}
}
else if(isset($_POST['unenrollUserClass'])){
  $submittedClassID=$_POST['submittedClassID'];
  $ProvidedUserIDClass= $_POST['ProvidedUserIDClass'];
  $AddClass="DELETE FROM ConfirmClass WHERE EventID='$submittedClassID' AND UserID='$ProvidedUserIDClass'";
  if($conn->query($AddClass)==TRUE){
    header("Location:Climberdashboard.php");
    exit();

  }
}
$conn->close();
}
?>