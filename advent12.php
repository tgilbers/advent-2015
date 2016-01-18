<?php

$inputstring = file_get_contents("advent12_input.txt");

// php makes it fairly easy to do this task by using json_decode, and then recursively iterating over the
// arrays and stdObjects that result.
// this method tries to perform the task via string parsing, instead

$pos = strpos($inputstring, "red");
while($pos !== false)
{
	$openPos = $pos;
	$parenCount = 1;
	$squareCount = 0;
	$skip = false;
	$done = false;
	while($openPos > 0 && !$skip && !$done)
	{
		$openPos--;
		switch($inputstring[$openPos])
		{
			case '[':
			{
				//echo "found [ $openPos $squareCount $parenCount" . PHP_EOL;
				if((-1 == --$squareCount) && $parenCount == 1)
				{
					$skip = true;
				}
				break;
			}		
			case ']':
			{
				//echo "found ] $openPos $squareCount $parenCount" . PHP_EOL;
				$squareCount++;
				break;
			}
			case '{':
			{
				//echo "found { $openPos $squareCount $parenCount" . PHP_EOL;
				if(0 == --$parenCount)
				{
					$done = true;
				}
				break;
			}
			case '}':
			{
				//echo "found } $openPos $squareCount $parenCount" . PHP_EOL;
				$parenCount++;
				break;
			}
		}
		//echo "$squareCount $parenCount $openPos<br>";
	}
	//die($openPos);
	$closePos = $pos;
	if(!$skip)
	{
		$parenCount = 1;
		while($parenCount != 0)
		{
			if($inputstring[$closePos] == '}')
			{
				if(0 == --$parenCount)
				{
					//echo("found");
					break;
				}
			}
			if($inputstring[$closePos] == '{')
			{
				$parenCount++;
			}
			$closePos++;
		}
		$lenToRemove = 	$closePos - $openPos;

		//echo "$openPos $closePos " . substr($inputstring, $openPos, $lenToRemove+1). PHP_EOL . PHP_EOL;
	
		$inputstring = substr($inputstring,0, $openPos+1) . substr($inputstring, $closePos);
		
		//die(substr($inputstring, 0, $closePos));// . PHP_EOL. PHP_EOL;
	
		$newPos = $openPos;
	}
	else
	{
		$newPos = $pos + 3;
	}
	$pos = strpos($inputstring, "red", $newPos);
	//echo substr($inputstring,0, 
}

echo $inputstring;
preg_match_all('/([-0-9]+)/', $inputstring, $matches);

echo(array_sum($matches[0]));

//var_dump($inputstring);

?>