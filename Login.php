<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Timebooking login</title>
</head>
<body>
	<div class="main">
		<h1>Timebooking Login</h1>
			<form class="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="row"><label class="label">Username:</label><input class="input" type="text" name="username"> <span class="error"> *</span></div><br>
				<div class="row"><label class="label">Password:</label><input class="input" type="password" name="password"> <span class="error"> *</span></div>
			<div>
				<input class="input" type="submit" name="login" id="login" value="Login">
				<input class="input" type="submit" name="logout" id="logout" value="Logout">
			</div>
		</form>
	</div>
</body>
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

if(array_key_exists('Login', $_POST)){
	Login($_SESSION["username"],$pw);
	GetRole($_SESSION["username"]);
}

GetLogin($_SESSION["login"]);

if(array_key_exists('Logout', $_POST)){
	Logout();
}
?>
</html>
