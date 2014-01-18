<?php
$con=mysqli_connect("localhost","root","","league_db");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="SELECT championId FROM wins ORDER BY championId";
if ($result=mysqli_query($con,$sql))
  {
  $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
  foreach($data as $k => $v)
  {
	$data[$k]=$v['championId'];
  }
  $data=array_flip($data);
  var_export($data);
  }
else
  {
  echo "Command failed: " . mysqli_error($con);
  }

?>