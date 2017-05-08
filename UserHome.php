<html>
<head>
<title>User Home</title>
</head>

<body>
<?php
include 'Session.php';

echo "<h2>Time booked by you</h2>";

GetBookings(" WHERE User_ID =" . GetUserID());

?>

</body>
</html>
