<html>
<head>
<title>Create booking</title>
</head>

<body>
<script>
  function validateForm() {
      var errors = "";
      var userID = document.forms["booking"]["userID"].value;
      var projID = document.forms["booking"]["projID"].value;
      var date = document.forms["booking"]["date"].value;
      var hours = document.forms["booking"]["hours"].value;
      alert("test");
      if(isNaN(userID) || isNaN(projID)){
        alert("ID fields must be numeric integers");
        return false;
      }
      if(hours >= 10){
        alert("The maximum hours you can book is 10");
        return false;
      }
      return false;
  }
</script>
<?php
include 'Database_Functions.php';

if(array_key_exists('create', $_POST)){
  $projectID = $_POST["projectID"];
  $userID = $_POST["userID"];
  $date = $_POST["date"];
  $hours = $_POST["hours"];
  CreateBooking($projectID, $userID, $date, $hours);
}
GetDatalistProjects();
?>
<form method="POST" name="booking" onsubmit="return validateForm()" action"/CreateBooking.php">
  User_ID: <input type="text" name="userID" required> <br>
  Project_ID: <input type="text" name="projectID" required> <br>
  Projects <input type="text" list="projects"> <br>
  Date: <input type="date" name="date" required> <br>
  Hours: <input type="text" name="hours" required> <br>
  <input type="submit" name="create" id="create" value="Create Booking" />
</form>
</body>
</html>
