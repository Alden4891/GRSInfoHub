<?php
	$attachment_id=isset($_REQUEST['attachment_id'])?$_REQUEST['attachment_id']:'';
	include '../dbconnect.php';
    	mysqli_query($con, "DELETE FROM attachments WHERE id = $attachment_id;");  		
		if (mysqli_affected_rows($con)>0){
			echo "**success**";
		}else{
			echo "**no-changes**";
		}
    include '../dbclose.php';

?>