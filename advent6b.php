<?php

set_time_limit(600);

$lights = array_fill(0, 1000 * 1000, 0);

$commands = [ 
	"turn on" => function($input) { return $input+1; },
	"turn off" => function($input) { return max(0, $input-1); },
	"toggle" => function ($input) { return $input+2; },
];

$filecontents = file_get_contents('advent6_input.txt');
preg_match_all('/(.+?) ([0-9]+),([0-9]+) through ([0-9]+),([0-9]+)/', $filecontents, $instructions, PREG_SET_ORDER);

//echo count($instructions) . "<BR>";

foreach ($instructions as $ins)
{
	$a = $ins[2];
	$b = $ins[3];
	$c = $ins[4];
	$d = $ins[5];
	
	$command = $commands[$ins[1]];
	
	for($jj = $a; $jj <= $c; $jj++)
	{
		$jjo = $jj * 1000;
		for($ii = $b; $ii <= $d; $ii++)
		{
			$index = $ii + $jjo;			
			$lights[$index] = $command($lights[$index]);
		}
	}
}
echo array_sum($lights). '<br>';

?>