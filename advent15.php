<?php

function bake($sugar, $sprinkles, $candy, $chocolate)
{
	if(($sugar * 2 + $sprinkles * 9 + $candy * 1 + $chocolate * 8) != 500) return 0;
	if(0 > $capacity = $sugar * 3 + $sprinkles * -3 + $candy * -1) return 0;
	if(0 > $durability = $sprinkles * 3) return 0;
	if(0 > $flavor = $candy * 4 + $chocolate * -2) return 0;
	if(0 > $texture = $sugar * -3 + $chocolate * 2) return 0;
	
	$value = $capacity * $durability * $flavor * $texture;
	echo "$sugar $sprinkles $candy $chocolate = $value<BR>";
	
	return $value;
}

$maxScore = 0;
$count = 0;
for($sugar = 0; $sugar <= 100; $sugar++) {
	for($sprinkles = 0; $sprinkles <= (100 - $sugar); $sprinkles++) {
		for($candy = 0; $candy <= (100 - $sugar - $sprinkles); $candy++) {
			$maxScore = max($maxScore, bake($sugar, $sprinkles, $candy, (100 - $sugar - $sprinkles - $candy)));
			$count++;
		}
	}
}
echo "$count $maxScore";

?>