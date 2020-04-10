<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT
    `id`
    , `DESCRIPTION`
    , `ENCODED_BY`
    , `DATE_REPORTED`
    , `uid`
FROM
    `db_grs`.`grievances`
ORDER BY `DATE_REPORTED` DESC
LIMIT 0, 5
;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $ID = $row['id'];
    $DESCRIPTION = strip_tags($row['DESCRIPTION']);
    $ENCODED_BY = $row['ENCODED_BY'];
    $DATE_REPORTED = $row['DATE_REPORTED'];
    $guid = $row['uid'];

    $return_arr[] = array($ID,$DESCRIPTION,$ENCODED_BY,$DATE_REPORTED,$guid);
}

echo json_encode($return_arr);
include '../dbclose.php';
?>