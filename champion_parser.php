<?php
include "champions.php";
foreach($champions as $k=>$v)
{
	echo "INSERT INTO wins VALUES (".$k;
	for($i=0;$i<=412;$i++)
	{
		echo ", 0";
	}
	echo ");\n";
}
	
?>