<?php

$optionRegion = isset($_REQUEST['optionRegion'])?$_REQUEST['optionRegion']:'XII';
$optionProvince = isset($_REQUEST['optionProvince'])?$_REQUEST['optionProvince']:-1;
$optionMunicipality = isset($_REQUEST['optionMunicipality'])?$_REQUEST['optionMunicipality']:-1;
$optionBarangay = isset($_REQUEST['optionBarangay'])?$_REQUEST['optionBarangay']:-1;
$optionReportType = isset($_REQUEST['optionReportType'])?$_REQUEST['optionReportType']:-1;

$filter = '1=1';
$a_coverage = "";

if ($optionBarangay != -1) {
	$filter = "r.MUNICIPALITY='$optionMunicipality' and r.BARANGAY='$optionBarangay'";
	$a_coverage = "Brgy. $optionBarangay, $optionMunicipality, $optionProvince";
}elseif ($optionMunicipality != -1){
	$filter = "r.MUNICIPALITY='$optionMunicipality'";
	$a_coverage = "$optionMunicipality, $optionProvince";
}elseif ($optionProvince != -1){
	$filter = "r.PROVINCE='$optionProvince'";
	$a_coverage = "$optionProvince";
}else{
	//load entire records of the selected region
	$filter = "r.REGION='$optionRegion'";
	$a_coverage = "Region $optionRegion";
}


if ($optionReportType == 'grs_r1')       include 'grs_r1.php';
if ($optionReportType == 'grs_r2')       include 'grs_r2.php';
if ($optionReportType == 'grs_r3') 		 include 'grs_r3.php';


?>