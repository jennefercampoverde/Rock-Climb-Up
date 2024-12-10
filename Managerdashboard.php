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

<DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Dashboard </title>
    
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
            <a class="nav-link" href="managerIndex.html">Home</a>
            <a class="nav-link active" href="Managerdashboard.php">Dashboard</a>
            <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>    
    <h1 id="ClimberHeader">Hello, <?php echo $firstNameofUser ?>!</h1>
    <div>
      <h2 class="tableHeaders"> Classes </h2>
      <table class="tablesFormatClasses">
        <tr class="bg-dark text-white">
          <th>ClassID</th>
          <th> Date</th>
          <th> Start Time</th>
          <th> End Time</th>
          <th> Instructor </th>
          <th>Class Name</th>
          <th> Seats </th>
          <th>Difficulty</th>
        </tr>

        <style>
          <?php include 'style.css'; ?>
        </style>

<?php
      
      

        //find classes user register for 

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

      $findAllClasses = "SELECT c.ClassID, c.StartTime, c.EndTime, c.Date, c.ClassName, c.Difficulty, c.Seats, u.FirstName
                       FROM Classes c
                       INNER JOIN Users u ON c.UserID = u.UserID";  // Assuming 'UserID' is in both tables
      $result=$conn->query($findAllClasses);
      if($result->num_rows>0){
      while($row = $result->fetch_assoc()) {

      echo "<tr>
       <td>" . $row['ClassID'] . "</td>
        <td>".$row['Date']. "</td>
       <td>". $row['StartTime'] . "</td>
       <td>".$row['EndTime'] . "</td>
       <td>" . $row['FirstName'] . "</td>
       <td>". $row['ClassName']."</td>
       <td>". $row['Seats']."</td>
       <td>". $row['Difficulty']."</td>
     </tr>";

   }

 }

}
?>


</table>
</div>
<div>
  <h2 class="tableHeaders"> Events </h2>
  <table class="tablesFormatEvents">
    <tr class="bg-dark text-white">
      <th>EventID</th>
       <th> Date</th>
      <th> Start Time</th>
      <th> End Time</th>
      <th>Event Name</th>
      <th> Host </th>
      <th>Notes</th>
    </tr>
    <?php
    #EVENT
    $findAllEvents= "SELECT e.EventID, e.StartTime, e.EndTime, e.Date, e.EventName, e.Notes, u.FirstName
                       FROM Events e
                       INNER JOIN Users u ON e.UserID = u.UserID";
    $output=$conn ->query($findAllEvents);

    if($output->num_rows>0)
    {
      while($instance=$output->fetch_assoc()){
      echo "<tr>
        <td>".$instance['EventID'] . "</td>
        <td>".$instance['Date']. "</td>
        <td>".$instance['StartTime'] . "</td>
        <td>".$instance['EndTime'] . "</td>
        <td>".$instance['EventName']."</td>
        <td>".$instance['FirstName']."</td>
        <td>".$instance['Notes']."</td>
      </tr>";
    }
  }

  //if they press logout button do session_destroy(); and redirect to the index.html

  ?>
</table>
</div>
<table class="tablesFormatForms">
  <tr>
    <td>
      <div id="instructorContainer" class="dashboardContainers">
        <h3> Assign Instructor for Class </h3>
        <form id="instructorForm" action="ManagerAction.php" method="POST">
          <label for="classID">Class ID: </label><br>
          <input type="text" name="providedClassID" id="classID"><br><br>
          <label for="UserID">UserID: </label><br>
          <input type="text" name="providedUserID" id="userID"><br><br>
          <br> <input type="Submit" name ="assignInstructor" value="Assign Instructor">
        </form>
      </div>
    </td>
    <td>
      <div id="removeClassContainer" class="dashboardContainers">
        <h3> Remove a Class </h3>
        <form id="classForm" action="ManagerAction.php" method="POST">
          <label for="classID">Class ID: </label><br>
          <input type="text" name="providedClassID" id="classID"><br><br>
          <br> <input type="Submit" name= "removeClass" value="Remove Class">
        </form>
      </div>

    </td>
    <td>
      <div id="removeEventContainer" class="dashboardContainers">
        <h3> Remove an Event </h3>
        <form id="eventForm" action="ManagerAction.php" method="POST">
          <label for="eventID">Event ID: </label><br>
          <input type="text" name="providedEventID" id="eventID"><br><br>
          <br> <input type="Submit" name="removeEvent" value="Remove Event">
        </form>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div id="seatsContainer" class="dashboardContainers">
        <h3> Update Seats for Class </h3>
        <form id="instructorForm" action="ManagerAction.php" method="POST">
          <label for="classID">Class ID: </label><br>
          <input type="text" name="providedClassID" id="classID"><br><br>
          <label for="UserID">Seats: </label><br>
          <input type="text" name="providedSeats" id="userID"><br><br>
          <br> <input type="Submit" name ="updateSeats" value="Update Seats">
        </form>
      </div>
    </td>
    <td>
    <div id="classContainer" class="dashboardContainers">
    <h3> Create A Class </h3>
    <form action="ManagerAction.php" method ="POST">

      <label for="ClassName">Class Name:</label><br>
      <input type="text" id="ClassName" name="ClassName"><br><br>

      <label for="Date">Date of Class:</label><br>
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
      <label for="instructorID">UserID of Instructor: </label><br>
      <input type="text" name="instructorID" id="instructorID"><br><br>
      <label for="difficulty">Difficulty</label><br>
      <input type="text" name ="difficulty" id="difficulty"><br><br>

      <button input type="submit" name="createClass"> Create Class</button>
    </form>
  </div>
</td>
    <td>
    <div id="socialEventContainer" class="dashboardContainers">
    <h3> Create A Social Event </h3>
    <form action="ManagerAction.php" method ="POST">

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

      <button input type="submit" name="createEvent"> Create Event</button>
    </form>
  </div>
</td>
</tr>
</table>
<div>
  <h2 class="tableHeaders"> Users </h2>
  <table class="tablesFormatUsers">
    <tr class="bg-dark text-white">
      <th>Name</th>
      <th>UserID </th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Role</th>
    </tr>
    <?php
    #EVENT
    $findAllUsers="SELECT * FROM `Users`";
    $output=$conn ->query($findAllUsers);

    if($output->num_rows>0)
    {
      while($instance=$output->fetch_assoc()){
      echo "<tr>
        <td><span>".$instance['FirstName'] . "</span> <span> ".$instance['LastName'] . " </span></td>
        <td>".$instance['UserID']. "</td>
        <td>".$instance['Email'] . "</td>
        <td>".$instance['PhoneNumber'] . "</td>
        <td>".$instance['Role']."</td>
      </tr>";
    }
  }

  //if they press logout button do session_destroy(); and redirect to the index.html
  $conn->close();
  ?>
</table>
</div>
<table class="tablesFormatForms">
  <tr>
    <td>
      <div id="roleContainer" class="dashboardContainers">
        <h3> Update Role </h3>
        <form id="attendanceForm" action="ManagerAction.php" method="POST">
          <label for="userID">User ID: </label><br>
          <input type="text" name="providedUserID" id="userID"><br><br>
          <label for="userRole">Role:</label><br>
          <select name="providedRole" id="userRole">
            <option value="role">Role</option>
            <option value="climber">Climber</option>
            <option value="instructor">Instructor</option>
            <option value="manager">Manager</option>
          </select><br><br>
          <br> <input type="Submit" name="updateRole" value="Update Role">
        </form>
      </div>
    </td>
    <td>
      <div id="removeUserContainer" class="dashboardContainers">
        <h3> Remove a User </h3>
        <form id="removeForm" action="ManagerAction.php" method="POST">
          <label for="UserID">UserID: </label><br>
          <input type="text" name="providedUserID" id="userID"><br><br>
          <br> <input type="Submit" name="removeUser" value="Remove User">
        </form>
      </div>
    </td>
  </tr>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js"> </script>
</body>
</html>
