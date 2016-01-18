<?php

$strings = explode("\r\n", file_get_contents('advent23_input.txt'));
var_dump($strings);

class Instruction {
	public $op,$reg, $dist;
	
	public function __construct($op, $reg, $dist) {
		$this->op = $op;
		$this->reg = $reg;
		$this->dist = $dist;
	}
}

$operations = [
	"jio" => function(&$ii, &$reg, $dist) { $ii = ($reg == 1) ? $ii + $dist : $ii+1;},
	"hlf" => function(&$ii, &$reg, $dist) { $reg = $reg / 2; $ii++; },
	"tpl" => function(&$ii, &$reg, $dist) { $reg = $reg * 3; $ii++; },
	"inc" => function(&$ii, &$reg, $dist) { $reg++; $ii++; },
	"jie" => function(&$ii, &$reg, $dist) { $ii = ($reg % 2 == 0) ? $ii + $dist : $ii+1; },
	"jmp" => function(&$ii, &$reg, $dist) { $ii += $dist; }
	];

foreach($strings as $string)
{
	$matches = [];
	preg_match("/(\w{3}) ([ab]*),* *\+*([-\d]*)/", $string, $matches);
	list(,$op,$reg,$dist) = $matches;
	$ins[] = new Instruction($op, $reg, $dist);
}

$ii = 0;
$a = 1;
$b = 0;
while($ii < count($ins)) {
	var_dump($ins[$ii]->op);
	$operations[$ins[$ii]->op]($ii,${$ins[$ii]->reg},$ins[$ii]->dist);
}
var_dump($a, $b);

?>