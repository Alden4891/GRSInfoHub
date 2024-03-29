<?php  
include '../dbconnect.php';
$guid 		=  (isset($_REQUEST['guid'])?$_REQUEST['guid']:0); 

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
            , `lib_psgc`.`BARANGAY`

            , `grievances`.`ADDRESS`
            , `grievances`.`CONTACTNO`
            , `grievances`.`EMAIL`
            , `lib_grssubtype`.subtype
            , `lib_grssubtype`.`id` AS grs_subtype_id
            
            , `lib_grstype`.grs_type
            , `lib_grstype`.`id` AS grs_type_id
            , `grievances`.`DESCRIPTION`
            , `lib_eoob`.`eoob` AS 'EOOB'
            , `grievances`.`EOOB` AS EODB_ID

            , `grievances`.`DATE_REPORTED`
            , `lib_grssource`.`source`
            , `lib_grssource`.`id` AS 'source_id'
            , `lib_status`.`status`
            , `lib_status`.`id` AS 'status_id'

            , `grievances`.`DATE_SUBMITTED`
            , `grievances`.`DATE_MODIFIED`
            , `grievances`.`ENCODED_BY` 
            , `grievances`.`DATE_ENCODED`
            , `grievances`.`Remarks`

            , `grievances`.`uid`
            , `grievances`.`MODIFIED_BY`
 
            , `grievances`.`act_taken`
            , `grievances`.`act_date`
            , `grievances`.`res_date`
            , `grievances`.`res_description`
            , `grievances`.`fed_date`

 

        FROM
            `db_grs`.`grievances`
            INNER JOIN `db_grs`.`lib_psgc` 
                ON (`grievances`.`PSGC` = `lib_psgc`.`PSGC`)
            INNER JOIN `db_grs`.`lib_grssubtype`
                ON (`grievances`.`GRS_TYPE` = `lib_grssubtype`.`id`)
            INNER JOIN `db_grs`.`lib_grstype`
                ON (`lib_grstype`.`id` = `grievances`.`grs_cat`)
            INNER JOIN `db_grs`.`lib_grssource` 
                ON (`grievances`.`GRS_SOURCE` = `lib_grssource`.`id`)
            INNER JOIN `db_grs`.`lib_eoob` 
                ON (`grievances`.`EOOB` = `lib_eoob`.`id`)
            INNER JOIN `db_grs`.`lib_status` 
                ON (`lib_status`.`id` = `grievances`.`STATUS`)
        WHERE (`grievances`.`uid` = '$guid')
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
			$barangayname=$r['BARANGAY'];
			
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
			
            $date_modified=$r['DATE_MODIFIED'];
			$ENCODED_BY=$r['ENCODED_BY'];
			$date_encoded=$r['DATE_ENCODED'];
			$remarks=$r['Remarks'];
			$grs_type_id=$r['grs_type_id'];

			$EODB_ID=$r['EODB_ID'];
			$source_id = $r['source_id'];
            $status_id = $r['status_id'];
            $uuid = $r['uid'];
            $grs_subtype_id = $r['grs_subtype_id'];

            $subtype = $r['subtype'];
            $modified_by = $r['MODIFIED_BY'];           //31

            $act_taken       = $r['act_taken'];         //32
            $act_date        = $r['act_date'];          //33
            $res_date        = $r['res_date'];          //34
            $res_description = $r['res_description'];   //35
            $fed_date        = $r['fed_date'];          //36


    $data =  "$id|$firstname|$middlename|$lastname|$ext|";
    $data .= "$psgc|$region|$province|$municipality|$barangayname|";
    $data .= "$contactno|$email|$grs_type|$description|$eoob|";
    $data .= "$date_reported|$source|$status|$date_submitted|$date_modified|";
    $data .= "$ENCODED_BY|$date_encoded|$remarks|$address|$grs_type_id|";
    $data .= "$EODB_ID|$source_id|$status_id|$uuid|$grs_subtype_id|";
    $data .= "$subtype|$modified_by|$act_taken|$act_date|$res_date|";
    $data .= "$res_description|$fed_date|";


	echo $data;


include '../dbclose.php';
?>


