<?php

$string = file_get_contents('advent1_input.txt');

$count = 0;
$floor = 0;
for($ii = 0; $ii < strlen($string); $ii++) {
	switch($string[$ii]) {
		case '(':
			$floor++;
			$count++;
			break;
		case ')':
			$floor--;
			$count++;
			break;
		default:
			break;
	}
	if ($floor == -1)
		break;
}

echo $count;

?>