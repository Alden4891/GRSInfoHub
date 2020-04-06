<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT YEAR(date_conducted) AS P_YEAR, MONTH(date_conducted) AS P_MONTH, COUNT(interv_id) AS INTCOUNT FROM intervensions
GROUP BY CONCAT(YEAR(date_conducted),'-', MONTH(date_conducted),'-01')
ORDER BY 1,2;
;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $P_YEAR = $row['P_YEAR'];
    $P_MONTH = $row['P_MONTH'];
    $INTCOUNT = $row['INTCOUNT'];

    $return_arr[] = array($P_YEAR,$P_MONTH,$INTCOUNT);
    //$return_arr[] = array("INTCOUNT" => $INTCOUNT,"PERIOD" => $PERIOD);
	//$return_arr[] = array(strtotime($PERIOD),intval($INTCOUNT));

}

echo json_encode($return_arr);
include '../dbclose.php';
?>