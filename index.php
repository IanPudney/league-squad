<?php
include "champions.php";
?>

<body style = "background-color:white;">
<h2 style="color:black; background-color:white;">This is a heading</h2>
<p style="color:black; background-color:white;">This is a paragraph.
<!--USER INTERFACE:-->

<form method="get"> 
	<?php
	echo "<br/><br/><b>Bans:</b><br/>";
	for ($i = 0; $i < 6; $i++)
	{
		echo "<select name = 'ban".$i."' onchange='this.form.submit()'>";
		foreach ($champions as $j => $v)
		{
			if (!in_array($j, $_GET) || $j == 0)
				echo "<option value = $j> $v </option><br/>";
		}
		if(array_key_exists('ban'.$i,$_GET))
			echo "<option selected='selected' value=".$_GET['ban'.$i].">".$champions[$_GET['ban'.$i]]."</option>";
		echo "</select>";
	}
	echo "<br/><br/><b>Allied Team Picks:</b><br/>";
	for ($i = 0; $i < 5; $i++)
	{
		echo "<select name = 'team".$i."' onchange='this.form.submit()'>";
		foreach ($champions as $j => $v)
		{
			if (!in_array($j, $_GET) || $j == 0)
				echo "<option value = $j> $v </option><br/>";
		}
		if(array_key_exists('team'.$i,$_GET))
			echo "<option selected='selected' value=".$_GET['team'.$i].">".$champions[$_GET['team'.$i]]."</option>";
		echo "</select>";
	}
	echo "<br/><br/><b>Enemy Picks:</b><br/>";
	for ($i = 0; $i < 5; $i++)
	{
		echo "<select name = 'enemy".$i."' onchange='this.form.submit()'>";
		foreach ($champions as $j => $v)
		{
			if (!in_array($j, $_GET) || $j == 0)
				echo "<option value = $j> $v </option><br/>";
		}
		if(array_key_exists('enemy'.$i,$_GET))
			echo "<option selected='selected' value=".$_GET['enemy'.$i].">".$champions[$_GET['enemy'.$i]]."</option>";
		echo "</select>";
	}
	?>
</form>
</body>