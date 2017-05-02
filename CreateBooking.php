<html>
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
      if(isNaN(userID) || isNaN(projID)){
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

function CreateWeekBookings(){
  $projectID = $_POST["project"];
  $userID = $_POST["userID"];
  $week = $_POST["week"];
  $hours = $_POST["hours"];
  $date = new DateTime($week);
  foreach ($hours as &$value) {
    if($value != 0){
      CreateBooking($projectID, $userID, $date->format('Y-m-d'), $value);
    }
    #echo ($projectID . $userID . $date->format('Y-m-d') . $value . "<br>");
    $date->add(new DateInterval('P1D'));
  }

}

if(array_key_exists('create', $_POST)){
  CreateWeekBookings();
}
GetDatalistProjects();
GetWeeks();
?>
<form method="POST" name="booking" onsubmit="return validateForm()" action"/CreateBooking.php">
  Select Week: <input type="text" name="week" list="weeks" required> <br>
  User_ID: <input type="text" name="userID" required> <br>
  Projects <input type="text" name="project" list="projects"> <br>
  Hours:  M<input type="number" name="hours[]" class="hourInput" step="0.5">
          T<input type="number" name="hours[]" class="hourInput" step="0.5">
          W<input type="number" name="hours[]" class="hourInput" step="0.5">
          T<input type="number" name="hours[]" class="hourInput" step="0.5">
          F<input type="number" name="hours[]" class="hourInput" step="0.5">
          S<input type="number" name="hours[]" class="hourInput" step="0.5">
          S<input type="number" name="hours[]" class="hourInput" step="0.5"> <br>
  <input type="submit" name="create" id="create" value="Create Booking" />
</form>
</body>
</html>
