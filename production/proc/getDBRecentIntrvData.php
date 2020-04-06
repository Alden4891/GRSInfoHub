<?php

include '../dbconnect.php';

$return_arr = array();

$query = "
SELECT
      `intervensions`.interv_id
    , `intervensions`.`subject`
    , `intervensions`.`details`
    , `users`.`fullname`
    , `intervensions`.`date_conducted`
FROM
    `db_imt`.`intervensions`
    INNER JOIN `db_imt`.`users` 
        ON (`intervensions`.`encoded_by` = `users`.`user_id`)
ORDER BY `intervensions`.`date_conducted` DESC
LIMIT 0, 5
;
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $interv_id = $row['interv_id'];
    $subject = $row['subject'];
    $details = $row['details'];
    $fullname = $row['fullname'];
    $date_conducted = $row['date_conducted'];


    $return_arr[] = array($interv_id,$subject,$details,$fullname,$date_conducted);
}

echo json_encode($return_arr);
include '../dbclose.php';
?>