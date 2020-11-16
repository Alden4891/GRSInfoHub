<?php  
include '../dbconnect.php';

$tableName 		=  (isset($_REQUEST['tableName'])?$_REQUEST['tableName']:''); 
$valueMember 	=  (isset($_REQUEST['valueMember'])?$_REQUEST['valueMember']:'');
$displayMember 	=  (isset($_REQUEST['displayMember'])?$_REQUEST['displayMember']:''); 
$condition 		=  (isset($_REQUEST['condition'])?$_REQUEST['condition']:'');
$selected 		=  (isset($_REQUEST['selected'])?$_REQUEST['selected']:'');

if ($condition != ""){
	$condition = "where $condition;";
}

$sql =  "SELECT $valueMember, $displayMember FROM `$tableName` $condition;";
echo "[$sql]";
$res = mysqli_query($con, $sql ) OR die (mysqli_error($con));



	echo "<option value='-1'>Select</option>";
while ($r = mysqli_fetch_array($res)){
	$value = $r[0];
	$display = $r[1];

	if ($selected == $value){
		echo "<option value='$value' selected>$display</option>";
	}else{
		echo "<option value='$value'>$display</option>";
	}

}
include '../dbclose.php';
?>