<?php

$input = file_get_contents("advent24_input.txt");
$inputArray = explode(PHP_EOL, $input);
$combinations = [];
//$targetWeight = array_sum($inputArray) / 3;
$targetWeight = array_sum($inputArray) / 4;
$bestDepth = 99;
var_dump($inputArray, $targetWeight);
function getCombos($combo, $arr)
{
	global $bestDepth, $combinations, $targetWeight;
	if (count($combo) > $bestDepth)
	{
		return;
	}
	$sum = array_sum($combo);
	if($sum == $targetWeight)
	{
		$combinations[] = $combo;
		$bestDepth = count($combo);
		return;
	}
	else if ($sum > $targetWeight)
	{
		return;
	}
	if (count($arr) == 0) return;
	$newComboElem = array_shift($arr);
	//var_dump($combo, $arr);
	getCombos($combo, $arr);
	$combo[] = $newComboElem;
	getCombos($combo, $arr);
}
$combo = [];
getCombos($combo, $inputArray);

$minQE = PHP_INT_MAX;
foreach($combinations as $combination)
{
	$product = array_product($combination);
	//echo "$product<BR>";
	$minQE = min($minQE, array_product($combination));
}
echo $minQE;
?>