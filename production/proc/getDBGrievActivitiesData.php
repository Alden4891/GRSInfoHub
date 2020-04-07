<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT YEAR(DATE_REPORTED) AS P_YEAR, MONTH(DATE_REPORTED) AS P_MONTH, COUNT(id) AS GRVCOUNT FROM grievances
GROUP BY CONCAT(YEAR(DATE_REPORTED),'-', MONTH(DATE_REPORTED),'-01')
ORDER BY 1,2;
;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $P_YEAR = $row['P_YEAR'];
    $P_MONTH = $row['P_MONTH'];
    $GRVCOUNT = $row['GRVCOUNT'];

    $return_arr[] = array($P_YEAR,$P_MONTH,$GRVCOUNT);
    //$return_arr[] = array("GRVCOUNT" => $GRVCOUNT,"PERIOD" => $PERIOD);
	//$return_arr[] = array(strtotime($PERIOD),intval($GRVCOUNT));

}

echo json_encode($return_arr);
include '../dbclose.php';
?>