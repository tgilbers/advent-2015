<?php
$inputstring = file_get_contents("advent19_input.txt");
$inputrulesstring = file_get_contents("advent19_input_rules.txt");

preg_match_all("/(\w*) => (\w*)/", $inputrulesstring, $inputrules, PREG_SET_ORDER);
foreach($inputrules as $inputrule)
{
	list(,$key,$val) = $inputrule;
	$rules[$val] = $key;
}

function sortByLengthReverse($a, $b){
    return strlen($b) - strlen($a);
}

uksort($rules, "sortByLengthReverse");

$steps = 0;

$inputstring_last = "";
while($inputstring != 'e' && $inputstring != $inputstring_last)
{
	$inputstring_last = $inputstring;
	foreach($rules as $rulekey => $ruleval)
	{
		$pos = strpos($inputstring, $rulekey);
		if(false !== $pos)
		{
			$steps ++;
			$inputstring = substr($inputstring, 0, $pos) . $ruleval . substr($inputstring, $pos + strlen($rulekey));
			echo "$inputstring<BR>";
			break;
		}
	}
}
echo $steps;

?>