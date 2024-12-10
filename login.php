<?php
//creating session

session_start();


//database info.
$servername="localhost";
$username="bageguqo_root";
$password= "D@neUp!4567";
$database= "bageguqo_SEProject2";


//creating connection to the database
$conn= new mysqli($servername,$username, $password, $database);
 
//check connection 
 if($conn->connect_error){
   die("Connection failed" . $conn->connect_error);
   }
 else{
  

 
if(isset($_POST['loginButton']) && !empty($_POST['loginButton']))
{
  //email validation
  $emailAddress=$_POST['emailAddress'];
    if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
      $emailError= '**Please enter a valid email';
      
      }
      if(empty($_POST['password'])){
        $passwordError= '**Please enter a password';
      }
      else{
        $password=$_POST['password'];
      }

 
   $encryptedPassword=sha1($password);


 //query to add user to db //AND Password ='$encryptedPassword'
 $verifyUser= "SELECT * FROM Users WHERE Email='$emailAddress' AND Password ='$encryptedPassword' ";

 //iterating into each result from select query 
 $result=$conn->query($verifyUser);
  

 //checking user role
    if($result->num_rows>0){
   
   $row=$result->fetch_assoc();
    $role= $row["Role"];
    $userID=$row["UserID"];
    $firstName=$row["FirstName"];

    if($role=="climber"){

      $_SESSION['user_id']= $userID;
      $_SESSION['first_name']= $firstName;
      header("Location:Climberdashboard.php");

      exit();
    }
    else if ($role== "manager"){
      $_SESSION['user_id']= $userID;
      $_SESSION['first_name']= $firstName;

      header("Location:Managerdashboard.php");
      exit();
    
    }
    else if($role=="instructor")
    {
      $_SESSION['user_id']= $userID;
      $_SESSION['first_name']= $firstName;
      header("Location:instructordashboard.php");
      exit();
    }
    
   }
   else{
    $notFound="Credentials cannot be verified";
  }
    $conn->close();
 }
 
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Login Page </title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body id="home">
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		  <div class="navbar-nav">
			<a class="nav-link " aria-current="page" href="index.html">Home</a>
			<a class="nav-link " href="register.php">Register</a>
	 
		  </div>
		</div>
	  </div>
	</nav>  
	<div id="enrollContainer" class="dashboardContainers">
		<h3> Please Login with Email and Password </h3>
		<form action="login.php" method="POST">
			<label for="EmailAddress"> Email Address</label><br>
      <span class="errorText"> <?php echo $notFound;?> </span><br>
      <span class="errorText"> <?php echo $emailError?> </span><br>
			<input type="text" id="EmailAddress" name="emailAddress" value=""><br>
			<label for="Password"> Password: </label><br>
      <span class="errorText"> <?php echo $passwordError?> </span><br>
			<input type ="password" id="Password" name="password" value=""><br>
			<br> <input type="Submit" name ="loginButton" value="Submit">
			<p> Don't have an account? <a href="register.php"> Register here</a></p>
		</form>
	</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js"> </script>
</body>
</html>
