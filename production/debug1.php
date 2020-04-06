<?php
$html = "<b>sample interv</b><div><ul><li>the quick brow fox jumps over the lazy dog near the riover bank!</li><li>john smith is a gay</li><li>who is john gult</li><li>therer is no spoon</li><li><strike>greed is good</strike></li><li>have some foccee</li></ul></div>";

$data = htmlToText($html);
echo "$data<hr>";

//html to string
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
?>