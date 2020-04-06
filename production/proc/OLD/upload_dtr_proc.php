<?php

include '../dbconnect.php';


$size = getimagesize($_FILES['dtrfile']['tmp_name']);
$dtr = addslashes(file_get_contents($_FILES['dtrfile']['tmp_name']));



$row = 1;
$handle = fopen ($_FILES['dtrfile']['tmp_name'],"r");
$arr=array("-1");
$arr2=array("-1");
$arr3=array(923,1025);

while ($line = fgets($handle)){
	$line = preg_replace('/[\t]/', ' ', trim($line));	
	$line = str_replace(" ",';',$line);
	$data = explode(";", $line);

	$emp_id = $data[0]; 

	$datetime = $data[1].' '.$data[2];
	$datetime = date('Y-m-d h:i:s a',  strtotime($datetime));
	$datetime2 = date('Y-m-d H:i:s',  strtotime($datetime));

	$date = date('Y-m-d',  strtotime($datetime)); 
	$time = date('h:i:s a',  strtotime($datetime)); 
	$time = DateTime::createFromFormat('h:i a', $time);
	$entry = ""; 
	$mode =	0;
	if ($time < DateTime::createFromFormat('h:i a', '09:00:00 am') && in_array("$emp_id-$date-1", $arr)==false){ 
		array_push($arr,"$emp_id-$date-1");
		array_push($arr2,"$emp_id;$datetime2;1");

	}else if ($time>=DateTime::createFromFormat('h:i:s a', '04:00:00 pm') && in_array("$emp_id-$date-4", $arr)==false){ 
		array_push($arr,"$emp_id-$date-4");
		array_push($arr2,"$emp_id;$datetime2;4");

	}else if ($time>=DateTime::createFromFormat('h:i:s a', '12:00:00 pm') 
			  && $time<=DateTime::createFromFormat('h:i:s a', '01:00:00 pm') 
			  && in_array("$emp_id-$date-2", $arr)==false)  {
		array_push($arr,"$emp_id-$date-2");		
		array_push($arr2,"$emp_id;$datetime2;2");
	}else if ($time>=DateTime::createFromFormat('h:i:s a', '12:00:00 pm') 
			  && $time<=DateTime::createFromFormat('h:i:s a', '01:00:00 pm') 
			  && in_array("$emp_id-$date-2", $arr)==true)  {
		
		if (in_array("$emp_id-$date-3", $arr)==true) {
			//overweite

			$position = array_search("$emp_id-$date-3", $arr);
			if ($position !== false) {
			    $arr2[$position]="$emp_id;$datetime2;3";
			}


		}else{
			array_push($arr,"$emp_id-$date-3");
			array_push($arr2,"$emp_id;$datetime2;3");		
		}

	}  
	//echo "emp: $emp_id datetime:$datetime time: $time mode:$mode |";
}

foreach ($arr2 as $line) {
	try {
		$data = explode(";", $line);
		if (sizeof($data)==3){
		    $emp_id = $data[0];
		    $datetime = $data[1];
		    $mode = $data[2];
		    echo "[$emp_id $datetime $mode]";
		    mysqli_query($con,"CALL sp_dtr_addentry($emp_id,'$datetime',$mode);");
		}  

	}
	catch (Exception $e) {
	    //do nothing
	}
}



fclose ($handle);	




include '../dbclose.php';

echo "**success**";
?>