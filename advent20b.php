<?php
$input = 3600000;

 function sumfactor($n){
 $factors_array = array();
 $sqrt = sqrt(abs($n));
 for ($x = 1; $x <= $sqrt; $x++)
 {
    if ($n % $x == 0)
    {
        $z = $n/$x; 
        array_push($factors_array, $x, $z);
       }
   }
   return array_sum($factors_array);
 }

for($ii = 1; $ii < 1000000; $ii++)
{
	if(sumfactor($ii) > 3600000)
	{
		 echo "$ii";
		 break;
	}
}

?>