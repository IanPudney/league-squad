<?php
include "champions.php";
foreach($champions as $k => $v)
{
	echo "INSERT INTO wins VALUES (".$k;
	foreach($champions as $k2 => $v2)
	{
		echo ", 0";
	}
	echo ");\n";
}
	
?>