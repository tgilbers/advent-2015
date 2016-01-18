<?php

$strings = explode("\r\n", file_get_contents('advent5_input.txt'));

/*
$strings[] = "ugknbfddgicrmopn";
$strings[] = "jchzalrnumimnmhp";
$strings[] = "haegwjzuvuyypxyu";
$strings[] = "dvszwmarrgswjxmb";
*/
$count = 0;
foreach ($strings as $string)
{
	if (
	(1 === preg_match('/(.*[aeiou].*){3}/', $string))
	&&
	(1 === preg_match('/([a-z])\1/', $string))
	&&
	(0 === preg_match('/ab|cd|pq|xy/', $string))
	)
	{
		echo "$string: nice <br>";
		$count++;
	}
	else
	{
		echo "$string: naughty <br>";
	}
}
echo "$count <BR>";

?>