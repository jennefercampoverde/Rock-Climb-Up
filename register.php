<?php
#echo$_SESSION['user_id'].'';
#error_reporting(E_ALL);
#ini_set('display_errors', 1);

$servername="localhost";
$username="root";
$password= "";
$database= "SEProject2";

$error=false;
//creating connection for php and mysql

$conn= new mysqli($servername,$username, $password, $database);
 //check connection 
 if($conn->connect_error)
 {
    die("Connection failed" . $conn->connect_error);
 }
 else{

if($_SERVER['REQUEST_METHOD']=="POST")
{
   #checking for name validation
   if (empty($_POST["firstName"])) {
      $nameError="**Name is required";
   }
   else{
      $firstName=$_POST['firstName'];
      $firstName=trim($firstName);
      $firstName=stripslashes($firstName);
      $firstName=htmlspecialchars($firstName);
      if(!preg_match("/^[a-zA-Z]*$/",$firstName)){
         $nameError="**Only alphabet characters are allowed.";

      }

   }
   if(empty($_POST['lastName']))
   {
      $lastNameError= '**Last Name is required';
   }
   else{
      $lastName=$_POST['lastName'];
      $lastName=trim($lastName);
      $lastName=stripslashes($lastName);
      $lastName=htmlspecialchars($lastName);
      if(!preg_match("/^[a-zA-Z]*$/",$lastName)){
         $lastName=$_POST['lastName'];
         $lastNameError= '**Last Name is required';
   
   }}
   #checking for dob validation
   if(empty($dob=$_POST['dob'])){
      $dobError='**Date of Birth is required';
   }
   #checking for email validation 
   if(empty( $email=$_POST['email'])){
      $emailError='**Email is required';
   }
   else{
      //take in email variable
      if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
         $emailError= '**Please enter a valid email';
         #$email=$_POST['email']}
   }
      #checking for password validation
   if(empty($password=$_POST['password'])){
      $passwordError= '**Password is required';

   }
   else{
      if(strlen($password)<8)
   {
    $passwordError= 'Password is not minimum 8 characters';
 }
   }

    $passwordEncryption=sha1($password);

    $createUserQuery="INSERT INTO Users (Password,FirstName,LastName,DOB,Email,PhoneNumber,Role) VALUES ('$passwordEncryption','$firstName','$lastName','$dob','$email','$phoneNum','climber')";

    if($conn->query($createUserQuery) === TRUE)
    {

    header("Location:index.html");
    exit();

    }
    else
    {
    echo "did not work".mysqli_error($conn);
    print( "did not work".mysqli_error($conn));
    }
 
 }}
 

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <title> </title>
		  <link rel="stylesheet" type="text/css" href="style.css">
		  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		</head>
<body >
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		  <div class="navbar-nav">
			<a class="nav-link " aria-current="page" href="index2.html">Home</a>
			<a class="nav-link active" href="Climberdashboard.html">Dashboard</a>
			<a class="nav-link" href="schedule.html">Schedule</a>
	 
		  </div>
		</div>
	  </div>
	</nav>  

	<div id="enrollContainer" class="dashboardContainers">
		<h1>
			Create an Account
		</h1>
      <span class="errorText" > * Required Field</span>
		<form action="register.php" method="POST">
			<label for="firstName">Enter your first name:</label><br>
         <span class="errorText"> <?php echo $nameError;?> </span><br>
			<input type="text" id="firstName" name="firstName">
			

			
			<label for="lastName">Enter your last name:</label><br>
         <span class="errorText"> <?php echo $lastNameError;?> </span><br>
			<input type="text" id="lastName" name="lastName"><br>
         
			
			<label for="dob"> Enter your DOB </label><br>
         <span class="errorText"> <?php echo $dobError?> </span><br>
			<input type="date" id="dob" name="dob"><br>
         
			
			<label for="email"> Enter your email </label><br>
         <span class="errorText"> <?php if(isset($emailError))echo $emailError;?> </span><br>
			
			<input type="email" id="email" name="email"><br>
         
			<label for="phoneNum"> Enter your phone number </label><br>
			<input type="tel" id="phoneNum" name="phoneNum"><br>
			
			<label for="password">Enter a password:</label><br>
         <span class="errorText"><?php if(isset($passwordError))echo $passwordError; ?> </span><br>
			<input type="password" id="password" name="password"><br>
         

			<input type="submit" value="Submit" name="submitregistration">
			<p> Already have an account? <a href="login.html"> Login now</a></p>

		</form>
	</div>
</body>
</html>