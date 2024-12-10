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
  if (isset($_POST['enrollClass'])) { // Class Enrollment Form Submission
    $submittedClassID=$_POST['providedClassID'];

    $EnrollClass="INSERT INTO ConfirmClass (UserID, ClassID) VALUES ('$userID', '$submittedClassID')";
    if($conn->query($EnrollClass)==TRUE){
      header("Location:Climberdashboard.php");
      exit();

    }
    else{
      echo"Not able to enroll in class";
    }
  }

    else if (isset($_POST['enrollEvent'])) { // Event Enrollment Form Submission
      $submittedEventID=$_POST['providedEventID'];

      $EnrollEvent="INSERT INTO ConfirmEvent (UserID, EventID) VALUES ('$userID', '$submittedEventID')";
      if($conn->query($EnrollEvent)==TRUE){
        header("Location:Climberdashboard.php");
        exit();

      }
      else{
        echo"Not able to enroll in event";
      }
    }
$conn->close();
}
    ?>