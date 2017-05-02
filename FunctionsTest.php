<html>
<head>
<title>Create project</title>
</head>

<body>
<?php
include 'Database_Functions.php';
GetProjects(null);
echo "<br>";
GetUsers(null);
echo "<br>";
GetBookings(null);

if(array_key_exists('test', $_POST)){
  CreateProject("ct-1", "ct developer", "1990-01-01", "1990-01-01");
}
if(array_key_exists('test2', $_POST)){
  CreateUser("tester", "password", 1);
}
if(array_key_exists('test3', $_POST)){
  CreateBooking(2, 2, "1990-01-01", "6" );
}
?>
<form method="POST">
  <input type="submit" name="test" id="test" value="RUNPROJ" />
  <input type="submit" name="test2" id="test2" value="RUNUSER" />
  <input type="submit" name="test3" id="test3" value="RUNBOOKING" />
</form>
</body>
</html>
