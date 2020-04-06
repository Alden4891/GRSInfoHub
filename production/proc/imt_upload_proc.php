<?php
require_once('../udf/udf.php');
include '../dbconnect.php';

$countfiles = count($_FILES['files']['name']);


// Upload directory
$upload_location = "../uploads/";

// To store uploaded files path
$files_arr = array();



// Loop all files
$files = array();
$log = "";
for($index = 0;$index < $countfiles;$index++){
   // File name
   $filename = $_FILES['files']['name'][$index];
   // Get extension
   $ext = pathinfo($filename, PATHINFO_EXTENSION);

   // Valid image extension
   $valid_ext = array("imt");

   // Check extension

   $entry_count = 0;
   $success_count = 0;
   $exists_count = 0;
   if(in_array($ext, $valid_ext)){
        $file = decode_arr(file_get_contents($_FILES['files']['tmp_name'][$index]));
        
        foreach ($file as $value) {
            $entry_count++;

            $interv_id      = $value[0];
            $subject        = $value[1];
            $details        = $value[2];
            $date_conducted = $value[3];
            $yds_child_count= $value[4];
            $program_id     = $value[5];
            $household_id   = $value[6];
            $encoded_by     = $value[7];
            $date_encoded   = $value[8];
            $modified_by    = $value[9];
            $date_modified  = $value[10];
            $uid            = $value[11];

        

            $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS isEXISTS FROM intervensions WHERE uid = '$uid';"));
            if ($data['isEXISTS']==0){
                $sql = "INSERT INTO `db_imt`.`intervensions`(`interv_id`,`subject`,`details`,`date_conducted`,`yds_child_count`,`program_id`,`HOUSEHOLD_ID`,`encoded_by`,`date_encoded`,`modified_by`,`date_modified`,`uid`) 
                        VALUES ( NULL,'$subject','$details','$date_encoded','$yds_child_count','$program_id','$household_id','$encoded_by','$date_encoded','$modified_by','$date_modified','$uid');";
                
                mysqli_query($con,$sql) or die('**error**');
                $success_count++;
            }else{
                $exists_count++;
            }
        }
   }

      $log .= "<B>Filename</B>: $filename";
      $log .= "<br><B>Number of Entry</B>: $entry_count";
      $log .= "<br><B>Successful </B>: $success_count";
      $log .= "<br><B>Already Exists </B>: $exists_count<br><br>";


}
    echo "$log <h3><b>Finished!<b></h3>";      
include '../dbclose.php';
   // print_r($files);
//echo json_encode($files_arr);
//die;

?>