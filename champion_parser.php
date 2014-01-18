<?php
echo "<?php\n";
$data=json_decode(file_get_contents("http://prod.api.pvp.net/api/lol/na/v1.1/champion?freeToPlay=0&api_key=945bb189-d900-4ac5-a93d-7e98dda6c2a0"));
foreach($data->champions as $k => $champion)
{
	echo '$champions['.$champion->id.']=\''.$champion->name."';\n";
}
echo '?>';
?>