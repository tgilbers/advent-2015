<?php
$inputstring = file_get_contents("advent19_input.txt");
$inputrulesstring = file_get_contents("advent19_input_rules.txt");

preg_match_all("/(\w*) => (\w*)/", $inputrulesstring, $inputrules, PREG_SET_ORDER);
foreach($inputrules as $inputrule)
{
	list(,$key,$val) = $inputrule;
	$rules[$key][] = $val;
}

$replacements = [];

foreach($rules as $rulekey => $ruleval)
{
	$pos = strpos($inputstring, $rulekey);
	while(false !== $pos)
	{
		foreach($ruleval as $val)
		{
			$replstring = substr($inputstring, 0, $pos) . $val . substr($inputstring, $pos + strlen($rulekey));
			//echo "$replstring<BR>";
			if(false === array_search($replstring, $replacements))
			{
				$replacements[] = $replstring;
			}
		}
		$pos = strpos($inputstring, $rulekey, $pos+1);
	}
}

echo count($replacements);

?>