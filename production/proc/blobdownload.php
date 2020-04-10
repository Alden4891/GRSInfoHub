<?php

$file_id=isset($_REQUEST['attachment_id'])?$_REQUEST['attachment_id']:'-1';
include '../dbconnect.php';

$result = mysqli_query($con,"SELECT `filename`,`data`,`size`,`mime` FROM attachments WHERE id = $file_id;");

while($row = mysqli_fetch_array($result)){

    $filename = $row['filename'];
    $size = $row['size'];
    $data = $row['data'];
    $mime = $row['mime'];

    header("Content-type: $mime");
    header("Content-length: $size");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Description: PHP Generated Data");



    echo $data;


}





include '../dbclose.php';



?>