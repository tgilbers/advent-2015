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

$filecontents = file_get_contents('advent9_input.txt');
preg_match_all('/(\w*) to (\w*) = (\w*)/', $filecontents, $instructions, PREG_SET_ORDER);

//var_dump($instructions);

$locsbk = array();
$locs = array();
$dists = array();

foreach($instructions as $ins)
{
	if(!array_key_exists($ins[1], $locsbk))
	{
		$locsbk[$ins[1]] = "true";
		$locs[] = $ins[1];
	}
	if(!array_key_exists($ins[2], $locsbk))
	{
		$locsbk[$ins[2]] = "true";
		$locs[] = $ins[2];
	}	
	$dists[$ins[1]][$ins[2]] = $ins[3];
	$dists[$ins[2]][$ins[1]] = $ins[3];
}

//var_dump($locs);

$paths = array();
pc_permute($locs, array(), $paths);

//var_dump($paths);

$shortdist = 99999999;

foreach($paths as $path)
{
//$path = $paths[0];
	$dist = 0;
	for($ii = 0; $ii <= 6; $ii++)
	{
		$onedist = $dists[$path[$ii]][$path[$ii+1]];
		//echo $path[$ii] . " " . $onedist . " ";
		$dist += $onedist;
	}
	//echo $path[6] . " " . $dist . PHP_EOL;
	$shortdist = min($shortdist, $dist);
}

echo $shortdist;



?>