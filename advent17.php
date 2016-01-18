<?php
$input = file_get_contents("advent17_input.txt");
$inputArray = explode(PHP_EOL, $input);
sort($inputArray);
$combinations=0;
$counts = [];
function addPerfectSums($ii, $remainder, $count)
{
  global $combinations, $inputArray, $counts;
  if($remainder == 0)
  {
    $combinations++;
    @$counts[$count]++;
    return;
  }  
  if($ii >= count($inputArray) || $remainder < $inputArray[$ii]) return;
  addPerfectSums($ii+1,$remainder-$inputArray[$ii], $count+1);  
  addPerfectSums($ii+1, $remainder, $count);
}
addPerfectSums(0, 150, 0);

// Part 1: combinations
var_dump($combinations);

// Part 2: combinations of lowest number
ksort($counts);
var_dump(array_values($counts)[0]);
?>