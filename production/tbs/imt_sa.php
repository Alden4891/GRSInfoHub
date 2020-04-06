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
  r.REGION,
  r.PROVINCE,
  r.MUNICIPALITY,
  r.BARANGAY,
  r.HOUSEHOLD_ID,
  r.LAST_NAME,
  r.FIRST_NAME,
  r.MID_NAME,
  r.EXT_NAME,
  r.SEX,
  i.yds_child_count AS 'YDS',
  p.PROGRAM,

  CASE WHEN (p.program_id=10) THEN COUNT(p.program_id) ELSE 0 END AS 'col1', -- 'DOH (Universal Health   Care Program)',
  CASE WHEN (p.program_id=11) THEN COUNT(p.program_id) ELSE 0 END AS 'col2', -- 'DOH (WASH Program)',
  CASE WHEN (p.program_id=12) THEN COUNT(p.program_id) ELSE 0 END AS 'col3', -- 'National Nutrition Council (Nutrition Programs)',

  CASE WHEN (p.program_id=13) THEN COUNT(p.program_id) ELSE 0 END AS 'col4', -- 'NHA (Resettlement/ Socialize Housing)',
  CASE WHEN (p.program_id=14) THEN COUNT(p.program_id) ELSE 0 END AS 'col5', -- 'DOE/ National Electrification Administration (Rural Electrification)',

  COUNT(p.program_id) AS TOTAL
FROM `db_imt`.`grantees` g
  INNER JOIN `db_imt`.`roster` r
    ON (g.`ENTRY_ID` = r.`ENTRY_ID`)
  INNER JOIN `db_imt`.intervensions i
    ON (i.HOUSEHOLD_ID = g.HOUSEHOLD_ID)
  INNER JOIN `db_imt`.lib_programs p
    ON (i.program_id = p.program_id)
  INNER JOIN `db_imt`.lib_subcomp sc
    ON (p.subcomp_id=sc.subcomp_id)
WHERE $filter AND sc.comp_id = 2
GROUP BY r.HOUSEHOLD_ID
ORDER BY 1,2
LIMIT 0, 1000;

";

include '../dbconnect.php';


// prepare data to display
$res_data = mysqli_query($con,$sql) or die(mysqli_error());
$data = mysqli_fetch_all($res_data, MYSQLI_ASSOC);
    



include '../dbclose.php';

/*
// A recordset for merging tables
$data = array();
$data[] = array('rank'=> 'A', 'firstname'=>'Sandra' , 'name'=>'Hill'      , 'number'=>'1523d', 'score'=>200, 'visits'=>15, 'email_1'=>'sh@tbs.com',  'email_2'=>'sandra@tbs.com',  'email_3'=>'s.hill@tbs.com');
$data[] = array('rank'=> 'A', 'firstname'=>'Roger'  , 'name'=>'Smith'     , 'number'=>'1234f', 'score'=>800, 'visits'=>33, 'email_1'=>'rs@tbs.com',  'email_2'=>'robert@tbs.com',  'email_3'=>'r.smith@tbs.com' );
$data[] = array('rank'=> 'B', 'firstname'=>'William', 'name'=>'Mac Dowell', 'number'=>'5491y', 'score'=>130, 'visits'=>16, 'email_1'=>'wmc@tbs.com', 'email_2'=>'william@tbs.com', 'email_3'=>'w.m.dowell@tbs.com' );
*/


// -----------------
// Load the template
// -----------------

$template = './templates/IMT_SA.xlsx';
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
$output_file_name = 'IMT_SA_'.date('Y-m-d').'.xlsx';
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