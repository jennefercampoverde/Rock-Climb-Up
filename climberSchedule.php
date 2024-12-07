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
            <th>Time</th>
            <th>Class Code</th>
            <th>Class Name</th>
            <th>Instructor</th>
            <th>Difficulty</th>
            <th>Join Now!</th>
        </tr>
        <?php
        // Database information
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "SEProject2";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        // establishing database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // retrieving data from classes table
        $sql = "SELECT * FROM Classes";
        $result = $conn->query($sql);
        
        if ($result->num_rows >0){
            while ($row = $results-> fetch_assoc()){
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['StartTime']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ClassID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ClassName']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";  
                echo "</tr>";
            }
        } else{
            echo"No Results";
        }
        ?>
         <tr>
            <td>May 30th, 2024</td>
            <td>8:00AM</td>
            <td>6764574</td>
            <td>Introduction to Climbing</td>
            <td> Mya </td>
            <td> Easy </td>
            <td>
                <button type="submit">
                Enroll
                </button>  
            </td>
        </tr>
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
            <th>Time</th>
            <th>Event Code</th>
            <th>Event Name</th>
            <th>Host</th>
            <th>Join Now!</th>
        </tr>
        <tr>
            <td>April 29th, 2024</td>
            <td>11:00AM</td>
            <td>73437</td>
            <td>Community Climb</td>
            <td> Evan </td>
            <td>
                <button type="submit">
                Enroll
                </button>  
            </td>
        </tr>
    </table>
</body>
</html>
