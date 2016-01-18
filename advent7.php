<?php

$commands = [
	"AND" => function ($a, $b) { return $a & $b; },
	"OR" => function ($a, $b) { return $a | $b; },
	"LSHIFT" => function ($a, $b) { return $a << $b; },
	"RSHIFT" => function ($a, $b) { return $a >> $b; },
	"NOT" => function ($a, $b) { return $b ^ 0xffff; }
	];
	
$filecontents = file_get_contents('advent7_input.txt');
preg_match_all('/(\w*) *(NOT|AND|OR|LSHIFT|RSHIFT)* *(\w*) -> (\w*)/', $filecontents, $instructions, PREG_SET_ORDER);

// Pop result in here from previous run for part B
//$b = 16076;

while(empty($a))
{
	foreach($instructions as &$ins)
	{
		if($ins[1] == "NOT")
		{
			$ins[2] = "NOT";
			$ins[1] = "0";
		}

		// Do not do if set already
		if(isset($$ins[4]))
		{
			continue;
		}	
		if((isset(${$ins[3]}) || is_numeric($ins[3]) || $ins[2] == ""))
		{
			if ($ins[2] != "")
			{
				$parm2 = is_numeric($ins[3]) ? $ins[3] : $$ins[3];
			}
		}
		else
		{
			//echo "the googles do nothing!<br>";
			continue;			
		}
		if((isset(${$ins[1]}) || is_numeric($ins[1]) || $ins[2] == "NOT"))
		{
			if ($ins[2] != "NOT")
			{
				$parm1 = is_numeric($ins[1]) ? $ins[1] : $$ins[1];
			}
		}
		else
		{
			//echo "the googles do nothing!<br>";
			continue;
		}

		if (empty($ins[2]))
		{
			$$ins[4] = $parm1;
		}
		else
		{
			$$ins[4] = $commands[$ins[2]]($parm1, $parm2);
		}

	}
}
echo $a;

?>

