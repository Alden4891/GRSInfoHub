<?php
function htmlToText($htm){

    $htm =  str_replace("<br>", "", $htm);
    $htm =  str_replace("<li>", "\t", $htm);
    $htm =  str_replace("</li>", "\n", $htm);

    $htm =  str_replace("/", "", $htm);

    $htm =  str_replace("<div>", "\n", $htm);

    $htm =  str_replace("<ul>", "\n", $htm);
    $htm =  str_replace("<ol>", "", $htm);
    $htm =  str_replace("<i>", "", $htm);
    $htm =  str_replace("<b>", "", $htm);
    $htm =  str_replace("<u>", "", $htm);
    $htm =  str_replace("<strike>", "", $htm);

    $data = nl2br($htm);
    $data = str_replace("\r", "", $data);
    $data = str_replace("\n", "", $data);
    $data = str_replace("<br>", "\n", $data); 

    return $data;
}

function encode_arr($data) {
    return base64_encode(serialize($data));
}

function decode_arr($data) {
    return unserialize(base64_decode($data));
}

function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}
?>