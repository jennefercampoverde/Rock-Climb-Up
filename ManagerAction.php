<?php

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

  if (isset($_POST['removeEvent'])) {

    $submittedEventID = $_POST['providedEventID'];

    // Delete from ConfirmEvent table
    $DeleteConfirmEvent = "DELETE FROM ConfirmEvent WHERE EventID='$submittedEventID'";

    if ($conn->query($DeleteConfirmEvent) == TRUE) {

        // Now delete from Events table
      $DeleteEvent = "DELETE FROM Events WHERE EventID='$submittedEventID'";

      if ($conn->query($DeleteEvent) == TRUE) {
        header("Location: Managerdashboard.php");
        exit();
      } else {
        echo "Error deleting event from Events table: " . $conn->error;
      }
    } else {
      echo "Not able to delete event from ConfirmEvent table.";
    }
  }
#CLASS

  else if(isset($_POST['removeClass'])){

    $submittedClassID=$_POST['providedClassID'];

    $DeleteConfirmClass = "DELETE FROM ConfirmClass WHERE ClassID='$submittedClassID'";

    if ($conn->query($DeleteConfirmClass) == TRUE) {

      $DeleteClass="DELETE FROM Classes WHERE ClassID='$submittedClassID'";

      if ($conn->query($DeleteClass) == TRUE) {
        header("Location: Managerdashboard.php");
        exit();
      } else {
        echo "Error deleting class from Class table: " . $conn->error;
      }
    } else {
      echo "Not able to delete class from ConfirmClass table.";
    }
  }
#User
  else if(isset($_POST['removeUser'])){

    $submittedUserID=$_POST['providedUserID'];

    $DeleteConfirmUserFromEvents = "DELETE FROM ConfirmEvent WHERE UserID='$submittedUserID'";
    $DeleteConfirmUserFromClasses = "DELETE FROM ConfirmClass WHERE UserID='$submittedUserID'";

    if ($conn->query($DeleteConfirmUserFromEvents) == TRUE AND $conn->query($DeleteConfirmUserFromClasses) == TRUE) {

      $DeleteUser="DELETE FROM Users WHERE UserID='$submittedUserID'";

      if ($conn->query($DeleteUser) == TRUE) {
        header("Location: Managerdashboard.php");
        exit();
      } else {
        echo "Error deleting user from User table: " . $conn->error;
      }
    } else {
      echo "Not able to delete user from ConfirmClass or ConfirmEvent table.";
    }
  }
  #AssignInstructor
  else if(isset($_POST['assignInstructor'])){

    $submittedUserID=$_POST['providedUserID'];
    $submittedClassID=$_POST['providedClassID'];

  $AssignInstructor="UPDATE Classes SET UserID='$submittedUserID' WHERE ClassID = '$submittedClassID'";

if($conn->query($AssignInstructor)==TRUE){
  header("Location:Managerdashboard.php");
    exit();
  
}
else{
    echo"Not able to assign instructor";
}
  }
  #Update Role
  else if(isset($_POST['updateRole'])){

    $submittedUserID=$_POST['providedUserID'];
    $submittedRole=$_POST['providedRole'];

    $UpdateRole="UPDATE Users SET Role='$submittedRole' WHERE UserID = '$submittedUserID'";

if($conn->query($UpdateRole)==TRUE){
  header("Location:Managerdashboard.php");
    exit();
  
}
else{
    echo"Not able to update role";
}
  }
  $conn->close();
}
?>