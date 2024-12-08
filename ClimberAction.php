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

#EVENT

if(isset($_POST['unenrollUserEvent']))
{

  $ProvidedUserIDEvent=$_POST['ProvidedUserIDEvent'];
  $submittedEventID=$_POST['submittedEventID'];

  $DeleteEvent="DELETE FROM ConfirmEvent WHERE EventID='$submittedEventID' AND UserID='$ProvidedUserIDEvent'";

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


  $ProvidedUserIDClass= $_POST['ProvidedUserIDClass'];
  $submittedClassID=$_POST['submittedClassID'];

  $DeleteClass="DELETE FROM ConfirmClass WHERE ClassID='$submittedClassID' AND UserID='$ProvidedUserIDClass'";
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