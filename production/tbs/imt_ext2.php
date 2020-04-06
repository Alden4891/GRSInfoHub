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



include '../dbconnect.php';


$res_columns = mysqli_query($con,"
SELECT 
p.program
FROM lib_programs p
INNER JOIN lib_subcomp sc
ON p.subcomp_id = sc.subcomp_id
INNER JOIN lib_comp c
ON sc.comp_id = c.comp_id
WHERE c.comp_id = 5;
") or die(mysqli_error($con));


$cnt = 0;
$col1="";
$col2="";
$col3="";
$col4="";
$col5="";
$col6="";

while ($r=mysqli_fetch_array($res_columns,MYSQLI_ASSOC)) {
  $cnt+=1;
  if ($cnt == 1) $col1 = $r['program'];
  if ($cnt == 2) $col2 = $r['program'];
  if ($cnt == 3) $col3 = $r['program'];
  if ($cnt == 4) $col4 = $r['program'];
  if ($cnt == 5) $col5 = $r['program'];
  if ($cnt == 6) $col6 = $r['program'];

}


// prepare data to display
$filter = str_replace("'", "''", $filter);
$res_data = mysqli_query($con,"CALL getOtherIntervPivt('$filter');") or die(mysqli_error());
$data = mysqli_fetch_all($res_data, MYSQLI_ASSOC);



include '../dbclose.php';


//exit();
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

$template = './templates/IMT_EXT2.xlsx';
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

$TBS->PlugIn(OPENTBS_SELECT_SHEET, "OTHER_INTERV");

$TBS->MergeBlock('dc1,dc2', 'num', 3);
$TBS->MergeBlock('b2', $data);

// $TBS->PlugIn(OPENTBS_CHART_DELETE_CATEGORY, 'chart_members_by_category', '*'); // delete all categories used in the template => no need with Ms Office since categories with no data are hidden.



// Merge pictures of the current sheet
//$x_picture = 'pic_1523d.gif';
$TBS->PlugIn(OPENTBS_MERGE_SPECIAL_ITEMS);




// -----------------
// Output the result
// -----------------

// Define the name of the output file
//$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = 'IMT_EXT2_'.date('Y-m-d').'.xlsx';
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