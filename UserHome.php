<html>
<head>
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" type="text/css" href="style.css">
<title>User Home</title>
</head>

<body>
  <div class="row">
      <div class="large-12 columns">
        <div class="callout">
          <div class="row">
            <div class="large-12 columns">
              <h1>Time booked by you</h1>
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

GetBookings(" WHERE User_ID =" . GetUserID());

?>
<input type="button" onclick="Logout()" value="Logout">

</body>
</html>
