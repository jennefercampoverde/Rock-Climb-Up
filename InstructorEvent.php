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
$username="root";
$password= "";
$database= "SEProject2";


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
    echo "Your event has been added!";
    
    }
    else
    {
    echo "Your request was not fulfilled. The event was not created".mysqli_error($conn);
    
    }

 

    $conn->close();
 }


    



?>