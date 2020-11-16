<?php
$startdate 		=  (isset($_REQUEST['startdate'])?$_REQUEST['startdate']:''); 
$enddate 		=  (isset($_REQUEST['enddate'])?$_REQUEST['enddate']:''); 
include '../dbconnect.php';

$return_arr = array();


$where = ($startdate == "" || $enddate == "")?"WHERE grievances.DATE_REPORTED > DATE_SUB(NOW(), INTERVAL 12 MONTH)":"WHERE grievances.DATE_REPORTED BETWEEN '$startdate' AND '$enddate'";

$query = "
SELECT
  YEAR(grievances.DATE_REPORTED) AS P_YEAR,
  MONTH(grievances.DATE_REPORTED) AS P_MONTH,
  COUNT(grievances.id) AS GRVCOUNT
FROM grievances
$where
GROUP BY CONCAT(YEAR(grievances.DATE_REPORTED), '-', MONTH(grievances.DATE_REPORTED), '-01')
ORDER BY 1, 2

;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $P_YEAR = $row['P_YEAR'];
    $P_MONTH = $row['P_MONTH'];
    $GRVCOUNT = $row['GRVCOUNT'];
    $return_arr[] = array($P_YEAR,$P_MONTH,$GRVCOUNT);
}

echo json_encode($return_arr);
include '../dbclose.php';



?>

