<?php

//$string = "cqjxjnds";
$string = "cqjxxyzz";
$alphas = range('a', 'z');

function incrementLetter(&$str, $pos)
{
	global $alphas;
	if ($str[$pos] == 'z') {
		$str[$pos] = 'a';
		if($pos <> 0) {
			incrementLetter($str, $pos-1);
		}
	}
	else {
		$str[$pos] = chr(ord($str[$pos]) + 1);
	}
}
$count = 0;
while(true)
{
	incrementLetter($string, 7);

	//echo "found $string<BR>";
	if(strpos($string, "i") !== false || strpos($string, "o") !== false || strpos($string, "l") !== false)
	{
		continue;
	}
	//echo "try $string<BR>";
	for($ii = 0; $ii <=5; $ii++)
	{
		$num = ord($string[$ii]);
		$num2 = ord($string[$ii+1]);
		$num3 = ord($string[$ii+2]);
		if((($num + 1) == $num2 && ($num2 + 1) == $num3))
		{

			//echo "FOUND $string<BR>";
			if(2 === preg_match_all('/([a-z])\1/', $string, $matches, PREG_SET_ORDER))
			{
				echo $string;
				die;
			}
			break;
		}
	}
		

}
?>