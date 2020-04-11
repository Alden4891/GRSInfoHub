<?php

$hid_user_id=isset($_REQUEST['hid_user_id'])?$_REQUEST['hid_user_id']:0;
$ctrlno=isset($_REQUEST['hid_ctrlno'])?$_REQUEST['hid_ctrlno']:0;
$firstname=isset($_REQUEST['txtEdFirstName'])?$_REQUEST['txtEdFirstName']:'';
$middlename=isset($_REQUEST['txtEdMiddleName'])?$_REQUEST['txtEdMiddleName']:'';
$lastname=isset($_REQUEST['txtEdLastName'])?$_REQUEST['txtEdLastName']:'';
$ext=isset($_REQUEST['txtEdExt'])?$_REQUEST['txtEdExt']:'';
$psgc=isset($_REQUEST['cmbEdBarangay'])?$_REQUEST['cmbEdBarangay']:'';
$address=isset($_REQUEST['txtEdAddress'])?$_REQUEST['txtEdAddress']:'';
$contactno=isset($_REQUEST['txtEdContactNo'])?$_REQUEST['txtEdContactNo']:'';
$email=isset($_REQUEST['txtEdEmail'])?$_REQUEST['txtEdEmail']:'';
$grs_type=isset($_REQUEST['cmbEdGRSSubtype'])?$_REQUEST['cmbEdGRSSubtype']:'';
$description=isset($_REQUEST['hid_description'])?$_REQUEST['hid_description']:'';
$eoob=isset($_REQUEST['cmbEdEODB'])?$_REQUEST['cmbEdEODB']:'';
$date_reported=isset($_REQUEST['dtDateReported'])?$_REQUEST['dtDateReported']:'';
$grs_source=isset($_REQUEST['cmbEdSource'])?$_REQUEST['cmbEdSource']:'';
$status=isset($_REQUEST['cmbEdStatus'])?$_REQUEST['cmbEdStatus']:'';
$date_submitted=isset($_REQUEST['hid_date_submitted'])?$_REQUEST['hid_date_submitted']:'';
$date_resolved=isset($_REQUEST['hid_date_resolved'])?$_REQUEST['hid_date_resolved']:'';
$encoded_by=isset($_REQUEST['hid_encoded_by'])?$_REQUEST['hid_encoded_by']:'';
$date_encoded=isset($_REQUEST['hid_date_encoded'])?$_REQUEST['hid_date_encoded']:'';
$remarks=isset($_REQUEST['txtEdRemarks'])?$_REQUEST['txtEdRemarks']:'';
$uuid=isset($_REQUEST['hid_uuid'])?$_REQUEST['hid_uuid']:'';
$new_document_id = "";

	include '../dbconnect.php';
	
	if ($uuid==''){
		$uuid = uniqid();

        $res_id = mysqli_fetch_assoc(mysqli_query($con, "SELECT IFNULL(MAX(id),0)+1 AS new_id FROM grievances;"));


        
        $new_document_id = $psgc.'-'.str_pad($hid_user_id, 4, '0', STR_PAD_LEFT).str_pad($res_id['new_id'], 5, '0', STR_PAD_LEFT);

        


		$encoded_by  = isset($_REQUEST['user_fullname'])?$_REQUEST['user_fullname']:'Anonymous';
		//insert
		//INSERT INTO `db_grs`.`grievances`(`id`,`FIRSTNAME`,`MIDDLENAME`,`LASTNAME`,`EXT`,`PSGC`,`ADDRESS`,`CONTACTNO`,`EMAIL`,`GRS_TYPE`,`DESCRIPTION`,`EOOB`,`DATE_REPORTED`,`GRS_SOURCE`,`STATUS`,`DATE_SUBMITTED`,`DATE_RESOLVED`,`ENCODED_BY`,`DATE_ENCODED`,`Remarks`) VALUES ( NULL,'JOSE','P','RIZAL',NULL,'126306015','AAAAAAA','09468841123','asdas.gooogle.com','1','dasaadadasdasd','1','2020-04-07','1','1',NULL,NULL,'1','2020-04-07','okok!');
		$sql = "INSERT INTO `db_grs`.`grievances`(`id`,`docid`,`FIRSTNAME`,`MIDDLENAME`,`LASTNAME`,`EXT`,`PSGC`,`ADDRESS`,`CONTACTNO`,`EMAIL`,`GRS_TYPE`,`DESCRIPTION`,`EOOB`,`DATE_REPORTED`,`GRS_SOURCE`,`STATUS`,`DATE_SUBMITTED`,`DATE_RESOLVED`,`ENCODED_BY`,`DATE_ENCODED`,`Remarks`,`uid`) 
		VALUES ( NULL,'$new_document_id','$firstname','$middlename','$lastname','$ext','$psgc','$address','$contactno','$email','$grs_type','$description','$eoob','$date_reported','$grs_source','$status','$date_submitted','$date_resolved','$encoded_by',now(),'$remarks','$uuid');";

		echo "[$description]";

    	mysqli_query($con, $sql);
    	$new_id = mysqli_insert_id($con);
    	$res_uid = mysqli_fetch_assoc(mysqli_query($con, "SELECT uid FROM grievances WHERE id = $new_id"));
        $new_guid = $res_uid['uid'];

        //echo "files_count: ".empty($_FILES['files']);

        if (!empty($_FILES['files'])){
			$guid = $new_guid;
			$countfiles = count($_FILES['files']['name']);
			$files_arr = array();

			for($index = 0;$index < $countfiles;$index++){
			   $filename = $_FILES['files']['name'][$index];
			   $ext = pathinfo($filename, PATHINFO_EXTENSION);
			   $path = $filename;
			   $size = filesize($_FILES['files']['tmp_name'][$index]);
			   $binary = addslashes(file_get_contents($_FILES['files']['tmp_name'][$index]));
			   $mime = mime_content_type($_FILES['files']['tmp_name'][$index]);
			   $uid = uniqid();
			   $sql_attachments = "
			      INSERT INTO attachments (`data`,`filename`,`size`,`mime`,`uid`,`guid`) 
			      values ('{$binary}','$filename','{$size}','$mime','$uid','$guid');
			   ";
			   if ($filename<>""){
			   	mysqli_query($con,"$sql_attachments") or die(mysqli_error($con));
			   }
			   
			}
        }

		

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
				remarks = '$remarks'
			WHERE uid = '$uuid';

		";
    	mysqli_query($con, $sql);  		

		  //   	$new_id = mysqli_insert_id($con);
		  //   	$res_uid = mysqli_fetch_assoc(mysqli_query($con, "SELECT uid FROM grievances WHERE id = $new_id"));
		  //       $new_guid = $res_uid['uid'];
		  //$guid = $new_guid;

		if (!empty($_FILES['files'])){
			$countfiles = count($_FILES['files']['name']);
			
			//initiate upload attachments
			$files_arr = array();
			for($index = 0;$index < $countfiles;$index++){

			   $filename = $_FILES['files']['name'][$index];
			   $ext = pathinfo($filename, PATHINFO_EXTENSION);
			   $path = $filename;
			   $size = filesize($_FILES['files']['tmp_name'][$index]);
			   $binary = addslashes(file_get_contents($_FILES['files']['tmp_name'][$index]));
			   $mime = mime_content_type($_FILES['files']['tmp_name'][$index]);
			   $uid = uniqid();
			   $sql_attachments = "
			      INSERT INTO attachments (`data`,`filename`,`size`,`mime`,`uid`,`guid`) 
			      values ('{$binary}','$filename','{$size}','$mime','$uid','$uuid');
			   ";	
			   if ($filename<>""){
			   	mysqli_query($con,"$sql_attachments") or die(mysqli_error($con));
			   }
			   
			}

		}



	}

	if (mysqli_affected_rows($con)>0){
		echo "**success**|";
	}else{
		echo "**no-changes**";
	}


    include '../dbclose.php';

?>