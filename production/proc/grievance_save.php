<?php

$ctrlno=isset($_REQUEST['ctrlno'])?$_REQUEST['ctrlno']:0;
$firstname=isset($_REQUEST['firstname'])?$_REQUEST['firstname']:'';
$middlename=isset($_REQUEST['middlename'])?$_REQUEST['middlename']:'';
$lastname=isset($_REQUEST['lastname'])?$_REQUEST['lastname']:'';
$ext=isset($_REQUEST['ext'])?$_REQUEST['ext']:'';
$psgc=isset($_REQUEST['psgc'])?$_REQUEST['psgc']:'';
$address=isset($_REQUEST['address'])?$_REQUEST['address']:'';
$contactno=isset($_REQUEST['contactno'])?$_REQUEST['contactno']:'';
$email=isset($_REQUEST['email'])?$_REQUEST['email']:'';
$grs_type=isset($_REQUEST['grs_subtype'])?$_REQUEST['grs_subtype']:'';
$description=isset($_REQUEST['description'])?$_REQUEST['description']:'';
$eoob=isset($_REQUEST['eoob'])?$_REQUEST['eoob']:'';
$date_reported=isset($_REQUEST['date_reported'])?$_REQUEST['date_reported']:'';
$grs_source=isset($_REQUEST['grs_source'])?$_REQUEST['grs_source']:'';
$status=isset($_REQUEST['status'])?$_REQUEST['status']:'';
$date_submitted=isset($_REQUEST['date_submitted'])?$_REQUEST['date_submitted']:'';
$date_resolved=isset($_REQUEST['date_resolved'])?$_REQUEST['date_resolved']:'';
$encoded_by=isset($_REQUEST['encoded_by'])?$_REQUEST['encoded_by']:'';
$date_encoded=isset($_REQUEST['date_encoded'])?$_REQUEST['date_encoded']:'';
$remarks=isset($_REQUEST['remarks'])?$_REQUEST['remarks']:'';
$uuid=isset($_REQUEST['uuid'])?$_REQUEST['uuid']:'';

	include '../dbconnect.php';
	
	if ($uuid==''){
		$encoded_by  = isset($_REQUEST['user_fullname'])?$_REQUEST['user_fullname']:'Anonymous';
		//insert
		//INSERT INTO `db_grs`.`grievances`(`id`,`FIRSTNAME`,`MIDDLENAME`,`LASTNAME`,`EXT`,`PSGC`,`ADDRESS`,`CONTACTNO`,`EMAIL`,`GRS_TYPE`,`DESCRIPTION`,`EOOB`,`DATE_REPORTED`,`GRS_SOURCE`,`STATUS`,`DATE_SUBMITTED`,`DATE_RESOLVED`,`ENCODED_BY`,`DATE_ENCODED`,`Remarks`) VALUES ( NULL,'JOSE','P','RIZAL',NULL,'126306015','AAAAAAA','09468841123','asdas.gooogle.com','1','dasaadadasdasd','1','2020-04-07','1','1',NULL,NULL,'1','2020-04-07','okok!');
		$sql = "INSERT INTO `db_grs`.`grievances`(`id`,`FIRSTNAME`,`MIDDLENAME`,`LASTNAME`,`EXT`,`PSGC`,`ADDRESS`,`CONTACTNO`,`EMAIL`,`GRS_TYPE`,`DESCRIPTION`,`EOOB`,`DATE_REPORTED`,`GRS_SOURCE`,`STATUS`,`DATE_SUBMITTED`,`DATE_RESOLVED`,`ENCODED_BY`,`DATE_ENCODED`,`Remarks`,`uid`) 
		VALUES ( NULL,'$firstname','$middlename','$lastname','$ext','$psgc','$address','$contactno','$email','$grs_type','$description','$eoob','$date_reported','$grs_source','$status','$date_submitted','$date_resolved','$encoded_by',now(),'$remarks',uuid());";

    	mysqli_query($con, $sql);

	}else{
		//update

		$sql = "
			UPDATE `db_grs`.`grievances`
			SET 
				firstname = '$firstname',
				middlename = '$middlename',
				lastname = '$lastname',
				ext = '$ext',
				psgc = '$psgc',
				address = '$address',
				contactno = '$contactno',
				email = '$email',
				grs_type = '$grs_type',
				description = '$description',
				eoob = '$eoob',
				date_reported = '$date_reported',
				grs_source = '$grs_source',
				status = '$status',
				date_submitted = '$date_submitted',
				date_resolved = '$date_resolved',
				encoded_by = '$encoded_by',
				date_encoded = '$date_encoded',
				remarks = '$remarks',
				uid = '$uuid'
			WHERE id = $ctrlno;

		";
		//echo "[sql: $sql]";
    	mysqli_query($con, $sql);  		
	}

	if (mysqli_affected_rows($con)>0){
		echo "**success**";
	}else{
		echo "**no-changes**";
	}


    include '../dbclose.php';

?>