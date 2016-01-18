<?php

$filecontents = file_get_contents('advent14_input.txt');
preg_match_all('/(\w*) can fly (\w*) km\/s for (\w*) seconds, but then must rest for (\w*) seconds/', $filecontents, $inputreindeers, PREG_SET_ORDER);

$raceTime = 2503;

$maxDistance = 0;

foreach($inputreindeers as $reindeer)
{
	list($foo, $name, $speed, $goTime, $stopTime) = $reindeer;
	$reindeers[$name] = [ 
				"name" => $name,
				"speed" => $speed,
				"goTime" => $goTime,
				"stopTime" => $stopTime,
				"loopTime" => $goTime + $stopTime,
				"distance" => 0,
				"points" => 0 ];

}

$distance = 0;

for($ii = 0; $ii < $raceTime; $ii++)
{
	$maxDistance = 0;
	foreach($reindeers as &$reindeer)
	{
		if($ii % $reindeer['loopTime'] < $reindeer['goTime'])
		{
			$reindeer['distance'] += $reindeer['speed'];
		}
		$maxDistance = max($maxDistance, $reindeer['distance']);
	}
	foreach($reindeers as &$reindeer)
	{
		if($reindeer['distance'] == $maxDistance)
		{
			$reindeer['points']++;
		}
	}
}

$maxPoints = 0;
foreach($reindeers as $reindeer)
{
	$maxPoints = max($maxPoints, $reindeer['points']);
}
echo $maxPoints;


?>