<?php  
include '../dbconnect.php';
$interv_id 		=  (isset($_REQUEST['interv_id'])?$_REQUEST['interv_id']:0); 

$res = mysqli_query($con, "
SELECT
  `subject`,
  details,
  date_conducted,
  yds_child_count,
  program_id,
  HOUSEHOLD_ID
FROM intervensions
WHERE interv_id = $interv_id;
") OR die (MYSQLI_ERROR());

	$r = mysqli_fetch_array($res, MYSQLI_ASSOC);
	$subject = $r['subject'];
	$details = $r['details'];
	$date_conducted = $r['date_conducted'];
	$yds_child_count = $r['yds_child_count'];
	$program_id = $r['program_id'];
	$HOUSEHOLD_ID = $r['HOUSEHOLD_ID'];

	echo "$subject|$details|$date_conducted|$yds_child_count|$program_id|$HOUSEHOLD_ID";


include '../dbclose.php';
?>


