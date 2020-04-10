<?php
$guid=isset($_REQUEST['guid'])?$_REQUEST['guid']:'';
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


echo "
    <tr>
      <th scope=\"row\">$id</th>
      <td>$filename</td>
      <td>$size</td>
      <td>
                <a href=\"proc/blobdownload.php?attachment_id=$id\" class=\"btn btn-info btn-sm\"><i class=\"fa fa-download\"></i></a>
                <a class=\"btn btn-danger btn-sm\" id=\"delete_attachment\" attachment_id=$id><i class=\"fa fa-trash\"></i></a>
      </td>
    </tr>
";


}


include '../dbclose.php';
?>