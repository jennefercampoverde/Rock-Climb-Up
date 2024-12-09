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
            <a class="nav-link" href="index2.html">Home</a>
            <a class="nav-link active" aria-current="page" href="Managerdashboard.html">Dashboard</a>
            <a class="nav-link" href="schedule.html">Schedule</a>
          </div>
        </div>
      </div>
    </nav>    
    <h1 id="ClimberHeader">Hello {Manager First Name} </h1>
    <div>
      <h2 class="tableHeaders"> Classes </h2>
      <table class="tablesFormatClasses">
        <tr class="bg-dark text-white">
          <th>ClassID</th>
          <th> Start Time</th>
          <th> End Time</th>
          <th> Date</th>
          <th> Instructor </th>
          <th>Class Name</th>
          <th>Difficulty</th>
        </tr>

        <style>
          <?php include 'style.css'; ?>
        </style>

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
      $userID=1;

      $findAllClasses = "SELECT c.ClassID, c.StartTime, c.EndTime, c.Date, c.ClassName, c.Difficulty, u.FirstName
                       FROM Classes c
                       INNER JOIN Users u ON c.UserID = u.UserID";  // Assuming 'UserID' is in both tables
      $result=$conn->query($findAllClasses);
      if($result->num_rows>0){
      while($row = $result->fetch_assoc()) {

      echo "<tr>
       <td>" . $row['ClassID'] . "</td>
       <td>". $row['StartTime'] . "</td>
       <td>".$row['EndTime'] . "</td>
       <td>".$row['Date']. "</td>
       <td>" . $row['FirstName'] . "</td>
       <td>". $row['ClassName']."</td>
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
      <th> Start Time</th>
      <th> End Time</th>
      <th> Date</th>
      <th>Event Name</th>
      <th>Notes</th>
    </tr>
    <?php
    #EVENT
    $findAllEvents="SELECT * FROM `Events`";
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
            <option value="receptionist">Receptionist</option>
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
