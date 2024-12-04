<?php

//database info.
$servername="localhost";
$username="root";
$password= "";
$database= "SEProject2";


//creating connection to the database
$conn= new mysqli($servername,$username, $password, $database);
 
//check connection 
 if($conn->connect_error)
 {
    die("Connection failed" . $conn->connect_error);
 }
 else{
    echo"connected";


if(isset($_POST['submitregistration']))
{
 $firstName=$_POST['firstName'];
 $lastName=$_POST['lastName'];
 $dob=$_POST['dob'];
 $email=$_POST['email'];
 $phoneNum=$_POST['phoneNum'];
 $password=$_POST['password'];

//encrypting password
 $passwordEncryption=sha1($password);
 

 //query to add user to db
 $createUserQuery="INSERT INTO Users (Password,FirstName,LastName,DOB,Email,PhoneNumber,Role) VALUES ('$passwordEncryption','$firstName','$lastName','$dob','$email','$phoneNum','climber')";


    if($conn->query($createUserQuery) === TRUE)
    {
    echo "inserted";
    
    }
    else
    {
    echo "did not work".mysqli_error($conn);
    
    }

 

    $conn->close();
 }


    

}


?>