<?php
//creating session

session_start();

if(!isset($_SESSION)){
header("Location:index.html");
exit();
}
$userID=$_SESSION['user_id'];
$firstNameofUser= $_SESSION['first_name'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Schedule </title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body id="" >
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="instructorIndex.html">Home</a>
        <a class="nav-link" href="instructordashboard.php">Dashboard</a>
        <a class="nav-link active" href="instructorSchedule.php">Schedule</a>
        <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
 
      </div>
    </div>
  </div>
</nav>  
    <br>
    <br>
    <br>
    <h1 id = "ClimberHeader">
        Schedule
    </h1>
    <br>
    <h4 id = "ClimberHeader">
        Below are the Class and Social Events that are currently being offered to new and returning members:
    </h4>
    <br>
    <br>

    <h2 class="tableHeaders"> Classes </h2>
    <br>
    <table class="tablesFormatClasses">
        <tr class="bg-dark text-white">
            <th> Class ID </th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Class Name</th>
            <th>Instructor</th>
            <th>Difficulty</th>
        </tr>
        <?php


        // Database information
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
      #CLASS

      $findAllClasses = "SELECT c.ClassID, c.StartTime, c.EndTime, c.Date, c.ClassName, c.Difficulty, u.FirstName
                       FROM Classes c
                       INNER JOIN Users u ON c.UserID = u.UserID";  // Assuming 'UserID' is in both tables
      $result=$conn->query($findAllClasses);
      if($result->num_rows>0){
      while($row = $result->fetch_assoc()) {

      echo "<tr>
       <td>". $row['ClassID'] . "</td>
        <td>".$row['Date']. "</td> 
       <td>". $row['StartTime'] . "</td>
       <td>".$row['EndTime'] . "</td>
       <td>" . $row['ClassName'] . "</td>
       <td>". $row['FirstName']."</td>
       <td>". $row['Difficulty']."</td>
     </tr>";

   }

 }

}
        ?>
    </table>
    <br>
    <br>
</body>
<body>
    <h2 class="tableHeaders"> Social Events </h2>
    <br>
    <table class="tablesFormatEvents">
        <tr class="bg-dark text-white">
          <th> Event ID </th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Host</th>
            <th>Event Name</th>
            <th>Notes</th>
        </tr>
        <?php
        // Database information
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

      $findAllEvents = "SELECT e.EventID, e.StartTime, e.EndTime, e.Date, e.EventName, e.Notes, u.FirstName
                       FROM Events e
                       INNER JOIN Users u ON e.UserID = u.UserID";  // Assuming 'UserID' is in both tables
      $result=$conn->query($findAllEvents);
      if($result->num_rows>0){
      while($row = $result->fetch_assoc()) {

      echo "<tr>
       <td>". $row['EventID'] . "</td> 
      <td>".$row['Date']. "</td>
       <td>". $row['StartTime'] . "</td>
       <td>".$row['EndTime'] . "</td>
       <td>" . $row['FirstName'] . "</td>
       <td>". $row['EventName']."</td>
       <td>". $row['Notes']."</td>
     </tr>";

   }

 }

}
        ?>
    </table>
</body>
</html>