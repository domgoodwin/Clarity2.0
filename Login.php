<html>
<head>
<title>Hello World</title>
</head>
<body>
<h1>Timebooking Login</h1>

<?php
include 'Session.php';


// define variables and set to empty values
	$pw = "";
	$usernameErr = $passwordErr = "";
	$userID = "";

  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION["username"] = test_input($_POST["username"]);
  $pw = test_input($_POST["password"]); 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

Login($_SESSION["username"],$pw);
GetRole($_SESSION["username"]);
GetLogin($_SESSION["login"]);

if(array_key_exists('logout', $_POST)){
	Logout();
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><br>
Username: <input type="text" name="username" required> <span class="error">*</span><br><br>
Password: <input type="password" name="password" required> <span class="error">*</span><br>
<input type="submit" name="login" id="login" value="Login">
</form>
<form method="POST" name="logout" action"/Login.php">
<input type="submit" name="logout" id="logout" value="Logout">
</form>
</body>
</html>