<?php
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
//CLEAR SWDI
mysqli_query($con,"TRUNCATE TABLE `db_imt`.`swdi`;");
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

                  if ($Row[0] <> "HOUSEHOLD_ID" || $Row[54] <> "LOWB" || $columns_count <> 54){
                      die('**invalidswdifile**');
                  }


              }else{

                  $household_id=mysqli_real_escape_string($con,$Row[0]);
                  $lastname=mysqli_real_escape_string($con,$Row[1]);
                  $firstname=mysqli_real_escape_string($con,$Row[2]);
                  $middlename=mysqli_real_escape_string($con,$Row[3]);
                  $ext=mysqli_real_escape_string($con,$Row[4]);
                  $psgc_region=mysqli_real_escape_string($con,$Row[5]);
                  $psgc_province=mysqli_real_escape_string($con,$Row[6]);
                  $psgc_city=mysqli_real_escape_string($con,$Row[7]);
                  $psgc_brgy=mysqli_real_escape_string($con,$Row[8]);
                  $es1=mysqli_real_escape_string($con,$Row[9]);
                  $es2=mysqli_real_escape_string($con,$Row[10]);
                  $c1=mysqli_real_escape_string($con,$Row[11]);
                  $c2=mysqli_real_escape_string($con,$Row[12]);
                  $c3=mysqli_real_escape_string($con,$Row[13]);
                  $c4=mysqli_real_escape_string($con,$Row[14]);
                  $total income=mysqli_real_escape_string($con,$Row[15]);
                  $family size=mysqli_real_escape_string($con,$Row[16]);
                  $pc_inc=mysqli_real_escape_string($con,$Row[17]);
                  $mpc_inc=mysqli_real_escape_string($con,$Row[18]);
                  $mppc_pov_treshold=mysqli_real_escape_string($con,$Row[19]);
                  $mppc_food_threshold=mysqli_real_escape_string($con,$Row[20]);
                  $es3=mysqli_real_escape_string($con,$Row[21]);
                  $es4=mysqli_real_escape_string($con,$Row[22]);
                  $econsuff=mysqli_real_escape_string($con,$Row[23]);
                  $hcs1=mysqli_real_escape_string($con,$Row[24]);
                  $hcs2=mysqli_real_escape_string($con,$Row[25]);
                  $hcs=mysqli_real_escape_string($con,$Row[26]);
                  $nc1=mysqli_real_escape_string($con,$Row[27]);
                  $nc2=mysqli_real_escape_string($con,$Row[28]);
                  $nc=mysqli_real_escape_string($con,$Row[29]);
                  $wcs1=mysqli_real_escape_string($con,$Row[30]);
                  $wcs2=mysqli_real_escape_string($con,$Row[31]);
                  $wcs3=mysqli_real_escape_string($con,$Row[32]);
                  $wcs=mysqli_real_escape_string($con,$Row[33]);
                  $sa1=mysqli_real_escape_string($con,$Row[34]);
                  $hc1=mysqli_real_escape_string($con,$Row[35]);
                  $hc2=mysqli_real_escape_string($con,$Row[36]);
                  $hc3=mysqli_real_escape_string($con,$Row[37]);
                  $hc4=mysqli_real_escape_string($con,$Row[38]);
                  $sa2=mysqli_real_escape_string($con,$Row[39]);
                  $ec1=mysqli_real_escape_string($con,$Row[40]);
                  $ec2=mysqli_real_escape_string($con,$Row[41]);
                  $sa3=mysqli_real_escape_string($con,$Row[42]);
                  $rp1=mysqli_real_escape_string($con,$Row[43]);
                  $rp2=mysqli_real_escape_string($con,$Row[44]);
                  $rp3=mysqli_real_escape_string($con,$Row[45]);
                  $sa4=mysqli_real_escape_string($con,$Row[46]);
                  $fa1=mysqli_real_escape_string($con,$Row[47]);
                  $fa2=mysqli_real_escape_string($con,$Row[48]);
                  $fa3=mysqli_real_escape_string($con,$Row[49]);
                  $sa5=mysqli_real_escape_string($con,$Row[50]);
                  $socadeq=mysqli_real_escape_string($con,$Row[51]);
                  $swdi_score=mysqli_real_escape_string($con,$Row[52]);
                  $lowb=mysqli_real_escape_string($con,$Row[53]);




                 $sql = "INSERT INTO swdi values ('$household_id','$lastname','$firstname','$middlename','$ext','$psgc_region','$psgc_province','$psgc_city','$psgc_brgy','$es1','$es2','$c1','$c2','$c3','$c4','$total income','$family size','$pc_inc','$mpc_inc','$mppc_pov_treshold','$mppc_food_threshold','$es3','$es4','$econsuff','$hcs1','$hcs2','$hcs','$nc1','$nc2','$nc','$wcs1','$wcs2','$wcs3','$wcs','$sa1','$hc1','$hc2','$hc3','$hc4','$sa2','$ec1','$ec2','$sa3','$rp1','$rp2','$rp3','$sa4','$fa1','$fa2','$fa3','$sa5','$socadeq','$swdi_score','$lowb');";

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