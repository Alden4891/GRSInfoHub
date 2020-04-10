<?php

// Include classes
include_once('tbs_class.php'); // Load the TinyButStrong template engine
include_once('tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
    if (ini_get('date.timezone')=='') {
        date_default_timezone_set('UTC');
    }
}

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------



$sql = "

SELECT
    `grievances`.`id` AS `CTRLNO`
    , `r`.`PROVINCE`
    , `r`.`MUNICIPALITY`
    , `r`.`BARANGAY`
    , `lib_grstype`.`grs_type`
    , `lib_grssubtype`.`subtype`
    , `grievances`.`FIRSTNAME`
    , `grievances`.`MIDDLENAME`
    , `grievances`.`LASTNAME`
    , `grievances`.`EXT`
    , `grievances`.`CONTACTNO`
    , `grievances`.`EMAIL`
    , `lib_eoob`.`eoob`
    , `lib_grssource`.`source`
    , `grievances`.`DATE_REPORTED`
    , `lib_status`.`status`
FROM
    `db_grs`.`grievances`
    INNER JOIN `db_grs`.`lib_psgc` AS `r` 
        ON (`grievances`.`PSGC` = `r`.`PSGC`)
    INNER JOIN `db_grs`.`lib_grssubtype` 
        ON (`lib_grssubtype`.`id` = `grievances`.`GRS_TYPE`)
    INNER JOIN `db_grs`.`lib_eoob` 
        ON (`grievances`.`EOOB` = `lib_eoob`.`id`)
    INNER JOIN `db_grs`.`lib_grstype` 
        ON (`lib_grssubtype`.`type` = `lib_grstype`.`id`)
    INNER JOIN `db_grs`.`lib_grssource` 
        ON (`lib_grssource`.`id` = `grievances`.`GRS_SOURCE`)
    INNER JOIN `db_grs`.`lib_status` 
        ON (`grievances`.`STATUS` = `lib_status`.`id`)
WHERE $filter;
";

include '../dbconnect.php';


// prepare data to display
$res_data = mysqli_query($con,$sql) or die(mysqli_error());
$data = mysqli_fetch_all($res_data, MYSQLI_ASSOC);
    
include '../dbclose.php';

// -----------------
// Load the template
// -----------------

$template = './templates/grs_r1.xlsx';
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

$TBS->PlugIn(OPENTBS_SELECT_SHEET, "R_A1");

// Merge data in the first sheet
$TBS->MergeBlock('a,b', $data);


// $TBS->PlugIn(OPENTBS_CHART_DELETE_CATEGORY, 'chart_members_by_category', '*'); // delete all categories used in the template => no need with Ms Office since categories with no data are hidden.



// Merge pictures of the current sheet
//$x_picture = 'pic_1523d.gif';
$TBS->PlugIn(OPENTBS_MERGE_SPECIAL_ITEMS);




// -----------------
// Output the result
// -----------------

// Define the name of the output file
//$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = 'OGRS_'.date('Y-m-d').'.xlsx';
$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
/*
if ($save_as==='') {
    // Output the result as a downloadable file (only streaming, no data saved in the server)
    $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
    // Be sure that no more output is done, otherwise the download file is corrupted with extra data.
    exit();
} else {
    // Output the result as a file on the server.
    $TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields.
    // The script can continue.
    exit("File [$output_file_name] has been created.");
}
*/