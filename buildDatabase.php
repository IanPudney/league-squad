<?php
function query($con,$sql)
{
	$result=mysqli_query($con,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);
}
set_time_limit(12*600);
$con=mysqli_connect("localhost","root","","league_db");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$data=file_get_contents("http://prod.api.pvp.net/api/lol/na/v1.3/game/by-summoner/32018076/recent?api_key=945bb189-d900-4ac5-a93d-7e98dda6c2a0");
//$decoded_data=json_decode($data);
//print_r($decoded_data);
//echo $decoded_data->id;
//win data:
//	->games[0-9]->stats->win=1 for win, ="" for loss
//Champion chosen:
//	->games[0-9]->championId
//fellow Player Ids:
//	->games[0-9]->fellowPlayers[0-8]->summonerId
//fellow player champions:
//	->games[0-9]->fellowPlayers[0-8]->championId

$i=0;
while(true)
{
	//get the next user
	$sql="SELECT userId FROM userids WHERE pending=1 LIMIT 1";
	$result=query($con,$sql);
	if (!$result)
		{
			$sql="SELECT userId FROM userids LIMIT 1";
			$result=query($con,$sql);
		}
	$next_user=$result[0]["userId"];
	echo $next_user."<br>";
	
	//get last ten matches
	$match_data=json_decode(file_get_contents("http://prod.api.pvp.net/api/lol/na/v1.3/game/by-summoner/".$next_user."/recent?api_key=945bb189-d900-4ac5-a93d-7e98dda6c2a0"));	
	
	//main loop
	foreach($match_data->games as $game_number => $game)
	{
		$w_champions=array();
		$l_champions=array();
		//determine the winning team
		if($game->stats->win==1)
		{
			$winning_team=$game->teamId;
			$w_champions[]=$game->championId;
			
		} else
		{
			$l_champions[]=$game->championId;
			if($game->teamId==100)
			{
				$winning_team=200;
			} else
			{
				$winning_team=100;
			}
		}
		
		
		
		//add players
		foreach($game->fellowPlayers as $player_number => $player)
		{
			//add newly encountered players to the queue
			$sql = "SELECT userId FROM userids WHERE userId=".$player->summonerId;
			$result = mysqli_query($con,$sql);
			if(!$result)
			{
				echo "ERROR 1: ".mysqli_error($con);
			}
			if(mysqli_num_rows($result) == 0)
			{
				//user is new - addify them :)
				$sql="INSERT INTO userids (userId,pending) VALUES (".$player->summonerId.",1);";
				$result=mysqli_query($con,$sql);
				if(!$result)
				{
					echo "ERROR 2: ".mysqli_error($con);
				}
			}
			
			//build the game value tables
			if($player->teamId==$winning_team)
			{
				$w_champions[]=$player->championId;
			} else {
				$l_champions[]=$player->championId;
			}
		}
		
		
		//write the game value tables
		if($game->subType=="RANKED_SOLO_5x5")
		{
			$sql="INSERT INTO games VALUES (".$game->gameId;
			foreach($w_champions as $k =>$v)
			{
				$sql=$sql.", ".$v;
			}
			foreach($l_champions as $k =>$v)
			{
				$sql=$sql.", ".$v;
			}
			$sql=$sql.",0)";
			$result=mysqli_query($con,$sql);
			if(!$result)
			{
				echo "ERROR 3: ".mysqli_error($con)."\n<br>\n";
				echo "\n<br>\n";
			}
		}
	}
	
	//mark this user as no longer pending
	$sql="UPDATE userids SET pending=0 WHERE userId=".$next_user;
	$result=mysqli_query($con,$sql);
	if(!$result)
	{
		echo "ERROR 4: ".mysqli_error($con);
	}
	$i++;
	Sleep(3);
}

?> 