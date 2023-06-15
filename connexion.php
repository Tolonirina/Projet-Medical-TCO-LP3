
<?php
$con = mysqli_connect("localhost","root","","cabinet");
$con->query("SET lc_time_names = 'fr_FR'");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else
  {

  }
 // $con->set_charset("utf8");
  
?>