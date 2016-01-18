<?php

$input = file_get_contents('advent3_input.txt');

$houses = array();
$pos_ns = 0;
$pos_ew = 0; 

for ($ii = 0; $ii < strlen($input); $ii++)
{
	switch($input[$ii]) {
		case '^':
			$pos_ns++;
			break;
		case 'v':
			$pos_ns--;
			break;
		case '>':
			$pos_ew++;
			break;
		case '<':
			$pos_ew--;
			break;
		default:
			echo '?';
			break;
		
	}
	$houses[$pos_ns][$pos_ew] = true;			
}

// count in a MD array will include the count of the elements in the base array
// all we want are the count of the sub elements, so remove them
$total_count = count($houses, COUNT_RECURSIVE) - count($houses);

echo $total_count . PHP_EOL;

?>