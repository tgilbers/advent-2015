<?php
$input = file_get_contents("advent18_input.txt");
$input = str_replace(PHP_EOL, "", $input);
$gridsize = 100;
function getNeighbours($index)
{
	global $gridsize;
	if ($index - ($gridsize+1) >= 0 && $index % $gridsize != 0)
		yield $index - ($gridsize+1);
	if ($index - $gridsize >= 0)
		yield $index - $gridsize;
	if ($index - ($gridsize-1) >= 0 && $index % $gridsize != ($gridsize-1))
		yield $index - ($gridsize-1);
	if ($index % $gridsize != 0)
		yield $index - 1;
	if ($index % $gridsize != ($gridsize-1))
		yield $index + 1;
	if ($index + ($gridsize-1) < ($gridsize*$gridsize) && $index % $gridsize != 0)
		yield $index + ($gridsize-1);
	if ($index + $gridsize < ($gridsize*$gridsize))
		yield $index + $gridsize;
	if ($index + ($gridsize+1) < ($gridsize*$gridsize) && $index % $gridsize != ($gridsize-1))
		yield $index + ($gridsize+1);
}


for($ii = 0; $ii < strlen($input); $ii++) {
	$lights[] = ($input[$ii] == '#') ? true : false;
}

for($loops = 1; $loops <= 100; $loops++) {
	$newlights = [];
	for($ii = 0; $ii < count($lights); $ii++) {
		$count = 0;
		$values = getNeighbours($ii);
		foreach($values as $value) {
			if($lights[$value]) $count++;
		}
		if($ii == 0 || $ii == $gridsize - 1 || $ii == $gridsize * ($gridsize - 1) || $ii == ($gridsize * $gridsize) - 1) {
			$newlights[] = true;
		}
		else if($lights[$ii] && $count == 2 || $count == 3){
			$newlights[] = true;
		}
		else if(!$lights[$ii] && $count == 3) {
			$newlights[] = true;
		}
		else {
			$newlights[] = false;
		}
	}
	$lights = $newlights;
}

echo array_sum($lights);

?>