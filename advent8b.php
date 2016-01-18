<?php

$strings = explode("\r\n", file_get_contents('advent8_input.txt'));

$totaldiff = 0;
foreach($strings as $string)
{
	$newstring = '"';
	for($ii = 0; $ii < strlen($string); $ii++)
	{
		if ($string[$ii] == '"')
		{
			$newstring .= '\\"';
		}
		else if ($string[$ii] == '\\')
		{
			$newstring .= '\\\\';
		}
		else
		{
			$newstring .= $string[$ii];
		}
	}
	$newstring .= '"';
	echo "$string $newstring" . PHP_EOL;
	$totaldiff += strlen($newstring) - strlen($string);
}

echo $totaldiff;

?>