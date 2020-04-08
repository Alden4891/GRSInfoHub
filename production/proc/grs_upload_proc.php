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
   $valid_ext = array("grs");

   // Check extension

   $entry_count = 0;
   $success_count = 0;
   $exists_count = 0;
   if(in_array($ext, $valid_ext)){
        $file = decode_arr(file_get_contents($_FILES['files']['tmp_name'][$index]));
        
        foreach ($file as $value) {
            $entry_count++;

            $firstname = $value[1];
            $middlename = $value[2];
            $lastname = $value[3];
            $ext = $value[4];
            $psgc = $value[5];
            $address = $value[6];
            $contactno = $value[7];
            $email = $value[8];
            $grs_type = $value[9];
            $description = $value[10];
            $eoob = $value[11];
            $date_reported = $value[12];
            $grs_source = $value[13];
            $status = $value[14];
            $date_submitted = $value[15];
            $date_resolved = $value[16];
            $encoded_by = $value[17];
            $date_encoded = $value[18];
            $remarks = $value[19];
            $uid = $value[20];

        

            $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS isEXISTS FROM grievances WHERE uid = '$uid';"));
            if ($data['isEXISTS']==0){
                $sql = "INSERT INTO `db_grs`.`grievances`(`id`,`FIRSTNAME`,`MIDDLENAME`,`LASTNAME`,`EXT`,`PSGC`,`ADDRESS`,`CONTACTNO`,`EMAIL`,`GRS_TYPE`,`DESCRIPTION`,`EOOB`,`DATE_REPORTED`,`GRS_SOURCE`,`STATUS`,`DATE_SUBMITTED`,`DATE_RESOLVED`,`ENCODED_BY`,`DATE_ENCODED`,`Remarks`,`uid`) 
    VALUES ( NULL,'$firstname','$middlename','$lastname','$ext','$psgc','$address','$contactno','$email','$grs_type','$description','$eoob','$date_reported','$grs_source','$status','$date_submitted','$date_resolved','$encoded_by',now(),'$remarks','$uid');";
                
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