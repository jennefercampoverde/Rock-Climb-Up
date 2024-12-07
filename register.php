<?php
echo$_SESSION['user_id'].'';
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    echo"connected";

if(isset($_POST['submitregistration']) )
{
 $firstName=$_POST['firstName'];
 $lastName=$_POST['lastName'];
 $dob=$_POST['dob'];
 $email=$_POST['email'];
 $phoneNum=$_POST['phoneNum'];
 $password=$_POST['password'];

 //ensuring no empty inputs except phone
 if (empty($firstName) || empty($lastName) || empty($dob) || empty($email) || empty($password)){
    $input_error="Missing entry";
    $error=True;
 }

 //ensuring valid email address input 
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $invalidEmail= "Please enter a valid email";
    $error=True;
 }
 //ensuring password length 
 if(strlen($password)<8)
 {
    $passwordStrength="Please enter a password that is a minimum of 8 characters";
    $error=True;
 }



    $passwordEncryption=sha1($password);

    $createUserQuery="INSERT INTO Users (Password,FirstName,LastName,DOB,Email,PhoneNumber,Role) VALUES ('$passwordEncryption','$firstName','$lastName','$dob','$email','$phoneNum','climber')";
    $result=$conn->query($createUserQuery);

    if($conn->query($createUserQuery) === TRUE)
    {
        
    //if inserted
    header("Location:index.html");
    exit();

    }
    else
    {
    echo "did not work".mysqli_error($conn);
    print( "did not work".mysqli_error($conn));
    }


    
 }
 


    

}


?>