<?php
  // Sends any SQL to server - currenly just echos any errors
  function SendSQL($sql){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "clarity2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    if ($result === FALSE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    else{
      return $result;
    }
    $conn->close();
  }
  // Reads all projects from project
  function GetProjects($criteria){
    $sql = "SELECT Project_ID, Project_Ref, Project_Name FROM projects" . $critera;
    $output = "<table><tr><th>Project_Name</th><th>Project_Ref</th></tr>";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $output .= "<tr>" . "<td>" . $row["Project_Ref"] . "</td>" . "<td>" . $row["Project_Name"] . "</td>" . "</tr>";
        }
    } else {
        $output .= "<tr>No results</tr>";
    }
    $output .= "</table>";
    echo $output;
  }
  function GetUsers($critera){
    $sql = "SELECT User_ID, Username, Password, Role_ID FROM users" . $critera;
    $output = "<table><tr><th>User ID</th><th>Username</th><th>Password</th><th>Role</th></tr>";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $output .= "<tr>" . "<td>" . $row["User_ID"] . "</td>" . "<td>" . $row["Username"] . "</td>" . "<td>" . $row["Password"] . "</td>" . "<td>" . $row["Role_ID"] . "</td>" . "</tr>";
        }
    } else {
        $output .= "<tr>No results</tr>";
    }
    $output .= "</table>";
    echo $output;
  }
  function GetBookings($criteria){
    $sql = "SELECT Booking_ID, Project_ID, User_ID, Date, Hours FROM bookings" . $critera;
    $output = "<table><tr><th>Booking ID</th><th>Project_ID</th><th>User_ID</th><th>Hours</th></tr>";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $output .= "<tr>" . "<td>" . $row["Booking_ID"] . "</td>" . "<td>" . $row["Project_ID"] . "</td>" . "<td>" . $row["User_ID"] . "</td>" . "<td>" . $row["Hours"] . "</td>" . "</tr>";
        }
    } else {
        $output .= "<tr>No results</tr>";
    }
    $output .= "</table>";
    echo $output;
  }
  function CreateProject($projRef, $projName, $startDate, $endDate){
    $sql  = "INSERT INTO projects (Project_Ref, Project_Name, Start_Date, End_Date) VALUES (" . "\"" . $projRef . "\"" . "," . "\"" . $projName . "\"" . "," . "'" . $startDate . "'" . "," . "'" . $endDate . "')";
    echo "<br>" . $sql;
    $result = SendSQL($sql);
  }
  function CreateUser($username, $password, $roleID){
    // Check if user is added on table
    $sqlQuery = "SELECT * FROM users WHERE username = \"" . $username . "\"";
    $queryResult = SendSQL($sqlQuery);
    if ($queryResult->num_rows==0){
      $sql  = "INSERT INTO users (Username, Password, Role_ID) VALUES (" . "\"" . $username . "\"" . "," . "\"" . $password . "\"" . "," . $roleID . ")";
      echo "<br>" . $sql;
      $result = SendSQL($sql);
    } else {
      $output = "User already added";
      echo $output;
    }
  }
  function CreateBooking($projectID, $userID, $date, $hours){
    $sql  = "INSERT INTO bookings (Project_ID, User_ID, Date, Hours) VALUES (" . $projectID  . "," . $userID  . "," . "\"" . $date . "\"" . "," . $hours . ")";
    echo "<br>" . $sql;
    $result = SendSQL($sql);
  }
  function GetDatalistProjects(){
    $sql = "SELECT Project_ID, Project_Ref, Project_Name FROM projects" . $critera;
    $output = "<datalist id=\"projects\">";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $output .= "<option value=\"" . $row["Project_ID"] . "\">" . $row["Project_Ref"] . " - " . $row["Project_Name"] . "</option>";
        }
    } else {
        $output .= "</datalist>";
    }
    $output .= "</datalist>";
    echo $output;
  }


?>
