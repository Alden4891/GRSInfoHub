<?php
ini_set('mbstring.internal_encoding', 'windows-1251');
ini_set('max_execution_time', '6000');
ini_set('post_max_size', '5000M');
error_reporting(E_ERROR | E_PARSE);
include '../dbconnect.php';
require_once('../../vendors/excel-reader/php-excel-reader/excel_reader2.php');
require_once('../../vendors/excel-reader/SpreadsheetReader.php');

echo "Processing your request<br>Please wait...<br><br>";
$countfiles = count($_FILES['files']['name']);

// Upload directory
$upload_location = "../uploads/";

// To store uploaded files path
$files_arr = array();

// Loop all files
$files = array();
$log = "";

mysqli_query($con,"TRUNCATE TABLE `db_imt`.`roster`;");
for($index = 0;$index < $countfiles;$index++){
   $sheet_row_counter = 0;
   // File name
   $filename = $_FILES['files']['name'][$index];
   // Get extension
   $ext = pathinfo($filename, PATHINFO_EXTENSION);

   // Valid image extension
   $valid_ext = array("xlsx");

   // Check extension
   $entry_count = 0;
   $success_count = 0;
   $exists_count = 0;

   //CLEAR ROSTER
   

   if(in_array($ext, $valid_ext)){
      $entry_count++;

      $targetPath = '../uploads/'.$_FILES['files']['name'][$index];
      move_uploaded_file($_FILES['files']['tmp_name'][$index], $targetPath);

      //read the content of excel
      $Reader = new SpreadsheetReader($targetPath);

      $sheetCount = 1;// count($Reader->sheets());
      $sql = "";
      for($i=0;$i<$sheetCount;$i++){
          $sql = "";
          $Reader->ChangeSheet($i);
          
          $sheet_row_count = count($Reader);
          $columns_count = 0;
         
         // print_r($Reader);

          foreach ($Reader as $Row){
              $sheet_row_counter++;

              //count the number of columns
              if ($sheet_row_counter == 1) { //check if header
                  foreach ($Row as $Cell) {
                    if (isset($Cell)){
                        if (!empty($Cell)){
                          $columns_count++;
                        }
                    }
                  }

                  if ($Row[6] <> "HOUSEHOLD_ID" || $Row[7] <> "ENTRY_ID" || $columns_count <> 35){
                      die('**invalidrosterfile**');
                  }


              }else{
                $region=mysqli_real_escape_string($con,$Row[0]);
                $province=mysqli_real_escape_string($con,$Row[1]);
                $municipality=mysqli_real_escape_string($con,$Row[2]);
                $barangay=mysqli_real_escape_string($con,$Row[3]);
                $purok=mysqli_real_escape_string($con,$Row[4]);
                $address=mysqli_real_escape_string($con,$Row[5]);
                $household_id=mysqli_real_escape_string($con,$Row[6]);
                $entry_id=mysqli_real_escape_string($con,$Row[7]);
                $last_name=mysqli_real_escape_string($con,$Row[8]);
                $first_name=mysqli_real_escape_string($con,$Row[9]);
                $mid_name=mysqli_real_escape_string($con,$Row[10]);
                $ext_name=mysqli_real_escape_string($con,$Row[11]);
                $hh_grantee=mysqli_real_escape_string($con,$Row[12]);
                $child_bene=mysqli_real_escape_string($con,$Row[13]);
                $monitored_educ=mysqli_real_escape_string($con,$Row[14]);
                $birthday=mysqli_real_escape_string($con,stdDate($Row[15]));
                $age=mysqli_real_escape_string($con,$Row[16]);
                $rel_hh=mysqli_real_escape_string($con,$Row[17]);
                $sex=mysqli_real_escape_string($con,$Row[18]);
                $pregnant_status=mysqli_real_escape_string($con,$Row[19]);
                $disabled=mysqli_real_escape_string($con,$Row[20]);
                $attend_school=mysqli_real_escape_string($con,$Row[21]);
                $reason_for_not_attending=mysqli_real_escape_string($con,$Row[22]);
                $date_reason=""; //mysqli_real_escape_string($con,stdDate($Row[23]));
                $grade_level=mysqli_real_escape_string($con,$Row[24]);
                $school_name=mysqli_real_escape_string($con,$Row[25]);
                $dominant_school=mysqli_real_escape_string($con,$Row[26]);
                $hc_name=mysqli_real_escape_string($con,$Row[27]);
                $registered=mysqli_real_escape_string($con,$Row[28]);
                $client_status=mysqli_real_escape_string($con,$Row[29]);
                $member_status=mysqli_real_escape_string($con,$Row[30]);
                $ip_affiliation=mysqli_real_escape_string($con,$Row[31]);
                $mode_of_payment=mysqli_real_escape_string($con,$Row[32]);
                $hh_set=mysqli_real_escape_string($con,$Row[33]);
                $set_group=mysqli_real_escape_string($con,$Row[34]);



                 $sql = "INSERT INTO roster values ('$region','$province','$municipality','$barangay','$purok','$address','$household_id','$entry_id','$last_name','$first_name','$mid_name','$ext_name','$hh_grantee','$child_bene','$monitored_educ','$birthday','$age','$rel_hh','$sex','$pregnant_status','$disabled','$attend_school','$reason_for_not_attending','$date_reason','$grade_level','$school_name','$dominant_school','$hc_name','$registered','$client_status','$member_status','$ip_affiliation','$mode_of_payment','$hh_set','$set_group');";

                   $sql = str_replace("''", "null", $sql);

                 //die($sql);

                 if (!empty($household_id)){
                    mysqli_query($con,$sql);
                   if ($sheet_row_counter%2345==0){
                     //$progress = round($sheet_row_counter/$sheet_row_count * 100,2);
                     //echo "$sql<br><br>";
                     echo "[$filename] Completed rows: $sheet_row_counter <br>";
                     //usleep(100 * 1000); //10 milliseconds
                     flush();
                     ob_flush();                 
                    }

                 }else{
                     //echo "**no data @ Row $sheet_row_counter**<br>";
                     //flush();
                     //ob_flush(); 
                     break;
                     //die("EOF");                
                 }

              }





              // $household_id = "";
              // $with_value_count = 0;
              // if(isset($Row[6])) {
              //     $household_id = mysqli_real_escape_string($con,$Row[6]);
              //     $with_value_count++;
              // }
              
              // $entry_id = "";
              // if(isset($Row[7])) {
              //     $entry_id = mysqli_real_escape_string($con,$Row[7]);
              //     $with_value_count++;
              // }
              
              // $query = "insert into tbl_info(name,description) values('".$name."','".$description."')";
              // $result = mysqli_query($con, $query);
          
              // if (! empty($result)) {
              //     $type = "success";
              //     $message = "Excel Data Imported into the Database";
              // } else {
              //     $type = "error";
              //     $message = "Problem in Importing Excel Data";
              // }



  
  
              
           }
      
       }


   }

   $log .= "<br><br><B>Filename</B>: $filename";
   $log .= "<br><B>Number of Entry</B>: $sheet_row_counter";


}
    echo "$log <h4><b>Finished!<b></h4>";      
    include '../dbclose.php';

function stdDate($date){
  if (empty($date)){
    return '';
  }else if (is_numeric($date)){
    $UNIX_DATE = (intval($date) - 25569) * 86400;
    //echo "<br>->$date<br>";
    return gmdate("Y-m-d", $UNIX_DATE);
  }else{
      $arr = explode("-",$date);
      $year =  $arr[2];
      $day =  $arr[1];
      $month =  $arr[0];
      return date('Y-m-d',strtotime("$year-$month-$day"));    
  }

}
?>