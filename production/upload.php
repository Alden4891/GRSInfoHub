<?php
$countfiles = count($_FILES['files']['name']);
$upload_location = "uploads/";
$files_arr = array();

for($index = 0;$index < $countfiles;$index++){
   $filename = $_FILES['files']['name'][$index];
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   $path = $filename;
   $size = filesize($_FILES['files']['tmp_name'][$index]);
   $file = addslashes(file_get_contents($_FILES['files']['tmp_name'][$index]));

   //mysqli_query($con,"UPDATE users SET picture = '{$image}', picture_size='{$size[3]}', picture_type='{$size['mime']}' WHERE user_id = $user_id");

echo "$file | $ext | $size <br>";
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

//echo json_encode($files_arr);
die;