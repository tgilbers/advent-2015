<?php

class Mfcsam {

	protected $rules = [
	"children" => 3,
	"cats" => 7,
	"samoyeds" => 2,
	"pomeranians" => 3,
	"akitas" => 0,
	"vizslas" => 0,
	"goldfish" => 5,
	"trees" => 3,
	"cars" => 2,
	"perfumes" => 1
	];

	public function isMatch($key, $val)
	{	
		switch($key)
		{
			case "cats":
			case "trees":
				return ($val > $this->rules[$key]);
				break;
			case "pomeranians":
			case "goldfish":
				return ($val < $this->rules[$key]);
				break;
			default:
				return ($val == $this->rules[$key]);
				break;
		}	
	}
}

$filecontents = file_get_contents('advent16_input.txt');
preg_match_all('/Sue (\d+): (\w+): (\d+), (\w+): (\d+), (\w+): (\d+)/', $filecontents, $inputsues, PREG_SET_ORDER);

$mfcsam = new Mfcsam;

foreach($inputsues as $sue)
{
	list(,$num,$key1,$val1,$key2,$val2,$key3,$val3) = $sue;
		if($mfcsam->isMatch($key1, $val1) && $mfcsam->isMatch($key2, $val2) && $mfcsam->isMatch($key3, $val3))
		 	echo $num;
}

?>