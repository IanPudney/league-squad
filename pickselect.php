<?php

function query($con, $sql)
{
	$result=mysqli_query($con,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}

function pickselect($IN)
{
	include "champ_index.php";
	global $champions;
	$con=mysqli_connect("localhost","root","","league_db");
	$sql = "SELECT * FROM wins";
	$result = query($con, $sql);
	$rates=$result[0];
	foreach ($champions as $j => $v)
		if(!in_array($j, $IN) && ($j !=0))
			$rates["v".$j] = 0;
	$a=0;
	for ($i = 0; $i < 5; $i++)
	{
		if ($IN["enemy".$i] != 0)
		{
			$a++;
			foreach ($champions as $j => $v)
			{
				if (!in_array($j, $IN) && $j != 0)
				{
					$rates["v".$j] += $result[$champ_index[$IN["enemy".$i]]]["v".$j]/
					  ($result[$champ_index[$j]]["v".$IN["enemy".$i]]+
					  $result[$champ_index[$IN["enemy".$i]]]["v".$j]+0.0000001);
				}	
			}
		}
	}
	arsort($rates);
	echo "\n\n\n\n\n\n\n\n\n\n\n";
	foreach ($rates as $j => $v)
	{
		if ($j != "championId" && $j!='v0' && $a!=0)
		{
			$picks[substr($j,1,5)]=$v/$a;
		}
	}
	return $picks;
}
?>
