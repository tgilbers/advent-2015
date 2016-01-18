<?php

$strings = explode("\r\n", file_get_contents('advent8_input.txt'));

$totaldiff = 0;
foreach($strings as $string)
{
	$diff = 2;
	$pos = strpos($string, '\\');
	$len = strlen($string);
	echo "$string ";
	while($pos !== false)
	{
		if(($string[$pos+1] == '\\') || ($string[$pos+1] == '"'))
		{		
			echo "$pos(1) ";
			$pos += 1;
			$diff += 1;
		}		
		else if($string[$pos+1] == 'x')
		{
			if(($len = $pos + 3) && (false !== hex2bin(substr($string, $pos+2, 2))))
			{
				echo "$pos(3) ";
				$pos += 3;
				$diff += 3;
			}
		}
		$pos = strpos($string, '\\', $pos+1);
	}
	echo "diff($diff) " . PHP_EOL;
	$totaldiff += $diff;
}

echo $totaldiff;

?>