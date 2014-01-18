<?php
	$next_user=36583161;
	$match_data=json_decode(file_get_contents("http://prod.api.pvp.net/api/lol/na/v1.3/game/by-summoner/".$next_user."/recent?api_key=945bb189-d900-4ac5-a93d-7e98dda6c2a0"));
	print_r($match_data);
?>