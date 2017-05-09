<html>
<head>
  <link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Panel</title>
</head>

<body>
  <div class="row">
      <div class="large-12 columns">
        <div class="callout">
          <div class="row">
            <div class="large-12 columns">
              <h1>Admin Control</h1>
            </div>
          </div>
          <div class="row">
            <div class="large-4 large-push-4 columns">
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
include 'Session.php';
// if(isset($_SESSION['access']!=Admin)){ //if login in session is not set
//     header("Location: login.php");
// }
GetProjects();
echo "<br>";
GetUsers();
echo "<br>";
GetBookings();

if( isset($_POST['submitProject'])){
  $Project_Ref = $_POST['Project_Ref'];
  $Project_Name = $_POST['Project_Name'];
  $Start_Date= $_POST['Start_Date'];
  $End_Date = $_POST['End_Date'];
  $result = CreateProject($Project_Ref, $Project_Name, $Start_Date, $End_Date);
}
if( isset($_POST['submitUser'])){
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];
  $Role = $_POST['Role'];
  $result = CreateNewUser($Username, $Password, $Role);
}
?>

<?php if( isset($result) ) echo $result;?>

<form action="" method="POST">
  Project Ref:  <input type="text" name="Project_Ref" required></input><br>
  Project Name: <input type="text" name="Project_Name" required></input><br>
  Start Date:   <input type="date" name="Start_Date" required></input><br>
  End Date:     <input type="date" name="End_Date" required></input><br>
  <input type="submit" name="submitProject" id="test" value="Create Project"/>
</form>

<form action="" method="POST">
  Username:  <input type="text" name="Username" required></input><br>
  Password: <input type="password" name="Password" required></input><br>
  Role:   <input type="text" name="Role" required></input><br>
  <input type="submit" name="submitUser" id="test" value="Create User"/>
</form>

</body>
</html>
