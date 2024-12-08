<?php

//database info.
$servername="localhost";
$username="root";
$password= "";
$database= "SEProject2";


$error=FALSE;
echo$_SESSION['user_id'].'';

//creating connection to the database
$conn= new mysqli($servername,$username, $password, $database);
 
//check connection 
 if($conn->connect_error){
   die("Connection failed" . $conn->connect_error);
   }
 else{
   echo"connected";

 
if(isset($_POST['loginButton']) && !empty($_POST['loginButton']))
{
   $emailAddress=$_POST['emailAddress'];
   $password=$_POST['password'];
   //sha1($password);
   $encryptedPassword=sha1($password);
   //echo gettype($emailAddress).'';
   //echo gettype($encryptedPassword).'';
   //echo gettype($password).'';


   if (empty($emailAddress) || empty($password)){ //***not working**
    $input_error="Missing entry";
    $error=TRUE;
   }

  //ensuring valid email address input ***not working** 
  if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
  $invalidEmail= "Please enter a valid email";
  $error=True;
  }

 //query to add user to db //AND Password ='$encryptedPassword'
 $verifyUser= "SELECT * FROM Users WHERE Email='$emailAddress' AND Password ='$encryptedPassword' ";

 //iterating into each result from select query 
 $result=$conn->query($verifyUser);
  

 //checking user role
    if($result->num_rows>0){
   
   $row=$result->fetch_assoc();
    $role= $row["Role"];
    $userID=$row["UserID"];

    if($role=="climber"){

      $_SESSION['user_id']= $userID->id;

      header("Location:Climberdashboard.php");
      exit();
    }
    else if ($role=="receptionist"){
      $_SESSION['user_id']= $userID->id;

      header("Location:Recdashboard.php");
      exit();

    }
    else if ($role== "manager"){
      $_SESSION['user_id']= $userID->id;

      header("Location:managerdashboard.php");
      exit();
    //echo "verfied";
    //echo $encryptedPassword;
    //echo "$email";
    
    }
    else if($role=="instructor")
    {
      $_SESSION['user_id']= $userID->id;
      header("Location:instructordashboard.php");
      exit();
    }
   }
    else
    {
    echo "did not wor la cred".mysqli_error($conn) ."<br>";
    
    //echo $encryptedPassword ."<br>";
    //echo "$emailAddress" ."<br>";
   //echo gettype($emailAddress)."<br>";
   //echo gettype($encryptedPassword)."<br>";
   //echo gettype($password)."<br>";
   //echo "password:" .$password ."<br>";
   //echo "Entered Password: " . $password; 
   //echo "Entered Password: " . $encryptedPassword; 

   echo "Error: " . $conn->error;
    
    }
   
 

    $conn->close();
 }


    

}


?>