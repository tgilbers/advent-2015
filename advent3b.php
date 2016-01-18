<?php

class PresentDeliverer {
	public $ns = 0;
	public $ew = 0;
}

$input = file_get_contents('advent3_input.txt');

$santa = new PresentDeliverer;
$robotSanta = new PresentDeliverer;

$houses[$santa->ns][$santa->ew] = true;
$houses[$robotSanta->ns][$robotSanta->ew] = true;
 
for ($ii = 0; $ii < strlen($input); $ii++)
{
	$mover = ($ii % 2 == 0) ? $santa : $robotSanta;
	switch($input[$ii]) {
		case '^':
			$mover->ns++;
			break;
		case 'v':
			$mover->ns--;
			break;
		case '>':
			$mover->ew++;
			break;
		case '<':
			$mover->ew--;
			break;
		default:
			echo '?';
			break;
		
	}
	$houses[$mover->ns][$mover->ew] = true;			
}

// count in a MD array will include the count of the elements in the base array
// all we want are the count of the sub elements, so remove them
$total_count = count($houses, COUNT_RECURSIVE) - count($houses);

echo $total_count . PHP_EOL;

?>