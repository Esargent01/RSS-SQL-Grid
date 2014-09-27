<?php
$con=mysqli_connect("localhost","root","root","two");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_close($con);
?>