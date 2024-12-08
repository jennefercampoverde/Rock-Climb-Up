<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <div id="topnav">
        <a href="index.html"> Home </a>
        <a href="dashboard.html"> About </a>
        <a href="schedule.html"> Schedule </a>
        <a href="register.html"> Sign Up </a>
     </div>
</body>

<body>
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
            <th>Members Enrolled</th>
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
                <td>" . $row['Seats'] . "</td>
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
            <th>Members Enrolled</th>
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
                <td>" . $row['seats'] . "</td>
                </tr>";
            }
        } else{
            echo"No Results";
        }
        ?>
    </table>
</body>
</html>