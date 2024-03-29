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
      `r`.`REGION`
    , `r`.`PROVINCE`
    , `r`.`MUNICIPALITY`
    , `lib_grssource`.`source` AS `mode_of_filing`
    , `grievances`.`DATE_REPORTED` AS `date_intake`
    , `grs_cat`.`grs_type` AS `category`
    , `sap_compo`.`subtype` AS `compnent`
    , `grievances`.`DESCRIPTION`
    , `grievances`.`Remarks` AS `response_provided`
    , `grievances`.`act_taken` AS `action_taken`
    , CASE WHEN `grievances`.`act_date` = '0000-00-00' THEN '' ELSE `grievances`.`act_date` END `action_date`
    , CASE WHEN `grievances`.`fed_date` = '0000-00-00' THEN '' ELSE `grievances`.`fed_date` END `feedback_date`
    , `lib_status`.`status`
    , CASE WHEN `grievances`.`res_date` = '0000-00-00' THEN '' ELSE `grievances`.`res_date` END `res_date`
    , `grievances`.`res_description`
FROM
    `db_grs`.`lib_psgc`  r
    INNER JOIN `db_grs`.`grievances`
        ON (`r`.`PSGC` = `grievances`.`PSGC`)
    INNER JOIN `db_grs`.`lib_grssource`
        ON (`grievances`.`GRS_SOURCE` = `lib_grssource`.`id`)
    INNER JOIN `db_grs`.`lib_grstype` AS `grs_cat`
        ON (`grievances`.`GRS_CAT` = `grs_cat`.`id`)
    INNER JOIN `db_grs`.`lib_grssubtype` AS `sap_compo`
        ON (`grievances`.`GRS_TYPE` = `sap_compo`.`id`)
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

$TBS->PlugIn(OPENTBS_SELECT_SHEET, "grs");

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
