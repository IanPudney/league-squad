<?php
$con=mysqli_connect("localhost","root","","league_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$sql="SELECT * FROM userids";
if ($result=mysqli_query($con,$sql))
  {
  echo "Command executed successfully<br/>";
  print_r(mysqli_fetch_all($result,MYSQLI_ASSOC));
  }
else
  {
  echo "Command failed: " . mysqli_error($con);
  }
?> 