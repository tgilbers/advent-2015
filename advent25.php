<?php


$row = 2978;
$column = 3083;
$code = 20151125;
echo "$code<BR>";

$edgecode = getCode($row, $column) - 1;
echo $edgecode . "<BR>";

function getCode($row, $column) {
	$edgecol = $column + $row - 1;
	$result = 0;
	for($ii = 1; $ii <= $edgecol; $ii++) {
		$result += $ii;
	}
	return $result - ($edgecol - $column);
}

for($ii = 1; $ii <= $edgecode; $ii++)
{
	$code = gmp_powm($code, 252533,33554393);
}
echo gmp_strval($code) . "<BR>";

// not 17370278

?>