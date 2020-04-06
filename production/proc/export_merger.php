<?php


  require_once('../udf/udf.php');
  include '../dbconnect.php';

$res_intvlist = mysqli_query($con, "SELECT * FROM intervensions") or die(mysqli_error());

download_send_headers("data_export_" . date("Y-m-d") . ".imt");
$data = mysqli_fetch_all($res_intvlist);
$encode_arr = encode_arr($data);
//$decode_arr = decode_arr($encode_arr);

mysqli_free_result($res_intvlist);
echo "$encode_arr";
include '../dbclose.php';



function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}


?>