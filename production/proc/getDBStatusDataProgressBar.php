<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT 0 AS 'id', 'total_griev' AS `status`, COUNT(id) AS `value` FROM grievances
UNION ALL
SELECT
    `lib_status`.`id`
    , `lib_status`.`status`
    , COUNT(`grievances`.`id`) AS `value`
FROM
    `db_grs`.`grievances`
    RIGHT JOIN `db_grs`.`lib_status` 
        ON (`grievances`.`status` = `lib_status`.`id`)
GROUP BY `lib_status`.`id`, `lib_status`.`status`;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $status = $row['status'];
    $value = $row['value'];
    $return_arr[] = array($id,$status,$value);


}

echo json_encode($return_arr);
include '../dbclose.php';
?>