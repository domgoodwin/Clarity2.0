<html>"
<head>
<title>Create booking</title>
<style>
.hourInput{
  width: 50px;
}
</style>
</head>

<body>
<script>
  function validateForm() {
      var errors = "";
      var userID = document.forms["booking"]["userID"].value;
      var projID = document.forms["booking"]["project"].value;
      var date = document.forms["booking"]["date"].value;
      var hours = document.forms["booking"]["hours"].value;
      if(isNaN(userID)){
        alert("ID fields must be numeric integers");
        return false;
      }
      if(hours >= 10){
        alert("The maximum hours you can book is 10");
        return false;
      }
      var options = document.getElementById("projects").options;
      for (var i = 0; i < options.length; i++) {
        if(options[i] = projID){
          break;
        }
        if(i == options.length - 1){
          alert("please select a entry from project list");
          return false;
        }
      }
      return false;
  }
</script>
<?php
include 'Database_Functions.php';

function GetBookingsForWeek(){
  $userID = $_POST["userID"];
  echo $userID;
  $week = $_POST["week"];
  echo $week;
  $date = new DateTime($week);
  $date->add(new DateInterval('P7D'));
  $projectID = $_POST["project"];
  GetBookings(" WHERE User_ID=" . $userID . " AND (Date BETWEEN \"" . $week . "\" AND \"" . $date->format('Y-m-d') . "\")");
}

if(array_key_exists('getBookings', $_POST)){
  GetBookingsForWeek();
}
GetDatalistProjects();
GetWeeks();
?>
<h1>User Control</h1>
<h2>Get bookings for week</h2>
<form method="POST" name="booking" onsubmit="return validateForm()" action"/UserControl.php">
  Select Week: <input type="text" name="week" list="weeks" required> <br>
  User_ID: <input type="text" name="userID" required> <br>
  Projects <input type="text" name="project" list="projects"> <br>
  <input type="submit" name="getBookings" id="getBookings" value="Get Week Bookings" />
</form>
</body>
</html>
