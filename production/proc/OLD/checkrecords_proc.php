<?php

    $year = (isset($_REQUEST['year'])?$_REQUEST['year']:'');
	$month = (isset($_REQUEST['month'])?$_REQUEST['month']:'');
	$mode = (isset($_REQUEST['mode'])?$_REQUEST['mode']:'');
	$category = (isset($_REQUEST['category'])?$_REQUEST['category']:'');

	include '../dbconnect.php';

$last_day = date("t", strtotime($year.'-'.$month.'-15'));	
$fday = 1;
$lday = 15;
$modelabel = "1-15";
if ($mode==2) {
	$fday = 16;
	$lday = $last_day;
	$modelabel = "16-$last_day";	
}




	$res = mysqli_query($con, "

	SELECT
	*
	FROM
	`dmcsm`.`profile`
	INNER JOIN `dmcsm`.`dtr` 
	ON (`profile`.`EMP_ID` = `dtr`.`EMP_ID`)
	WHERE MONTH(`dtr`.`LOG`) = $month 
	AND YEAR(`dtr`.`LOG`) = $year
	AND `dtr`.`LOG` BETWEEN '$year-$month-$fday' AND '$year-$month-$lday' 
	AND CATEGORY = '$category'


	") or die(mysqli_error());

	if (mysqli_num_rows($res)>0){
		echo "**success**";
	}else{
		echo "**no_records**";
	}
	mysqli_free_result($res);
    include '../dbclose.php';


?>