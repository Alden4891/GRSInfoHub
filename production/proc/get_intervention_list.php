<?php  
include '../dbconnect.php';
$hhid 		=  (isset($_REQUEST['hhid'])?$_REQUEST['hhid']:'no-data'); 

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
	WHERE HOUSEHOLD_ID = '$hhid'
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
          <td>$program</td>
          <td>$subcomp</td>
          <td>$subject</td>
          <td>$date_conducted</td>
          <td>
			<button type=\"button\" class=\"btn btn-info btn-xs\" aria-label=\"Left Align\" data-toggle=\"modal\" data-target=\"#interv_list_editor_modal\" hhid=\"$hhid\" interv_id=\"$interv_id\" id=btn_interv_list_editor_open ctrlno=$ctrlno>
			  <span class=\"fa fa-folder-open-o\" aria-hidden=\"true\"></span>
			</button>
			<button type=\"button\" class=\"btn btn-danger btn-xs\" aria-label=\"Left Align\"  id=\"btn_delete_intervention\" interv_id=\"$interv_id\" >
			  <span class=\"fa fa-trash-o\" aria-hidden=\"true\"></span>
			</button>

		  </td>
        </tr>


	";


}
include '../dbclose.php';
?>


