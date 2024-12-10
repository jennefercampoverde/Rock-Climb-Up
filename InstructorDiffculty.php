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

if(isset($_POST['difficulty']))
{
 $ClassID=$_POST['ClassID'];
 $Difficulty=$_POST['Difficulty'];

 //query to check if class is in database
 $checkIfClassIDExistQuery="SELECT * FROM Classes WHERE ClassID='$ClassID'";
 $result=$conn->query($checkIfClassIDExistQuery);


    if(($result->num_rows>0))
    {

    $addDifficultyQuery="UPDATE Classes SET Difficulty = '$Difficulty' WHERE ClassID = '$ClassID'";
    $conn->query($addDifficultyQuery);
    header("Location:instructordashboard.php");
    
    }
    else
    {
    echo "The Class doesn't exist. Please enter a valid class ID.".mysqli_error($conn);
    
    }

 

    $conn->close();
 }


    



?>