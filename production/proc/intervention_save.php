<?php

	$subject=isset($_REQUEST['subject'])?$_REQUEST['subject']:'';
	$details=isset($_REQUEST['details'])?$_REQUEST['details']:'';
	$date_conducted=isset($_REQUEST['date_conducted'])?$_REQUEST['date_conducted']:'';
	$yds_child_count=isset($_REQUEST['yds_child_count'])?$_REQUEST['yds_child_count']:'';
	$program_id=isset($_REQUEST['program_id'])?$_REQUEST['program_id']:'';
	$HOUSEHOLD_ID=isset($_REQUEST['HOUSEHOLD_ID'])?$_REQUEST['HOUSEHOLD_ID']:'';
	$interv_id=isset($_REQUEST['interv_id'])?$_REQUEST['interv_id']:'';
	$user_id=isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';


	include '../dbconnect.php';

	if ($interv_id==0){
		//insert
    	mysqli_query($con, "INSERT INTO intervensions (`subject`,`details`,`date_conducted`,`yds_child_count`,`program_id`,`HOUSEHOLD_ID`,`encoded_by`,`date_encoded`,`uid`) 
    		                VALUES ('$subject','$details','$date_conducted','$yds_child_count','$program_id','$HOUSEHOLD_ID','$user_id',now(),uuid());");  		
	}else{
		//update
    	mysqli_query($con, "
			UPDATE intervensions
			SET SUBJECT = '$subject',
			  details = '$details',
			  date_conducted = '$date_conducted',
			  yds_child_count = '$yds_child_count',
			  program_id = '$program_id',
			  HOUSEHOLD_ID = '$HOUSEHOLD_ID',
			  modified_by = $user_id,
			  date_modified = now()
			WHERE interv_id = $interv_id;
    	");  		
	}

	if (mysqli_affected_rows($con)>0){

	//display resut if success!
	$res = mysqli_query($con, "
		SELECT
		  i.interv_id,
		  i.subject,
		  p.program,
		  s.subcomp,
		  i.date_conducted,
	   CONCAT(LPAD(c.comp_id,2,0),LPAD(s.subcomp_id,2,0), LPAD(p.program_id,2,0), LPAD(i.interv_id,2,0)) AS ctrlno
		FROM intervensions i
		  INNER JOIN lib_programs p
		    ON i.program_id = p.program_id
		  INNER JOIN lib_subcomp s
		    ON s.subcomp_id = p.subcomp_id
		  INNER JOIN lib_comp c
		    ON c.comp_id = s.comp_id
		WHERE HOUSEHOLD_ID = '$HOUSEHOLD_ID'
		ORDER BY date_conducted DESC;
	") OR die (MYSQLI_ERROR());



	while ($r = mysqli_fetch_array($res, MYSQLI_ASSOC)){
		$interv_id = sprintf('%08d', $r['interv_id']);
		$subject = $r['subject'];
		$program = $r['program'];
		$subcomp = $r['subcomp'];
		$date_conducted = $r['date_conducted'];
		$ctrlno = $r['ctrlno'];

		echo "
	        <tr>
	          <td>$ctrlno</td>
	          <td>$subject</td>
	          <td>$program</td>
	          <td>$subcomp</td>
	          <td>$date_conducted</td>
	          <td>
				<button type=\"button\" class=\"btn btn-default btn-xs\" aria-label=\"Left Align\" data-toggle=\"modal\" data-target=\"#interv_list_editor_modal\" hhid=\"$HOUSEHOLD_ID\" interv_id=\"$interv_id\" id=btn_interv_list_editor_open ctrlno=$ctrlno>
				  <span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span>
				</button>
				<button type=\"button\" class=\"btn btn-danger btn-xs\" aria-label=\"Left Align\" id=\"btn_delete_intervention\" interv_id=\"$interv_id\" disabled>
				  <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>
				</button>

			  </td>
	        </tr>


		";


	}



		echo "**success**";
	}else{
		echo "**no-changes**";
	}


    include '../dbclose.php';

?>