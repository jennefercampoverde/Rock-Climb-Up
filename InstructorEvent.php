<?php
//creating session

session_start();

if(!isset($_SESSION)){
  header("Location:index.html");
  exit();
}
$userID=$_SESSION['user_id'];
$firstNameofUser= $_SESSION['first_name'];


//database info.
$servername="localhost";
$username="bageguqo_root";
$password= "D@neUp!4567";
$database= "bageguqo_SEProject2";


//creating connection to the database
$conn= new mysqli($servername,$username, $password, $database);

if(isset($_POST['event']))
{
 $EventName=$_POST['EventName'];
 $Date=$_POST['Date'];
 $StartTime=$_POST['StartTime'];
 $EndTime=$_POST['EndTime'];
 $Notes=$_POST['Notes'];

 //query to add event to db
 $createEventQuery="INSERT INTO Events (EventName,Date,StartTime,EndTime,Notes,UserID) VALUES ('$EventName','$Date','$StartTime','$EndTime','$Notes','$userID')";



    if($conn->query($createEventQuery) === TRUE)
    {
        $selectEventID="SELECT * FROM Events WHERE EventName = '$EventName' AND Date = '$Date'";
        $result=$conn->query($selectEventID);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $eventID = $row["EventID"];
            if($result->num_rows>0){
                $confirmEventQuery="INSERT INTO ConfirmEvent (EventID, UserID) VALUES ('$eventID', '$userID')";
                if ($conn->query($confirmEventQuery) == TRUE) {
                    header("Location:instructordashboard.php");
                }
                else {
                    echo "Your request was not fulfilled. The event was not created".mysqli_error($conn);
                }
            } 
    else {
        echo "Your request was not fulfilled. The event was not created".mysqli_error($conn);
    }
        
    }
    else
    {
    echo "Your request was not fulfilled. The event was not created".mysqli_error($conn);
    
    }

    

    $conn->close();
 }
    }


    



?>