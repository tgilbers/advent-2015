<?php
$input = 36000000;
$maxhouses = 1000000;

$houses = array_fill(1, $maxhouses, 0);
for($elf = 1; $elf < $maxhouses; $elf++)
{
	for($house = $elf; ($house <= ($elf * 50)) && ($house <= $maxhouses); $house += $elf)
	{
		$houses[$house] += ($elf * 11);
	}
	
}

$maxvalue = 0;
foreach($houses as $key =>$value)
{
	//$maxvalue = max($maxvalue, $value);
	if($value > $input)
	{
		echo "$value $key<BR>";
		break;
	}
}
//echo "maxvalue: $maxvalue";



?>