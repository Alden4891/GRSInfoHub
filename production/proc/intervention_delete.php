<?php




	$interv_id=isset($_REQUEST['interv_id'])?$_REQUEST['interv_id']:'';



	include '../dbconnect.php';


    	mysqli_query($con, "DELETE FROM intervensions WHERE interv_id = $interv_id;");  		
	
		if (mysqli_affected_rows($con)>0){
			echo "**success**";
		}else{
			echo "**no-changes**";
		}


    include '../dbclose.php';

?>