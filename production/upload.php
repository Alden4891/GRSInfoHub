<?php

    include 'dbconnect.php';

$guid = "sample_uuid1";
$countfiles = count($_FILES['files']['name']);
$files_arr = array();

for($index = 0;$index < $countfiles;$index++){
   $filename = $_FILES['files']['name'][$index];
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   $path = $filename;
   $size = filesize($_FILES['files']['tmp_name'][$index]);
   $binary = addslashes(file_get_contents($_FILES['files']['tmp_name'][$index]));
   $mime = mime_content_type($_FILES['files']['tmp_name'][$index]);
   $uid = uniqid();
   $sql = "
      INSERT INTO attachments (`data`,`filename`,`size`,`mime`,`uid`,`guid`) 
      values ('{$binary}','$filename','{$size}','$mime','$uid','$guid');
   ";

   echo "$filename | $ext | $size | $mime ";
   //mysqli_query($con,"$sql") or die(mysqli_error($con));

   // mysqli_query($con,"UPDATE users SET picture = '{$image}', picture_size='{$size[3]}', picture_type='{$size['mime']}' WHERE user_id = $user_id");

   // echo "$binary | $mime | $size | $filename<br>";
   // Valid image extension
 //  $valid_ext = array("png","jpeg","jpg");

   // Check extension
  // if(in_array($ext, $valid_ext)){

     // File path

     // Upload file
     // if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
     //    $files_arr[] = $path;
     // }
  // }

}
          include 'dbclose.php';

//echo json_encode($files_arr);
die;