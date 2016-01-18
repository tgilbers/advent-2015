<?php

$strings = explode("\r\n", file_get_contents('advent5_input.txt'));

/*
$strings[] = "qjhvhtzxzqqjkmpb";
$strings[] = "xxyxx";
$strings[] = "uurcxstgmygtbstg";
$strings[] = "ieodomkazucvgmuy";
$strings[] = "aaa";
*/

$count = 0;
foreach ($strings as $string)
{
	if (
	(1 === preg_match('/([a-z]{2}).*\1/', $string))
	&&
	(1 === preg_match('/([a-z]).\1/', $string))
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