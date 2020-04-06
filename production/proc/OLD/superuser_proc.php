<?php

    $year = (isset($_REQUEST['year'])?$_REQUEST['year']:'');
	$month = (isset($_REQUEST['month'])?$_REQUEST['month']:'');
	$mode = (isset($_REQUEST['mode'])?$_REQUEST['mode']:'');
	$category = (isset($_REQUEST['category'])?$_REQUEST['category']:'');

	include '../dbconnect.php';

$last_day = date("t", strtotime($year.'-'.$month.'-15'));	
$fday = 1;
$lday = 15;
$modelabel = "1-15";
if ($mode==2) {
	$fday = 16;
	$lday = $last_day;
	$modelabel = "16-$last_day";	
}


$res = mysqli_query($con, "

	SELECT 
	EMP_ID,DATE(LOG) AS `DATE`,
	IF (TAG=1,TIME(LOG),'') AS AI,
	IF (TAG=2,TIME(LOG),'') AS AO,
	IF (TAG=3,TIME(LOG),'') AS PI,
	IF (TAG=4,TIME(LOG),'') AS PO
	FROM dtr  
	WHERE EMP_ID IN (1562,923,1025) 
	GROUP BY DATE(LOG), EMP_ID, TAG;


");

$pre_emp=0;
$pre_date=0;
$cnt=0;


$row="@EMP_ID|@DATE|@AI|@AO|@PI|@PO";
$arr_row=array("");
while ($r=mysqli_fetch_array($res, MYSQLI_ASSOC)) {
	$cnt+=1;
	$EMP_ID=$r['EMP_ID'];
	$LOG=$r['DATE'];

	$AI=$r['AI'];
	$AO=$r['AO'];
	$PI=$r['PI'];
	$PO=$r['PO'];

	if ($cnt==1) {
		$row=str_replace("@EMP_ID", $EMP_ID, $row);
		$row=str_replace("@DATE", $LOG, $row);

		$row=($AI==""?$row:str_replace("@AI", $AI, $row)) ;
		$row=($AO==""?$row:str_replace("@AO", $AO, $row)) ;
		$row=($PI==""?$row:str_replace("@PI", $PI, $row)) ;
		$row=($PO==""?$row:str_replace("@PO", $PO, $row)) ;

		$pre_date = $LOG;
		$pre_emp  = $EMP_ID;

	}else if ($pre_emp==$EMP_ID && $pre_date==$LOG) {
		$row=($AI==""?$row:str_replace("@AI", $AI, $row)) ;
		$row=($AO==""?$row:str_replace("@AO", $AO, $row)) ;
		$row=($PI==""?$row:str_replace("@PI", $PI, $row)) ;
		$row=($PO==""?$row:str_replace("@PO", $PO, $row)) ;
	}else{

		//echo "$row <br>";
		array_push($arr_row, $row);
		$row="@EMP_ID|@DATE|@AI|@AO|@PI|@PO"; //reset

		$row=str_replace("@EMP_ID", $EMP_ID, $row);
		$row=str_replace("@DATE", $LOG, $row);

		$row=($AI==""?$row:str_replace("@AI", $AI, $row)) ;
		$row=($AO==""?$row:str_replace("@AO", $AO, $row)) ;
		$row=($PI==""?$row:str_replace("@PI", $PI, $row)) ;
		$row=($PO==""?$row:str_replace("@PO", $PO, $row)) ;

		$pre_date = $LOG;
		$pre_emp  = $EMP_ID;

	}
}
array_push($arr_row, $row);

$row = "";
foreach ($arr_row as $key => $value) {

	if ($value!=""){
			$value=str_replace("@AI", "", $value) ;
			$value=str_replace("@AO", "", $value) ;
			$value=str_replace("@PI", "", $value) ;
			$value=str_replace("@PO", "", $value) ;	
			$row = explode("|", $value);

				$EMP_ID=$row[0];
				$DATE=$row[1];
				$AI=$row[2];
				$AO=$row[3];
				$PI=$row[4];
				$PO=$row[5];
				$datetime ="";
				if ($AO<>"" && $AI=="") {
					$AI="x";
					$datetime=date('Y-m-d H:i:s',  rand(strtotime("$DATE 07:30:00"),strtotime("$DATE 08:00:00")));	
					mysqli_query($con,"CALL sp_dtr_addentry($EMP_ID,'$datetime',1);");
				}
				if ( $AI<>"" && $AO=="" ) {
					$AO ="x";
					$datetime=date('Y-m-d H:i:s',  rand(strtotime("$DATE 12:00:00"),strtotime("$DATE 12:30:00")));	
					mysqli_query($con,"CALL sp_dtr_addentry($EMP_ID,'$datetime',2);");
				}
				if ($PO<>"" && $PI=="") {
					$PI ="x";
					$datetime=date('Y-m-d H:i:s',  rand(strtotime("$DATE 12:31:00"),strtotime("$DATE 12:59:00")));	
					mysqli_query($con,"CALL sp_dtr_addentry($EMP_ID,'$datetime',3);");

				}
				if ($PI<>"" && $PO=="") {
					$PO=="x";
					$datetime=date('Y-m-d H:i:s',  rand(strtotime("$DATE 17:01:00"),strtotime("$DATE 17:59:00")));	
					mysqli_query($con,"CALL sp_dtr_addentry($EMP_ID,'$datetime',4);");
				}
 				echo "$EMP_ID | $DATE | $AI | $AO | $PI | $PO <br>";
	} 
}

include '../dbclose.php';

?>