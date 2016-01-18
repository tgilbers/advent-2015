<?php

function pc_permute($items, $perms = array( ), &$results) {
    if (empty($items)) { 
        $results[] = $perms;
    }  else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             pc_permute($newitems, $newperms, $results);
         }
    }
}

$filecontents = file_get_contents('advent13_input.txt');
preg_match_all('/(\w*) would (\w*) (\w*) happiness units by sitting next to (\w*)/', $filecontents, $instructions, PREG_SET_ORDER);

//var_dump($instructions);

$peoplebook = array();
$people = array();
$feelings = array();

foreach($instructions as &$ins) {
	if(!array_key_exists($ins[1], $peoplebook)) {
		$peoplebook[$ins[1]] = "true";
		$people[] = $ins[1];
	}
	if($ins[2] == "lose") {
		$feelings[$ins[1]][$ins[4]] = $ins[3] * -1;
	}
	else {
		$feelings[$ins[1]][$ins[4]]  = (int)$ins[3];
	}
}

$people[] = "Me";
foreach($people as $person)
{
	$feelings["Me"][$person] = 0;
	$feelings[$person]["Me"] = 0;
}

//var_dump($feelings);

$paths = array();
pc_permute($people, array(), $paths);

//var_dump($paths);

$mosthappy = 0;
foreach($paths as $path)
{
	$totalhappy = 0;
	$path[] = $path[0];
	$path[] = $path[1];
	//var_dump($path);
	$dist = 0;
	for($ii = 1; $ii < count($path)-1; $ii++)
	{
		$happy = $feelings[$path[$ii]][$path[$ii+1]] + $feelings[$path[$ii]][$path[$ii-1]] ;
		//echo $path[$ii] . " " . $happy . PHP_EOL;
		$totalhappy += $happy;
	}
	$mosthappy = max($mosthappy, $totalhappy);

}

echo $mosthappy;



?>