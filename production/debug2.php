<?php

echo stdDate("01-03-83");

function stdDate($date){
	if (is_numeric($date)){
		$UNIX_DATE = ($date - 25569) * 86400;
		return gmdate("Y-m-d", $UNIX_DATE);
	}else{
	    $arr = explode("-",$date);
	    $year =  $arr[2];
	    $day =  $arr[1];
	    $month =  $arr[0];
	    return date('Y-m-d',strtotime("$year-$month-$day"));   	
	}

}


?>