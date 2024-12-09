
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
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
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
            <a class="nav-link" href="climberdashboard.php">Dashboard</a>
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
        We're excited to offer a variety of rock climbing classes and special events to help climbers of all levels reach their goals!
    </h4>
    <br>
    <h4 id = "ClimberHeader">
        Don’t miss out on the fun and learning. Whether you're a seasoned climber or just starting, there's something for everyone at [Gym Name]!
    </h4>
    <br>
    <br>
</body>

<body>
    <h2 class="tableHeaders"> Classes </h2>
    <br>
    <table class="tablesFormatClasses">
        <tr class="bg-dark text-white">
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Class Code</th>
            <th>Class Name</th>
            <th>Instructor</th>
            <th>Difficulty</th>
        </tr>
        <?php

    


        // Database information
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "seproject2";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        // establishing database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // retrieving data from classes table
        $sql = "SELECT * FROM classes";
        $result = $conn->query($sql);
        
        if ($result->num_rows >0){
            while ($row = $result-> fetch_assoc()){
                echo "<tr>
                <td>" . $row['Date'] . "</td>
                <td>" . $row['StartTime'] . "</td>
                <td>" . $row['EndTime'] . "</td>
                <td>" . $row['ClassID'] . "</td>
                <td>" . $row['ClassName'] . "</td>
                <td>" . $row['UserID'] . "</td>
                <td>" . $row['Difficulty'] . "</td>
                </tr>";
            }
        } else{
            echo"No Results";
        }
        ?>
    </table>
    <br>
    <br>
</body>
<body>
    <h2 class="tableHeaders"> Social Events </h2>
    <br>
    <table class="tablesFormatClasses">
        <tr class="bg-dark text-white">
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Event Code</th>
            <th>Event Name</th>
            <th>Host</th>
        </tr>
        <?php
        // Database information
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "seproject2";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        // establishing database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // retrieving data from classes table
        $sql = "SELECT * FROM events";
        $result = $conn->query($sql);
        
        if ($result->num_rows >0){
            while ($row = $result-> fetch_assoc()){
                echo "<tr>
                <td>" . $row['Date'] . "</td>
                <td>" . $row['StartTime'] . "</td>
                <td>" . $row['EndTime'] . "</td>
                <td>" . $row['EventID'] . "</td>
                <td>" . $row['EventName'] . "</td>
                <td>" . $row['UserID'] . "</td>
                </tr>";
            }
        } else{
            echo"No Results";
        }
        ?>
    </table>
</body>
<?php
// Database infor
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seproject2";
        
$conn = new mysqli($servername, $username, $password, $dbname);
// establishing connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ClassID'])) { // Class Enrollment Form Submission
        $classCode = $_POST['ClassID'];

        // Check if class code exists in the database
        $classCheckQuery = "SELECT * FROM classes WHERE ClassID = ?";
        $stmt = $conn->prepare($classCheckQuery);
        $stmt->bind_param("s", $classCode);
        $stmt->execute();
        $classResult = $stmt->get_result();

        if ($classResult->num_rows > 0) {
            // If class code is valid, increment seats
            $updateClassQuery = "UPDATE classes SET seats = seats + 1 WHERE ClassID = ?";
            $stmt3 = $conn->prepare($updateClassQuery);
            $stmt3->bind_param("s", $classCode);

            if ($stmt3->execute()) {
                echo "Enrollment successful! Participants count updated.";
            } else {
                echo "Error: " . $stmt3->error;
            }
            $stmt3->close();
        } else {
            echo "Error: Invalid class code.";
        }

        $stmt->close();
    }

    if (isset($_POST['EventID'])) { // Event Enrollment Form Submission
        $eventCode = $_POST['EventID'];

        // Check if event code exists in the database
        $eventCheckQuery = "SELECT * FROM events WHERE EventID = ?";
        $stmt2 = $conn->prepare($eventCheckQuery);
        $stmt2->bind_param("s", $eventCode);
        $stmt2->execute();
        $eventResult = $stmt2->get_result();

        if ($eventResult->num_rows > 0) {
            // If event code is valid, increment seats
            $updateEventQuery = "UPDATE events SET seats = seats + 1 WHERE EventID = ?";
            $stmt4 = $conn->prepare($updateEventQuery);
            $stmt4->bind_param("s", $eventCode);

            if ($stmt4->execute()) {
                echo "Enrollment successful! Participants count updated.";
            } else {
                echo "Error: " . $stmt4->error;
            }
            $stmt4->close();
        } else {
            echo "Error: Invalid event code.";
        }

        $stmt2->close();
    }

    $conn->close();
}
?>
<body>
    <div class="container" >
        <div class="form-container">
            <h2>Enroll for a Class</h2>
            <form method="POST">
                <label for="classID">Class Code:</label><br>
                <input type="text" id="classID" name="ClassID" required><br><br><br>
                <button type="submit">Enroll Now!</button>
            </form>
        </div>
    </div>

    <br>

    <div class="container">
        <div class="form-container">
            <h2>Enroll for an Event</h2>
            <form method="POST">
                <label for="eventID">Event Code:</label><br>
                <input type="text" id="eventID" name="EventID" required><br><br><br>
                <button type="submit">Enroll Now!</button>
            </form>
        </div>
    </div>

</body>
</html>