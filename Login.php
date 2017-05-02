<html>
<head>
<title>Hello World</title>
</head>
<body>
<h1>Timebooking Login</h1>

<?php
// Start the session
session_start();

// Set session variables
$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["access"] = "";

// define variables and set to empty valuess
	$usernameErr = $passwordErr = "";
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "clarity2";
	$tbname = "users";
	
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
    return $result;
    $conn->close();
  }
  
  function ValidateUser($UN, $PW){
    $sql = "SELECT User_ID, Username, Password, Role_ID FROM users WHERE Username=\"" . $UN ."\"" and "Password=\"" . $PW ."\"";
    $output = "<table><tr><th>Username</th><th>Password</th></tr>";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $output .= "<tr>" . "<td>" . $row["Username"] . "</td>" . "<td>" . $row["Password"] . "</td>" . "</tr>";
        }
    } else {
        $output .= "<tr>No results</tr>";
    }
    $output .= "</table>";
    echo $output;
  }
  
    function ValidateSession($UN){
	  $sql = "SELECT User_ID, Username, Password, Role_ID FROM users WHERE Username=\"" . $UN ."\"";
	  $output = "<table><tr><th>Username</th><th>Role_ID</th></tr>";
	  $result = SendSQL($sql);
	  $row = $result->fetch_assoc();
	  if ($row["Role_ID"] == 1){
		$output .= "<tr>Standard user</tr>";
		$_SESSION["access"] = Standard;
    } else {
		if ($row["Role_ID"] == 2){
        $output .= "<tr>Admin user</tr>";
		$_SESSION["access"] = Admin;
		}
    }
    $output .= "</table>";
    echo $output;
  }
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION["username"] = test_input($_POST["username"]);
  $_SESSION["password"] = test_input($_POST["password"]); 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Username: <input type="text" name="username" required> <span class="error">*</span><br><br>
Password: <input type="password" name="password" required> <span class="error">*</span><br>
<input type="submit">
</form>
<?php


ValidateUser($_SESSION["username"],$_SESSION["password"]);
ValidateSession($_SESSION["username"]);

echo "<h2>Input:</h2>";
echo $_SESSION["username"];
echo "<br>";
echo $_SESSION["password"];
echo "<br>";
echo $_SESSION["access"];

?>
</body>
</html>