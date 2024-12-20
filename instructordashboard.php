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
	<title> Dashboard	</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-light">
  	<div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="instructorIndex.html">Home</a>
        <a class="nav-link active" href="instructordashboard.php">Dashboard</a>
        <a class="nav-link" href="instructorSchedule.php">Schedule</a>
        <a class="nav-link" href="logout.php">Logout</a>
 
      </div>
    </div>
  </div>
</nav>	
<h1 class="headers"> Welcome to your dashboard, <?php echo $firstNameofUser; ?>!</h1>
<div id="1" class="scroll">
<h2 class="tableHeaders"> Upcoming Classes You Are Teaching </h2>
<table class="tablesFormatClasses">
  <br>
    <thead>
    <tr class="bg-dark text-white">
      <th>ClassID</th>
      <th> Date</th>
      <th> Start Time</th>
      <th> End Time</th>
      <th>Event Name</th>
      <th>Notes</th>
    </tr>
    </thead>
    <tbody>

<?php


//find classes user register for 

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

$findUserClass="SELECT * FROM Classes WHERE UserID = '$userID'";
 $result=$conn->query($findUserClass);
 if($result->num_rows>0){
   while($row = $result->fetch_assoc()) {

   echo "<tr>
   <td>" . $row['ClassID'] . "</td>
      <td>".$row['Date']. "</td>
   <td>". $row['StartTime'] . "</td>
   <td>".$row['EndTime'] . "</td>
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
  <h2 class="tableHeaders"> Upcoming Events You Are Hosting </h2>
  <table class="tablesFormatEvents">
  <br>
    <thead>
    <tr class="bg-dark text-white">
      <th>EventID</th>
      <th> Date</th>
      <th> Start Time</th>
      <th> End Time</th>
      <th>Event Name</th>
      <th>Notes</th>
    </tr>
    </thead>
    <tbody>

 <?php
 #EVENT
 $findUserEvent="SELECT * FROM Events WHERE UserID = '$userID'";
 $output=$conn ->query($findUserEvent);

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
 $conn->close();

?>

	<table class="tablesFormatForms">
	<tr>
	<td>
	<div id="difficultyContainer" class="dashboardContainers">
		<h3> Select difficulty for a class </h3>
		<form action="InstructorDiffculty.php" method ="POST">
			<label for="ClassID">Class ID: </label><br>
			<input type="text" id="ClassID" name="ClassID"><br><br>

			<label for="Difficulty">Level of Difficulty:</label><br>
                <select name="Difficulty" id="Difficulty">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Experienced">Experienced</option>
                </select><br><br>
			<br> <input type="Submit" value="Update Difficulty" name="difficulty">
		</form>
	</div>
</td>
	<td>
    <div id="socialEventContainer" class="dashboardContainers">
		<h3> Create A Social Event </h3>
		<form action="InstructorEvent.php" method ="POST">

			<label for="EventName">Event Title:</label><br>
			<input type="text" id="EventName" name="EventName"><br><br>

			<label for="Date">Event Date:</label><br>
			<input type="date" id="Date" name="Date"><br><br>

			<label for="StartTime">Start Time:</label><br>
            <select name="StartTime" id="StartTime">
                <option value="12:00:00">12 PM</option>
                <option value="1:00:00">1 PM</option>
                <option value="2:00:00">2 PM</option>
                <option value="3:00:00">3 PM</option>
            </select><br><br>

			<label for="EndTime">End Time:</label><br>
            <select name="EndTime" id="EndTime">
                <option value="4:00:00">4 PM</option>
				<option value="5:00:00">5 PM</option>
                <option value="6:00:00">6 PM</option>
                <option value="7:00:00">7 PM</option>
            </select><br><br>

			<label for="Notes">Event Description:</label><br>
			<textarea name ="Notes" id="Notes"></textarea><br><br>

			<button input type="submit" name="event"> Create Event</button>
		</form>
	</div>
</td>
</tr>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js"> </script>
</body>
</html>