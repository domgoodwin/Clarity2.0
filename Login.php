<html>
<head>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/app.css">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Timebooking login</title>
</head>
<body>
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

	if(array_key_exists('login', $_POST)){
		Login($_SESSION["username"],$pw);
		GetRole($_SESSION["username"]);
	}

	GetLogin();

	if(array_key_exists('logout', $_POST)){
		Logout();
	}
	$_SESSION['external'] = false;
	?>
	<div class="row">
		<div class="large-12 columns">
			<div class="callout">
				<div class="row">
		      <div class="large-12 columns">
		        <h1>Timebooking login</h1>
		      </div>
		    </div>
				<form method="post" action"/Login.php">
				<div class="row">
					<div class="large-4 large-push-4 columns">
							<?php echo $_SESSION["message"]; ?>
						<label>Username:</label><input class="input" type="text" name="username"> <span class="error"></span>
					</div>
				</div>
				<div class="row">
					<div class="large-4 large-push-4 columns">
						<label>Password:</label><input class="input" type="password" name="password"> <span class="error"></span>
					</div>
				</div>
				<div class="row">
					<div class="large-4 large-push-5 columns">
						<input class="success button" type="submit" name="login" id="login" value="Login">
					</div>
					<div class="large-2 large-pull-4 columns">
						<input class="alert button" type="submit" name="logout" id="logout" value="Logout">
					</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
