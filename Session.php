<?php
session_start();

// Check if logged in
if(basename($_SERVER['PHP_SELF']) == "UserHome.php" && $_SESSION['login']){

} else if($_SESSION['login']){
  $_SESSION["message"] = "top if";
  header( 'Location: UserHome.php' );
} // if loading login and first try
 else if(basename($_SERVER['PHP_SELF']) == "Login.php" && $_SESSION['external'] == false) {
  $_SESSION["message"] = "Please login";
} // check if already been redirected
 else if($_SESSION['external']){

} else {
  $_SESSION['external'] = true;
  $_SESSION["message"] = "<p class=\"error\">REDIRECT: Please login first</p>";
  header( 'Location: Login.php' );
}

include "Database_Functions.php";
function Login($UN, $PW){
  $hashedPw = GetHashedPass($PW);
    $sql = "SELECT User_ID, Username, Passwd, Role_ID FROM users WHERE Username=\"" . $UN ."\"" and "Passwd=\"" . $hashedPw ."\"";
    $result = SendSQL($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
			       $_SESSION["login"] = true;
             GetRole();
             header('Location: UserHome.php') ;
        }
    } else {
        $output .= "<tr>No results</tr>";
        echo $output;
		    $_SESSION["login"] = false;
    }
  }

function GetRole(){
  $UN = $_SESSION['username'];
	$sql = "SELECT User_ID, Username, Role_ID FROM users WHERE Username=\"" . $UN ."\"";
	$result = SendSQL($sql);
	$row = $result->fetch_assoc();
	if ($row["Role_ID"] == 1){
		$output .= "<tr>Standard user</tr>";
		$_SESSION["role"] = Standard;
    $_SESSION['username'] = $row["Username"];
  } elseif ($row["Role_ID"] == 2){
        $output .= "<tr>Admin user</tr>";
		$_SESSION["role"] = Admin;
    }
}
 // Get user ID - returns USER ID if logged in - else 0 (not logged in)
function GetLogin(){
  $login = $_SESSION['login'];
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
function GetUserID(){
  $login = $_SESSION['login'];
  if (isset($login) && $login == true) {
     $sql = "SELECT User_ID FROM users WHERE Username=\"" . $_SESSION['username'] ."\"";
     $result = SendSQL($sql);
      while($row = $result->fetch_assoc()) {
          return $row[User_ID];
      }
  } else {
      return 0;
  }
}
function Logout(){
	$_SESSION["username"] = "";
	$_SESSION["role"] = "";
	$_SESSION["login"] = "";
}
?>
