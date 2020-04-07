<?php  
include '../dbconnect.php';
$ctrlno 		=  (isset($_REQUEST['ctrlno'])?$_REQUEST['ctrlno']:0); 

$res = mysqli_query($con, "
			SELECT
              `grievances`.`id`
            , `grievances`.`FIRSTNAME`
            , `grievances`.`MIDDLENAME`
            , `grievances`.`LASTNAME`
            , `grievances`.`EXT`
            , `lib_psgc`.`PSGC`
            , `lib_psgc`.`REGION`
            , `lib_psgc`.`PROVINCE`
            , `lib_psgc`.`MUNICIPALITY`
            , `lib_psgc`.`BARANGAY NAME`
            , `grievances`.`ADDRESS`
            , `grievances`.`CONTACTNO`
            , `grievances`.`EMAIL`
            , `lib_grstype`.`grs_type`
            , `lib_grstype`.`id` AS grs_type_id
            , `grievances`.`DESCRIPTION`
            , `grievances`.`EOOB`
            , `grievances`.id AS EODB_ID
            , `grievances`.`DATE_REPORTED`
            , `lib_grssource`.`source`
            , `lib_grssource`.`id` as 'source_id'
            , `lib_status`.`status`
            , `lib_status`.`id` as 'status_id'
            , `grievances`.`DATE_SUBMITTED`
            , `grievances`.`DATE_RESOLVED`
            , `grievances`.`ENCODED_BY` 
            , `grievances`.`DATE_ENCODED`
            , `grievances`.`Remarks`
            , `grievances`.`uid`
        FROM
            `db_grs`.`grievances`
            INNER JOIN `db_grs`.`lib_psgc` 
                ON (`grievances`.`PSGC` = `lib_psgc`.`PSGC`)
            INNER JOIN `db_grs`.`lib_grstype` 
                ON (`grievances`.`GRS_TYPE` = `lib_grstype`.`id`)
            INNER JOIN `db_grs`.`lib_grssource` 
                ON (`grievances`.`GRS_SOURCE` = `lib_grssource`.`id`)
            INNER JOIN `db_grs`.`lib_status` 
                ON (`lib_status`.`id` = `grievances`.`STATUS`)
        WHERE (`grievances`.`id` = $ctrlno)
        ;

") OR die (MYSQLI_ERROR());

  
	$r = mysqli_fetch_array($res, MYSQLI_ASSOC);

			$id=$r['id'];
			$firstname=$r['FIRSTNAME'];	
			$middlename=$r['MIDDLENAME'];
			$lastname=$r['LASTNAME'];
			$ext=$r['EXT'];
			$psgc=$r['PSGC'];
			$region=$r['REGION'];
			$province=$r['PROVINCE'];
			$municipality=$r['MUNICIPALITY'];
			$barangayname=$r['BARANGAYNAME'];
			$address=$r['ADDRESS'];
			$contactno=$r['CONTACTNO'];
			$email=$r['EMAIL'];
			$grs_type=$r['grs_type'];
			$description=$r['DESCRIPTION'];
			$eoob=$r['EOOB'];
			$date_reported=$r['DATE_REPORTED'];
			$source=$r['source'];
			$status=$r['status'];
			$date_submitted=$r['DATE_SUBMITTED'];
			$date_resolved=$r['DATE_RESOLVED'];
			$ENCODED_BY=$r['ENCODED_BY'];
			$date_encoded=$r['DATE_ENCODED'];
			$remarks=$r['Remarks'];

			$grs_type_id=$r['grs_type_id'];
			$EODB_ID=$r['EODB_ID'];
			$source_id = $r['source_id'];
            $status_id = $r['status_id'];
            $uuid = $r['uid'];

	echo "$id|$firstname|$middlename|$lastname|$ext|$psgc|$region|$province|$municipality|$barangayname|$contactno|$email|$grs_type|$description|$eoob|$date_reported|$source|$status|$date_submitted|$date_resolved|$ENCODED_BY|$date_encoded|$remarks|$address|$grs_type_id|$EODB_ID|$source_id|$status_id|$uuid";


include '../dbclose.php';
?>


