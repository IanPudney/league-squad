<?php
include "champions.php";
?><html>
<head>
<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body class="mainBody">
<form method="get"> 
<div class="main">
	<!--USER INTERFACE:-->
	<a href="index.php"><img src="league-squad.png", alt="League Squad"/></a>
		<div class="banbox">
		<image src="bansText.png" alt="Bans" style="float:left"/>
		<?php
		for ($i = 0; $i < 6; $i++)
		{
			if(isset($_GET['ban'.$i]) && isset($champions[$_GET['ban'.$i]]) && $_GET['ban'.$i]!=0)
				echo "<select class='styled-select' name = 'ban".$i."' style=\"background-image:url('http://ddragon.leagueoflegends.com/cdn/3.15.5/img/champion/".$champions[$_GET['ban'.$i]].".png');\" onchange='this.form.submit()'>";
			else
				echo "<select class='styled-select' name = 'ban".$i."' style=\"background-image:url('notAPerson.png');\" onchange='this.form.submit()'>";
			foreach ($champions as $j => $v)
			{
				if (!in_array($j, $_GET) || $j == 0)
					echo "<option value = $j> $v </option>";
			}
			if(array_key_exists('ban'.$i,$_GET))
				echo "<option selected='selected' value=".$_GET['ban'.$i].">".$champions[$_GET['ban'.$i]]."</option>";
			echo "</select>";
		}
		?>
		</div>
		<br/><br/>
		<div>
			<div class="allybox">
			<b><img src="alliesText.png" alt="Allies"></b>
			<br/>
			<?php
			for ($i = 0; $i < 5; $i++)
			{
				if(isset($_GET['team'.$i]) && isset($champions[$_GET['team'.$i]]) && $_GET['team'.$i]!=0)
					echo "<select class='styled-select' name = 'team".$i."' style=\"background-image:url('http://ddragon.leagueoflegends.com/cdn/3.15.5/img/champion/".$champions[$_GET['team'.$i]].".png');\" onchange='this.form.submit()'>";
				else
					echo "<select class='styled-select' name = 'team".$i."' style=\"background-image:url('notAPerson.png');\" onchange='this.form.submit()'>";
				foreach ($champions as $j => $v)
				{
					if (!in_array($j, $_GET) || $j == 0)
						echo "<option value = $j> $v </option>";
				}
				if(array_key_exists('team'.$i,$_GET))
					echo "<option selected='selected' value=".$_GET['team'.$i].">".$champions[$_GET['team'.$i]]."</option>";
				echo "</select><br>";
			}
			?>
			</div><div class="enemybox">
			<img src="enemiesText.png" alt="Enemies">
			<br/>
			<?php
			for ($i = 0; $i < 5; $i++)
			{
				if(isset($_GET['enemy'.$i]) && isset($champions[$_GET['enemy'.$i]]) && $_GET['enemy'.$i]!=0)
					echo "<select class='styled-select' name = 'enemy".$i."' style=\"background-image:url('http://ddragon.leagueoflegends.com/cdn/3.15.5/img/champion/".$champions[$_GET['enemy'.$i]].".png');\" onchange='this.form.submit()'>";
				else
					echo "<select class='styled-select' name = 'enemy".$i."' style=\"background-image:url('notAPerson.png');\"  onchange='this.form.submit()'>";
				foreach ($champions as $j => $v)
				{
					if (!in_array($j, $_GET) || $j == 0)
						echo "<option value = $j> $v </option>";
				}
				if(array_key_exists('enemy'.$i,$_GET))
					echo "<option selected='selected' value=".$_GET['enemy'.$i].">".$champions[$_GET['enemy'.$i]]."</option>";
				echo "</select><br>";
			}
			?>
			</div>
			<img src="verticalBeam.png" alt="vertical beam" class="verticalBeam"/>
		</div>
</div>
<?php
///CODE FOR DETERMINING PICKS HERE
//$picks=array(1=>'This is a test reason. It is centered on the blank space in this "pick" item, rather than the whole item.');

?>
<div class="results">
	<img src="bestPicksText.png",alt="Best Picks" />
	<?php
	if(!isset($picks)||empty($picks))
	{
		echo "<div class='picksTooltip'><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />As champions are chosen during draft, indicate them to the left.<br />Your best picks will appear here.</div>";
	} else {
		foreach($picks as $k => $v)
		{
			?>
			<a class="noline" href=<?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			if(empty($_GET))
			{
				echo "?";
			} else {
				echo "&";
			}
			//get the appropriate ally slot to fill
			if(!isset($_GET['team0'])||$_GET['team0']==0) echo "team0";
			elseif(!isset($_GET['team1'])||$_GET['team1']==0) echo "team1";
			elseif(!isset($_GET['team2'])||$_GET['team2']==0) echo "team2";
			elseif(!isset($_GET['team3'])||$_GET['team3']==0) echo "team3";
			elseif(!isset($_GET['team4'])||$_GET['team4']==0) echo "team4";
			echo "=".$k;
			?>><!--this weird syntax is correct-->
			<div class="pick" style="background-image:url('http://ddragon.leagueoflegends.com/cdn/3.15.5/img/champion/<?php echo $champions[$k]; ?>.png');">
			<?php echo $champions[$k]; ?>
			<div style="font-size:12;font-">
			<?php echo $v; ?>
			</div>
			</div>
			</a>
			<?php
		}
	}
	?>
	<div class="resetButton">
	<a href="<?php echo $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2)[0]; ?>"><img src="resetButton.png"/></a>
	</div>
</div>
</form>
</body>
</html>