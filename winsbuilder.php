<?php
function query($con, $sql)
{
	$result=mysqli_query($con,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}
set_time_limit(6000);
$con=mysqli_connect("localhost","root","","league_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//$sql="SELECT * FROM timestamp";
//$timestamp = query($con, $sql)[0][timestamp];
  
$sql="SELECT * FROM games";
$raw_data=query($con, $sql);

foreach($raw_data as $k => $v)
{
	for ($i = 0; $i < 5; $i++)
	{
		$sql="UPDATE wins SET v".$raw_data[$k]["loss0"]."=v".$raw_data[$k]["loss0"]."+1,v".
		$raw_data[$k]["loss1"]."=v".$raw_data[$k]["loss1"]."+1, v".$raw_data[$k]["loss2"].
		"=v".$raw_data[$k]["loss2"]."+1 , v".$raw_data[$k]["loss3"]."=v".$raw_data[$k]["loss3"].
		"+1 , v".$raw_data[$k]["loss4"]."=v".$raw_data[$k]["loss4"]."+1
		WHERE championId=".$raw_data[$k]["win".$i];
		mysqli_query($con,$sql);
	}
}
$sql="SELECT * FROM wins";
print_r(query($con, $sql));
?>