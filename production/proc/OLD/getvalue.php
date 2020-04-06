<?php

    $idvalue = (isset($_REQUEST['idvalue'])?$_REQUEST['idvalue']:'');
    $idname = (isset($_REQUEST['idname'])?$_REQUEST['idname']:'');
    $table = (isset($_REQUEST['table'])?$_REQUEST['table']:'');
    $field = (isset($_REQUEST['field'])?$_REQUEST['field']:'');
    

	include '../dbconnect.php';
	//get vars

	$res_data = mysqli_query($con,"SELECT $field FROM $table where $idname='$idvalue'") or die("**failed**");
	$r 		= mysqli_fetch_row($res_data);
	$value 	= $r[0];
	echo "$value";
			
	
	mysqli_free_result($res_data);
    include '../dbclose.php';

?>