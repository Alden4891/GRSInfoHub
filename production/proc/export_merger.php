<?php


  require_once('../udf/udf.php');
  include '../dbconnect.php';

$res_data = mysqli_query($con, "SELECT * FROM grievances;") or die(mysqli_error());
$res_attachments = mysqli_query($con, "SELECT * FROM attachments;") or die(mysqli_error());

download_send_headers("data_export_" . date("Y-m-d") . ".grs");
$data = mysqli_fetch_all($res_data);
$attachments = mysqli_fetch_all($res_attachments);

$enc_data = encode_arr($data);
$enc_attachments = encode_arr($attachments);

//$decode_arr = decode_arr($encode_arr);

mysqli_free_result($res_data);
mysqli_free_result($res_attachments);

echo "$enc_data|$enc_attachments";
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