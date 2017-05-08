<?php
session_start();

include "Database_Functions.php";

function Login($UN, $PW){
    $sql = "SELECT User_ID, Username, Password, Role_ID FROM users WHERE Username=\"" . $UN ."\"" and "Password=\"" . $PW ."\"";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
			$_SESSION["login"] = true;
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!" ;
        }
    } else {
        $output .= "<tr>No results</tr>";
        echo $output;
		    $_SESSION["login"] = false;
    }
  }

function GetRole($UN){
	$sql = "SELECT User_ID, Username, Password, Role_ID FROM users WHERE Username=\"" . $UN ."\"";
	$result = SendSQL($sql);
	$row = $result->fetch_assoc();
	if ($row["Role_ID"] == 1){
		$output .= "<tr>Standard user</tr>";
		$_SESSION["role"] = Standard;
    } elseif ($row["Role_ID"] == 2){
        $output .= "<tr>Admin user</tr>";
		$_SESSION["role"] = Admin;
    }
}
 // Get user ID - returns USER ID if logged in - else 0 (not logged in)
function GetLogin($login){
	if (isset($login) && $login == true) {
		$sql = "SELECT User_ID FROM users WHERE Username=\"" . $_SESSION['username'] ."\"";
		$result = SendSQL($sql);
		while($row = $result->fetch_assoc()) {
			echo "Welcome to the member's area, " . $_SESSION['username'] . "!" ;
			$userID = $row[User_ID];
		}
		} else {
      echo "Not logged in";
	$userID = 0;
	}
}
function Logout(){
	$_SESSION["username"] = "";
	$_SESSION["role"] = "";
	$_SESSION["login"] = "";
}
?>
