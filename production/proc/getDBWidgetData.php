<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT 0 AS `subcomp_id`,'total_ineterv' AS subcomp,COUNT(*) AS `value` FROM intervensions
UNION ALL
SELECT sc.subcomp_id,sc.subcomp, COUNT(i.interv_id) AS `value` FROM lib_subcomp sc
INNER JOIN lib_programs p ON sc.subcomp_id = p.subcomp_id
LEFT JOIN intervensions i ON i.program_id = p.program_id
GROUP BY sc.subcomp_id;
;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $subcomp_id = $row['subcomp_id'];
    $subcomp = $row['subcomp'];
    $value = $row['value'];
    $return_arr[] = array($subcomp_id,$subcomp,$value);
}

echo json_encode($return_arr);
include '../dbclose.php';
?>