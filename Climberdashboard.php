 <!--show schedule-->
 <DOCTYPE HTML>
<html>
<table>
<h1> List of Events</h1>
<tbody>
  <br>
  <table>
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
   echo"connected";
 }
$userID=1;

$findUserEvents="SELECT * FROM Events WHERE UserID='$userID'";
 $result=$conn->query($findUserEvents);

 if($result->num_rows>0){
   while($row = $result->fetch_assoc()) {
   echo "<tr>
   <td>" . $row['EventID'] . "</td>
   <td>". $row['StartTime'] . "</td>
   <td>".$row['EndTime'] . "</td>
   <td>".$row['Date']. "</td>
   <td>". $row['EventName']."</td>
   <td>". $row['Notes'].'/td>' . "</td>
   </tr>";
   
   




   //find classes user registered for 
   //$findUserClasses="SELECT * FROM Classes WHERE UserID='1'";

}
 }
 
 $findUserClasses="SELECT * FROM Classes WHERE UserID='$userID'";
 $output=$conn ->query($findUserClasses);

 if($output->num_rows>0){
  while($instance=$output->fetch_assoc()){
      echo '<tr>';
      echo "classid: ".'<td>' . $instance['EventID'] . '</td>'. "|    ";
      echo "starttime: ".'<td>' . $instance['StartTime'] . '</td>'. "|    ";
      echo "endtime: ".'<td>' . $instance['EndTime'] . '</td>'. "|    ";
      echo "date: ".'</tr>'. $instance['Date']. '</td>'. "|    ";
      echo "class name: ". '</tr>' . $instance['ClassName'].'</td>'. "|    ";
      echo "difficulty:" . '</tr>' . $instance['Difficulty'].'/td>' . "</br>";
    }
 }


 //if they press enroll
 //if they press unenroll button 
 //if they press logout button do session_destroy(); and redirect to the index.php

?>

</tbody>
</table>


<!--      Form 1   -->
<div class="removeClassForm">

  <h3> Un-Enroll Event</h3>
  <form action="Climberdashboard.php" method="POST">
    <label for="classID"> Choose a type:</label>

    

    <select id="typeofThings" name="decision">
      <option values="title"> Select One</option>
      <option values="class">Class</option>
      <option values="event">Event</option>


      


    </select>

    <label for="code"> Class/Event Code:</label>
    <input type="number" id="classCode" ><br>


    <br><input type="submit" value="Submit">


  </form>
</div>

</body>
</html>
</DOCTYPE>