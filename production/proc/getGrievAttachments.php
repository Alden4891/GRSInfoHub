<?php
$guid=isset($_REQUEST['guid'])?$_REQUEST['guid']:'';
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'0';
include '../dbconnect.php';

$query = "
	SELECT `id`,`filename`,`size`,`uid`,`guid` FROM attachments WHERE guid = '$guid';
";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $filename = $row['filename'];
    $size = $row['size'];

    $uid = $row['uid'];
    $guid = $row['guid'];

    $mode_link = "<a class=\"btn btn-danger btn-sm\" id=\"delete_attachment\" attachment_id=$id><i class=\"fa fa-trash\"></i></a>";
    if ($mode == 1){    //delete not allowed
        $mode_link = "";
    }

echo "
    <tr>
      <th scope=\"row\">$id</th>
      <td>$filename</td>
      <td>$size</td>
      <td>
                <a href=\"proc/blobdownload.php?attachment_id=$id\" class=\"btn btn-info btn-sm\"><i class=\"fa fa-download\"></i></a>
                $mode_link
      </td>
    </tr>
";


}


include '../dbclose.php';
?>