<?php

$filecontents = file_get_contents('advent14_input.txt');
preg_match_all('/(\w*) can fly (\w*) km\/s for (\w*) seconds, but then must rest for (\w*) seconds/', $filecontents, $reindeers, PREG_SET_ORDER);

$raceTime = 2503;

$maxDistance = 0;
foreach($reindeers as $reindeer)
{
	$distance = 0;
	list($foo, $name, $speed, $goTime, $stopTime) = $reindeer;
	$loopTime = $goTime + $stopTime;
	for($ii = 0; $ii < $raceTime; $ii++)
	{
		if($ii % $loopTime < $goTime)
		{
			$distance += $speed;
		}
	}
	$maxDistance = max($maxDistance, $distance);
}

echo $maxDistance

?>