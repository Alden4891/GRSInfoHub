<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT 0 AS comp_id, 'total_interv' as comp_desc,COUNT(interv_id) AS `value` FROM intervensions
UNION ALL
SELECT
    `lib_comp`.comp_id
    , `lib_comp`.`comp_desc`
    , COUNT(`intervensions`.`interv_id`) AS `value`
FROM
    `db_imt`.`lib_comp`
    INNER JOIN `db_imt`.`lib_subcomp` 
        ON (`lib_comp`.`comp_id` = `lib_subcomp`.`comp_id`)
    INNER JOIN `db_imt`.`lib_programs` 
        ON (`lib_programs`.`subcomp_id` = `lib_subcomp`.`subcomp_id`)
    LEFT JOIN `db_imt`.`intervensions` 
        ON (`lib_programs`.`program_id` = `intervensions`.`program_id`)
GROUP BY `lib_comp`.`comp_desc`
ORDER BY 1;

;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $comp_id = $row['comp_id'];
    $comp_desc = $row['comp_desc'];
    $value = $row['value'];
    $return_arr[] = array($comp_id,$comp_desc,$value);


}

echo json_encode($return_arr);
include '../dbclose.php';
?>