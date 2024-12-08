 <!--show schedule-->
 <DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> </title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body id="home" >
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
<div id="allText">
<h1 class="headers">Welcome to Your Dashboard, Climber!</h1>
<div id="1" class="scroll">
<h2 class="tableHeaders"> Your Enrolled Classes </h2>
<table class="tablesFormatClasses">
  <br>
    <thead>
    <tr class="bg-dark text-white">
      <th>EventID</th>
      <th> Start Time</th>
      <th> End Time</th>
      <th> Date</th>
      <th>Event Name</th>
      <th>Notes</th>
    </tr>
    </thead>
    <tbody>

<?php
//find events user register for 


$servername="localhost";
$username="root";
$password= "";
$database= "SEProject2";
$conn=new mysqli($servername, $username, $password, $database);


//check connection 
if($conn->connect_error){
   die("Connection failed" . $conn->connect_error);
   }
 else{
 
$userID=1;

$findUserEvents="SELECT * FROM Classes WHERE UserID='$userID'";
 $result=$conn->query($findUserEvents);

 if($result->num_rows>0){
   while($row = $result->fetch_assoc()) {
   echo "<tr>
   <td>" . $row['ClassID'] . "</td>
   <td>". $row['StartTime'] . "</td>
   <td>".$row['EndTime'] . "</td>
   <td>".$row['Date']. "</td>
   <td>". $row['ClassName']."</td>
   <td>". $row['Difficulty']."</td>
   </tr>";

}
 }
}
 ?>
 </tbody>
</table>
</div>

<div >
  <h2 class="tableHeaders"> Your Enrolled Events </h2>
  <table class="tablesFormatEvents">
  <br>
    <thead>
    <tr class="bg-dark text-white">
      <th>EventID</th>
      <th> Start Time</th>
      <th> End Time</th>
      <th> Date</th>
      <th>Event Name</th>
      <th>Notes</th>
    </tr>
    </thead>
    <tbody>

 <?php
 
 $findUserClasses="SELECT * FROM Events WHERE UserID='$userID'";
 $output=$conn ->query($findUserClasses);

 if($output->num_rows>0)
 {
  while($instance=$output->fetch_assoc()){
    echo "<tr>
    <td>".$instance['EventID'] . "</td>
    <td>".$instance['Date']. "</td>
   <td>".$instance['StartTime'] . "</td>
   <td>".$instance['EndTime'] . "</td>
   <td>".$instance['EventName']."</td>
   <td>".$instance['Notes']."</td>
   </tr>";
    }
 }


 //if they press enroll
 //if they press unenroll button 
 //if they press logout button do session_destroy(); and redirect to the index.php

?>

</tbody>
<caption id="scrollDownTextUnenroll"> ** Scroll down for Unenroll options **</caption>
</table>

</div>


<!----- Forms-->
<div id="2" class="scroll-animation">

<table class="tablesFormatForms">
    <tr>
      <td>
  <div id="unEnrollClassContainer" class="dashboardContainers">
    <h3> Unenroll from a Class </h3>
    <form id="classForm" action="POST">
    <label for="userID">Re-enter your User ID: </label><br>
      <input type="text" id="ProvidedUserIDClass"><br><br>
      <label for="classID">Class ID: </label><br>
      <input type="text" id="classID"><br><br>
      <br> <input type="Submit" name="unenrollUserClass" value="Un-enroll">
    </form>
  </div>
</td>
<td>
    <div id="enrollContainer" class="dashboardContainers">
    <h3> Un-Enroll from a Event </h3>
    <form id="eventForm" action="POST">
    <label for="userID">Re-enter your User ID: </label><br>
      <input type="text" id="ProvidedUserIDEvents"><br><br>
       <label for="eventID">Event ID: </label><br>
      <input type="text" id="eventID"><br><br>
      <br> <input type="Submit" name="unenrollUserEvent" value="Un-enroll">
    </form>
  </div>
</td>
</tr>
</table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="script.js"> </script>
</body>
</html>
</DOCTYPE>
<?php


if(isset($_POST['unenrollUserEvent'])){

  $ProvidedUserIDEvent=$_POST['']
  $submittedEventID=$_POST

$AddEvent="DELETE FROM ConfirmEvent WHERE EventID='$submittedEventID' AND UserID='ProvidedUserIDEvent'";

}
else if(isset($_POST['unenrollUserClass'])){
  $submittedClassID=$_POST
  $ProvidedUserIDClass= $_POST['']
  $AddClass="DELETE FROM ConfirmClass WHERE EventID='$submittedClassID' AND UserID='ProvidedUserIDClass'";

}
$conn->close();
?>
