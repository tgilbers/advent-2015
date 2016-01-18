<?php

$boxes = file_get_contents('advent2_input.txt');

$boxarr = explode("\r\n", $boxes);

$paperTotal = 0;
$ribbonTotal = 0;
foreach($boxarr as $box)
{
	$dims = explode("x", $box);
	// Part 1: calculate paper
	$lw = $dims[0]*$dims[1];
	$wh = $dims[1]*$dims[2];
	$hl = $dims[2]*$dims[0];
	$paper = 2*$lw + 2*$wh + 2*$hl + min($lw,$wh,$hl);
	//echo "$box: 2*$lw + 2*$wh + 2*$hl + min($lw,$wh,$hl) =$paper" . PHP_EOL;
	$paperTotal += $paper;
	
	// Part 2: calculate ribbon
	$p_lw = 2*$dims[0] + 2*$dims[1];
	$p_wh = 2*$dims[1] + 2*$dims[2];
	$p_hl = 2*$dims[2] + 2*$dims[0];
	$ribbon = min($p_lw, $p_wh, $p_hl) + array_product($dims);
	//echo "$box; min($p_lw, $p_wh, $p_hl) + {$dims[0]}*{$dims[1]}*{$dims[2]} = $ribbon" . PHP_EOL;
	$ribbonTotal += $ribbon;
}

echo "Paper: $paperTotal" . PHP_EOL;
echo "Ribbon: $ribbonTotal" . PHP_EOL;
?>