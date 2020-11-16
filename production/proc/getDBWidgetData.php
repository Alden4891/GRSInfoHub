<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT 0 AS id, 'total_interv' AS grs_type,COUNT(id) AS `value` FROM grievances
UNION ALL
SELECT
    `lib_grstype`.`id`
    , `lib_grstype`.`grs_type`
    , COUNT(`grievances`.`id`) AS `value`
FROM
    `db_grs`.`grievances`
    LEFT JOIN `db_grs`.`lib_grstype` 
        ON (`grievances`.`GRS_TYPE` = `lib_grstype`.`id`)
GROUP BY `lib_grstype`.`id`, `lib_grstype`.`grs_type`;
;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $grs_type = $row['grs_type'];
    $value = $row['value'];
    $return_arr[] = array($id,$grs_type,$value);
}

echo json_encode($return_arr);
include '../dbclose.php';
?>