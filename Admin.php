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

  <div class="row">
      <p><a data-open="exampleModal1">Click me for a modal</a></p>
  </div>

  <div class="reveal" id="exampleModal1" data-reveal>
    <h1>Awesome. I Have It.</h1>
    <?
        echo 'Hello'; ?>
    <p class="lead">Your couch. It is mine.</p>
    <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

          <?php
          include 'Database_Functions.php';
          // if(isset($_SESSION['access']!=Admin)){ //if login in session is not set
          //     header("Location: login.php");
          // }
          GetProjects();
          // echo "<br>";
          GetUsers();
          // echo "<br>";
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
        </div>

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


<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
</body>
</html>
