<?php

set_time_limit(120);

$secretkey = 'iwrupvqb';
// $secretkey = 'pqrstuv';

$ii = 1;
while($ii < 99999999)
{
	$result = substr(hash('md5', $secretkey . $ii, false),0,6);
	if ($result == '000000') {
		echo $ii;
		break;
	}
	$ii++;
}

?>