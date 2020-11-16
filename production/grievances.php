<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Grievances <small>...</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

  <div class="row">
    <div class="col-sm">
            <p class="text-muted font-13 m-b-30">
                Below are the list of grievances.
            </p>
    </div>
    <div class="">
         <a href="#" class="btn btn-primary btn-md active" role="button" aria-pressed="true" psgc="" ctrlno=0 id="btn_interv_list_editor_open" data-toggle="modal" data-target="#interv_list_editor_modal">New Grievance</a> 
    </div>

  </div>   
           <span></span>
            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 30px;">CTRLNo.</th>
                        <th>Description</th>
                        <th>Date Reported</th>
                        <th>Duration</th>
                        <th>Source</th>
                        <th>EODB</th>
                        <th>Status</th>
                        <th style="width: 110px;">Options</th>

                    </tr>
                </thead>

                <tbody id=clientlist>
                    <?php 



                             $cnt=0;
                             $res_intvlist = mysqli_query($con, "

                            SELECT
                                  `grievances`.`id`
                                , `grievances`.`FIRSTNAME`
                                , `grievances`.`MIDDLENAME`
                                , `grievances`.`LASTNAME`
                                , `grievances`.`EXT`
                                , `grievances`.`ADDRESS`
                                , `lib_psgc`.`PSGC`
                                , `lib_psgc`.`REGION`
                                , `lib_psgc`.`PROVINCE`
                                , `lib_psgc`.`MUNICIPALITY`
                                , `lib_psgc`.`BARANGAY`
                                , `grievances`.`CONTACTNO`
                                , `grievances`.`EMAIL`
                                , `lib_grssubtype`.subtype
                                , `grievances`.`DESCRIPTION`
                                , `lib_eoob`.eoob AS 'EOOB'
                                , `grievances`.`DATE_REPORTED`
                                , `lib_grssource`.`source`
                                , `lib_status`.`status`
                                , `grievances`.`DATE_SUBMITTED`
                                , `grievances`.`DATE_MODIFIED`
                                , `grievances`.`DATE_ENCODED`
                                , `grievances`.`Remarks`
                                , `grievances`.`uid`
                                , `grievances`.`docid`
                            FROM
                                `db_grs`.`grievances`
                                INNER JOIN `db_grs`.`lib_psgc` 
                                    ON (`grievances`.`PSGC` = `lib_psgc`.`PSGC`)
                                INNER JOIN `db_grs`.lib_grssubtype 
                                    ON (`grievances`.`GRS_TYPE` = `lib_grssubtype`.`id`)
                                INNER JOIN `db_grs`.`lib_grssource` 
                                    ON (`grievances`.`GRS_SOURCE` = `lib_grssource`.`id`)
                                INNER JOIN `db_grs`.`lib_eoob` 
                                    ON (`lib_eoob`.id = `grievances`.EOOB)
                                INNER JOIN `db_grs`.`lib_status` 
                                    ON (`lib_status`.`id` = `grievances`.`STATUS`)
                                order by  `grievances`.`DATE_REPORTED` desc
                                ;

                             ") or die(mysqli_error());
                            while ($r=mysqli_fetch_array($res_intvlist,MYSQLI_ASSOC)) {

                                $cnt++;

                                $psgc=$r['PSGC'];
                                $ctrlno=$r['id'];
                                $docid = $r['docid'];;
                                $firstname=$r['FIRSTNAME'];
                                $middlename=$r['MIDDLENAME'];
                                $lastname=$r['LASTNAME'];
                                $ext=$r['EXT'];
                                $region=$r['REGION'];
                                $province=$r['PROVINCE'];
                                $municipality=$r['MUNICIPALITY'];
                                $barangayname=$r['BARANGAY'];
                                $contactno=$r['CONTACTNO'];
                                $email=$r['EMAIL'];
                                $grs_subtype=$r['subtype'];
                                $eoob=$r['EOOB'];
                                $date_reported=$r['DATE_REPORTED'];
                                $source=$r['source'];
                                $status=$r['status'];
                                $date_submitted=$r['DATE_SUBMITTED'];
                                $date_modified=$r['DATE_MODIFIED'];
                                //$fullname=$r['fullname'];
                                $date_encoded=$r['DATE_ENCODED'];
                                $remarks=$r['Remarks'];
                                $uid=$r['uid'];
                                $description=substr(Strip_tags(strtolower($r['DESCRIPTION'])), 0,100)."... <a href=\"#\" data-toggle=\"modal\" data-target=\"#previewGrievModal\" id=\"viewGriev\" guid=\"$uid\">read more</a>";

                                $btn_detail_class = "";


                                //get duration
                                $start_date = new DateTime($date_reported);
                                $since_start = $start_date->diff(new DateTime());

                                $lapse = "";
                                if ($since_start->y > 0) {
                                  $lapse = $since_start->y.' years ago';
                                }else if ($since_start->m > 0){
                                  $lapse = $since_start->m.' months ago';
                                }else if ($since_start->d > 0){
                                  $lapse = $since_start->d.' days ago';
                                }else if ($since_start->h > 0){
                                  $lapse = $since_start->h.' hours ago';
                                }else if ($since_start->i > 0){
                                  $lapse = $since_start->i.' minutes ago';
                                } else {
                                  $lapse = ' just now ';
                                }

                                //lightgreen
                                //lightyellow
                                //

                                $trstyle = "white";
                                if ($status == "Ongoing"){
                                    $trstyle = "lightyellow";
                                }else if($status == "Close"){
                                    $trstyle = "lightblue";
                                }

                                echo "
                                    <tr class=\"\" style=\"background-color: $trstyle;\">
                                        <td class=\"even gradeC\"> $docid</td>
                                        <td>$description</td>
                                        <td>$date_reported</td>
                                        <td>$lapse</td>
                                        <td>$source</td>
                                        <td>$eoob</td>
                                        <td>$status</td>
                                        <td>

                                            <button type=\"button\" class=\"btn btn-sm btn-info\" aria-label=\"Left Align\"  data-toggle=\"modal\" data-target=\"#interv_list_editor_modal\" guid=\"$uid\" ctrlno=\"$ctrlno\" docid=\"$docid\" id=\"btn_interv_list_editor_open\" 
                                              psgc=\"$psgc\"
                                              >
                                              <span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>
                                            </button>


                                            <button type=\"button\" class=\"btn btn-sm btn-success\" 
                                            data-backdrop=\"static\" data-keyboard=\"false\"
                                            data-toggle=\"modal\" 
                                            data-target=\"#modal_peview_grievance\" 
                                            guid=\"$uid\" id=\"btn_griev_preview\"
                                            ctrlno=\"$ctrlno\" 
                                            docid=\"$docid\"
                                            psgc=\"$psgc\"

                                            >
                                            <span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>
                                            </button>


                                            <button disabled type=\"button\" class=\"btn btn-sm btn-danger\" >
                                            <span class=\"glyphicon glyphicon-remove-sign\" aria-hidden=\"true\"></span>
                                            </button>


                                        </td>
                                    </tr>

                                ";

                            }
                            mysqli_free_result($res_intvlist);

                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- GRIEVANCE PREVIEW MODAL -->
<div class="modal fade bd-example-modal-lg" id="modal_peview_grievance" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Grievance Information<small></small></h2>



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="  invoice-header">
                          <h2>
                              <i class="fa fa-globe"></i> CTRL No. <span id="gi_docid"></span>
                          </h2>
                        </div>
                        <!-- /.col -->
                      </div>
                      <br>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          <strong>[COMPLAINANT INFORMATION]</strong>
                          <address>
                              <strong>Name: </strong> <span id="ci_name"></span><br>
                              <strong>Contact No: </strong> <span id="ci_contact"></span><br>
                              <strong>Email address: </strong> <span id="ci_email"></span><br>
                              <strong>Province: </strong> <span id="ci_prov"></span><br>
                              <strong>Muncipality: </strong> <span id="ci_muni"></span><br>
                              <strong>barangay: </strong> <span id="ci_brgy"></span><br>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <strong>[GRIEVANCE INFORMATION]</strong>
                          <address>
                              <strong>Category: </strong> <span id="gi_gcategory"></span><br>
                              <strong>Type: </strong> <span id="gi_gtype"></span><br>
                              <strong>EODB: </strong> <span id="gi_eodb"></span><br>
                              <strong>Date Reported: </strong> <span id="gi_date_reported"></span><br>
                              <strong>Source: </strong> <span id="gi_gsource"></span><br>
                              <strong>Assessed by: </strong> <span id="gi_assessedby"></span><br>
                           </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <strong>[STATUS]</strong>
                          <address>
                              <strong>Status: </strong> <span id="gs_status"></span><br>
                              <strong>Duration: </strong> <span id="gs_duration"></span><br>
                              <strong>Date Last Modified: </strong> <span id="gs_date_modified"></span><br>
                              <strong>Last Modified by: </strong> <span id="gs_modified_by"></span><br>
                           </address>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="  table">


<div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                   
          <div class="row">
            <div class="col-sm">
               <h2>Grievance Description</h2>
            </div>
            <div class="pull-right">


                <button type="button" class="btn btn-sm btn-info view_editor_button" aria-label="Left Align"  data-toggle="modal" data-target="#interv_list_editor_modal" guid="$uid" ctrlno="$ctrlno" docid="$docid" id="btn_interv_list_editor_open" psgc="$psgc">
                EDIT
                </button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">
                  CLOSE THIS WINDOW
                </button>
            </div>
            
          </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                          <p class=" well well-sm no-shadow" style="margin-top: 10px" id="gi_description">
                            
                          </p>
                  </div>
                </div>
              </div>

                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-6">
                          <p class="lead">Remarks:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;height: 200px" id="gi_remarks">
                            
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <p class="lead">Attachments</p>
                          <div class="table-responsive">
                            <table class="table">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Attachment/s</th>
                                <th>Size</th>
                                <th style="width: 10%">Download</th>
                              </tr>
                            </thead>
                              <tbody id="griev_attachments_container2">
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
<!--                       <div class="row no-print">
                        <div class=" ">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div> -->
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>

    </div>
  </div>
</div>
<!--// GRIEVANCE PREVIEW MODAL -->

<!-- grievance EDITOR Modal  -->
<div class="modal fade bd-example-modal-lg" id="interv_list_editor_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="interv_list_editor_modal_label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="alert alert-warning alert-dismissible fade show " role="alert" id="editors-notification" hidden>
                      <font color="black">
                        <strong>Notice!</strong> <span id="editors-notification-container"></span>
                      </font>
                      <!--button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button-->
                    </div>
                    <form method='post' action='' enctype="multipart/form-data" id="grievance_form">

                        <input type="hidden" id="hid_user_fullname" name="hid_user_fullname" value="<?=$user_fullname?>">
                        <input type="hidden" id="hid_ctrlno" name="hid_ctrlno" value="0">
                        <input type="hidden" id="hid_user_id" name="hid_user_id" value="<?=$user_id?>">
                        <input type="hidden" id="hid_uuid" name="hid_uuid" value="">
                        <input type="hidden" id="hid_date_submitted" name="hid_date_submitted" value="">
                        <input type="hidden" id="hid_date_modified" name="hid_date_modified" value="">
                        <input type="hidden" id="hid_date_encoded" name="hid_date_encoded" value="">
                       <div class="x_content">

                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">COMPLAINANT INFO</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">GRIEVANCE INFO</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="profile" aria-selected="false">ATTACHMENTS</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">RESOLUTION INFORMATION</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="form-group">
                                <input type="hidden" name="hidden_interv_id" id="hidden_interv_id" value="0">
                                <input type="hidden" name="hidden_hhid" id="hidden_hhid" value="">
                                <label for="cmbEdProvince" class="control-label has-error">Province <font color="red">*</font> </label>
                                <select id="cmbEdProvince" name="cmbEdProvince" required="required" class="select form-control">
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cmbEdMunicipality" class="control-label">Municipality <font color="red">*</font></label>
                                <select id="cmbEdMunicipality" name="cmbEdMunicipality" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cmbEdBarangay" class="control-label">Barangay <font color="red">*</font></label>
                                <select id="cmbEdBarangay" name="cmbEdBarangay" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtEdAddress" class="control-label">Address</label>
                                <textarea id=txtEdAddress name=txtEdAddress class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="txtEdFirstName" class="control-label">First Name <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input id="txtEdFirstName" name="txtEdFirstName" type="text" class="form-control" required="required" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtEdMiddleName" class="control-label">Middle Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input id="txtEdMiddleName" name="txtEdMiddleName" type="text" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtEdLastName" class="control-label">Last Name <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input id="txtEdLastName" name="txtEdLastName" type="text" class="form-control" required="required" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtEdExt" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input id="txtEdExt" name="txtEdExt" type="text" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtEdContactNo" class="control-label">Contact Number <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input id="txtEdContactNo" name="txtEdContactNo" type="text" class="form-control" required="required" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtEdEmail" class="control-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input id="txtEdEmail" name="txtEdEmail" type="email" class="form-control" value="">
                                </div>
                            </div>



                          </div>
                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">



                            <!--//PAGE 2  -->

                            <div class="form-group">
                                <label for="cmbEdGRSCategory" class="control-label">Grievance Category <font color="red">*</font></label>
                                <select id="cmbEdGRSCategory" name="cmbEdGRSCategory" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cmbEdGRSSubtype" class="control-label">Type of Grievance <font color="red">*</font></label>
                                <select id="cmbEdGRSSubtype" name="cmbEdGRSSubtype" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="txtIntervDescription" class="control-label">Grievance Details <font color="red">*</font></label>

                                <!-- editor-one wrapper -->
                                <div class="x_content">
                                  <div id="alerts"></div>
                                  <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
<!--                                     <div class="btn-group">
                                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                            <li></li>
                                      </ul>
                                    </div> -->

                                    <div class="btn-group">
                                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                        <li>
                                          <a data-edit="fontSize 5">
                                            <p style="font-size:17px">Huge</p>
                                          </a>
                                        </li>
                                        <li>
                                          <a data-edit="fontSize 3">
                                            <p style="font-size:14px">Normal</p>
                                          </a>
                                        </li>
                                        <li>
                                          <a data-edit="fontSize 1">
                                            <p style="font-size:11px">Small</p>
                                          </a>
                                        </li>
                                      </ul>
                                    </div>

                                    <div class="btn-group">
                                      <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                      <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                      <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                      <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                    </div>

                                    <div class="btn-group">
                                      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                    </div>

                                    <div class="btn-group">
                                      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                    </div>

                                    <div class="btn-group">
                                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                      <div class="dropdown-menu input-append">
                                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                        <button class="btn" type="button">Add</button>
                                      </div>
                                      <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                                    </div>

                                    <div class="btn-group">
                                      <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                      <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                    </div>

                                    <div class="btn-group">
                                      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                    </div>
                                  </div>
                                  <div id="editor-one" name="editor-one" class="editor-wrapper"></div>
                                  <textarea name="descr" id="descr" style="display:none;">sample</textarea>
                                  <input type="hidden" name="hid_description" id="hid_description">
                                  
                                  <br />
                                  <div class="ln_solid"></div>
                                </div>
                             <!-- /editor-one wrapper -->
                            </div>

                            <div class="form-group">
                                <label for="cmbEdEODB" class="control-label">EODB <font color="red">*</font></label>
                                <select id="cmbEdEODB" name="cmbEdEODB" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="dtDateReported" class="control-label">Date Reported <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input id="dtDateReported" name="dtDateReported" type="date" class="form-control" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cmbEdSource" class="control-label">SOURCE OF GRIEVANCE <font color="red">*</font></label>
                                <select id="cmbEdSource" name="cmbEdSource" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="contact-tab">
<!-- 
                           <div class="alert alert-info">
                              <h4><i class="fa fa-info"></i> Note:</h4> This module page is currently underconstruction and subject for changes.
                           </div>
 -->
                            <div class="form-group">
                                <label for="cmbEdSource" class="control-label">Upload Files <font color="red">*</font></label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="files" name="files[]" multiple>
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                  </div>
<!--                                   <div class="input-group-append">
                                    <button class="btn btn-info" type="button" style="font-size: 13.5px;">Upload</button>
                                  </div> -->
                                </div>
                            </div>


<div class="x_panel">
                  <div class="x_title">
                    <h2>Attachments <small>You have to download the file in order to view it.</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>File ID</th>
                          <th>Filename</th>
                          <th style="width: 100px;">Size</th>
                          <th style="width: 100px;">Options</th>
                        </tr>
                      </thead>
                      <tbody id="griev_attachments_container">




                      </tbody>
                    </table>

                  </div>
                </div>


                          </div>

                          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="form-group">
                                <label for="cmbEdStatus" class="control-label">Status <font color="red">*</font></label>
                                <select id="cmbEdStatus" name="cmbEdStatus" class="select form-control" required="required">
                                    <option value="-1">Select</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="txtEdRemarks" class="control-label">Remarks</label>
                                <textarea id=txtEdRemarks name=txtEdRemarks class="form-control"></textarea>
                            </div>
                          </div>

                        </div>
                      </div>


                            <!--  <div class="form-group">
                                                    <button  name="submit" type="submit" class="btn btn-primary" id=btnSubmitGrievamce name=btnSubmitGrievamce>Save</button>
                                                </div>
                             -->

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm">
                                    <p class="text-muted font-13 m-b-30">
                                       
                                    </p>
                            </div>
                            <div class="">
                                 <span class="icon-input-btn"><span class="glyphicon glyphicon-search"></span> 
                                    <input  name="submit" type="submit" class="btn btn-primary" id=btnSubmitGrievamce name=btnSubmitGrievamce value="Save">
                                 </span>
                                 
                                 <!-- <i class="fa fa-home"></i>  -->
                            </div>

                          </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /grievance EDITOR Modal  -->






<script>
    //delete attachment
    $(document).on('click', '#delete_attachment', function(e) {
        e.preventDefault();
        if (confirm('You are about to delete this file. Do you want to continue?')) {
            var tr = $(this).closest('tr');
            $.ajax({
                type: 'POST',
                url: 'proc/attachment_delete.php',
                data: {
                    attachment_id: $(this).attr('attachment_id')
                },
                success: function(response) {
                    // console.log(response);
                    if (response.indexOf("**success**") > -1) {
                        tr.fadeOut(500, function() {
                            parent.remove();
                        });
                    }
                }
            });
        }
    });

    //check attachments 
    $('#files').bind('change', function() {
        if (this.files[0].size > 2000000){
            $("#files").replaceWith($("#files").val('').clone(true));
            alert("The file is too huge. Please make sure that the file size will not exceed to 2MB in size.");
            return;
        }
    });


    //submit griev editor 
    $("#grievance_form").submit(function(e) {
        e.preventDefault();

        if (confirm('You are about to save the changes you made. Do you want to continue?')) {
            $('#hid_description').val($('#editor-one').html());
                $.ajax({
                    type: 'POST',
                    url: 'proc/grievance_save.php',
                    //data: data,
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        // console.log(response);
                         if (response.indexOf("**success**") > -1){   
                                notification_show("Saved",1);
                                $('#btnSubmitGrievamce').attr('disabled',true);
                         }else if (response.indexOf("**no-changes**") > -1) {
                                 notification_show("No changes made!",0);
                         }
                    }
                });
        }
    });


    //delete grievance
    $(document).on('click', '#btn_delete_grievance', function(e) {
        e.preventDefault();
        if (confirm('You are about to delete this grievance. Do you want to continue?')) {
            var tr = $(this).closest('tr');
            $.ajax({
                type: 'POST',
                url: 'proc/grievance_delete.php',
                data: {
                    interv_id: $(this).attr('interv_id')
                },
                success: function(response) {

                    if (response.indexOf("**success**") > -1) {

                        tr.fadeOut(500, function() {
                            parent.remove();
                        });
                    }

                }
            });

        }
    });

    function  notification_show(msg,mode=0){

        var type = "alert-warning";
        if (mode==0){
            $('#editors-notification').removeClass('alert-success');
            $('#editors-notification').addClass('alert-warning');
            $('#editors-notification').removeAttr('hidden');
            $('#editors-notification-container').html(msg);
        }else if (mode == 1){
            $('#editors-notification').removeClass('alert-warning');
            $('#editors-notification').addClass('alert-success');
            $('#editors-notification').removeAttr('hidden');
            $('#editors-notification-container').html(msg);
        }


    }

    //open grievance editor
    $(document).on('click', "#btn_interv_list_editor_open", function(e) {
        e.preventDefault();


        var psgc = $(this).attr('psgc');
        var guid = $(this).attr('guid'); 
        var ctrlno = $(this).attr('ctrlno'); 
        var docid = $(this).attr('docid'); 

       


         $('#btnSubmitGrievamce').attr('disabled',false);
         $('#editors-notification').attr('hidden',true);
         $('#griev_attachments_container').html('');
        if (psgc > 0) {
            //* LOAD DATA ENTRY FOR EDITING
            var psgc_prov = parseInt(psgc.substring(0, 4));
            var psgc_muni = parseInt(psgc.substring(0, 6));
            var psgc_brgy = parseInt(psgc.substring(0, 9));


            //var date_conducted = new Date($(this).closest('tr').find('td:eq(4)').text());
            var date_conducted = $(this).closest('tr').find('td:eq(4)').text();

            $('#interv_list_editor_modal_label').html('CTRL No.' + docid );
            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,4)",
                    displayMember: "province",
                    condition: "LEFT(PSGC,2) = '12'",
                    selected: psgc_prov,
                },
                success: function(response) {
                    
                    $('#cmbEdProvince').html(response);
                }
            });

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,6)",
                    displayMember: "MUNICIPALITY",
                    condition: "LEFT(PSGC,4) = '"+psgc_prov+"' ORDER BY 2",
                    selected: psgc_muni,
                },
                success: function(response) {
                    //console.log(response);
                    $('#cmbEdMunicipality').html(response);
                }
            });

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,9)",
                    displayMember: "`BARANGAY`",
                    condition: "LEFT(PSGC,6) = '"+psgc_muni+"' ORDER BY 2",
                    selected: psgc_brgy,
                },
                success: function(response) {

                    $('#cmbEdBarangay').html(response);
                }
            });


            //get grievance details
            $.ajax({
                type: 'GET',
                url: './proc/getGrievanceInfo.php',
                data: {
                    guid: guid,
                },
                success: function(response) {
                    

                    var arr = response.split('|');
                    /*
                    RESULTS:
                        r[0] = `id`
                        r[1] = `FIRSTNAME`
                        r[2] = `MIDDLENAME`
                        r[3] = `LASTNAME`
                        r[4] = `EXT`
                        r[5] = `PSGC`
                        r[6] = `REGION`
                        r[7] = `PROVINCE`
                        r[8] = `MUNICIPALITY`
                        r[9] = `BARANGAY`
                        r[10] = `CONTACTNO`
                        r[11] = `EMAIL`
                        r[12] = `grs_type`
                        r[13] = `DESCRIPTION`
                        r[14] = `EOOB`
                        r[15] = `DATE_REPORTED`
                        r[16] = `source`
                        r[17] = `status`
                        r[18] = `DATE_SUBMITTED`
                        r[19] = `DATE_MODIFIED`
                        r[20] = `ENCODED_BY`
                        r[21] = `DATE_ENCODED`
                        r[22] = `Remarks`
                        r[23] = `address`

                             24  grs_type_id
                             25  EODB_ID
                             26  source_id
                             27  status_id
                             28  uuid

                             29  grs_subtype_id
                             30  subtype
                    */

                    //COMPLIANT INFORMATION
                    $('#txtEdFirstName').val(arr[1]);
                    $('#txtEdMiddleName').val(arr[2]);
                    $('#txtEdLastName').val(arr[3]);
                    $('#txtEdExt').val(arr[4]);
                    $('#txtEdAddress').val(arr[23]);
                    $('#txtEdContactNo').val(arr[10]);
                    $('#txtEdEmail').val(arr[11]);
                    $('#hid_ctrlno').val(ctrlno);
                    $('#hid_uuid').val(arr[28]);
                    $('#hid_date_submitted').val(arr[18]);
                    $('#hid_date_modified').val(arr[19]);
                    $('#hid_date_encoded').val(arr[21]);
                    $('#hid_encoded_by').val(arr[20]);

                    $('#files').val('');
                    //GRIEVANCE INFORMATION
                    
                    $.ajax({
                        type: 'GET',
                        url: './proc/getComboData.php',
                        data: {
                            tableName: "lib_grstype",
                            valueMember: "id",
                            displayMember: "`grs_type`",
                            condition: "1=1",
                            selected: arr[24],
                        },
                        success: function(response) {

                            $('#cmbEdGRSCategory').html(response);
                        }
                    });

                    $.ajax({
                        type: 'GET',
                        url: './proc/getComboData.php',
                        data: {
                            tableName: "lib_grssubtype",
                            valueMember: "id",
                            displayMember: "`subtype`",
                            condition: "`type`="+ arr[24] +" ORDER BY subtype",
                            selected: arr[29],
                        },
                        success: function(response) {

                            $('#cmbEdGRSSubtype').html(response);
                        }
                    });


                    $('#editor-one').html(arr[13]);
          

      
                    $.ajax({
                        type: 'GET',
                        url: './proc/getComboData.php',
                        data: {
                            tableName: "lib_eoob",
                            valueMember: "id",
                            displayMember: "`eoob`",
                            condition: "1=1",
                            selected: parseInt(arr[25]),
                        },
                        success: function(response) {
                            //console.log(response);
                            $('#cmbEdEODB').html(response);
                        }
                    });


                    $('#dtDateReported').val(arr[15]);

                    $.ajax({
                        type: 'GET',
                        url: './proc/getComboData.php',
                        data: {
                            tableName: "lib_grssource",
                            valueMember: "id",
                            displayMember: "`source`",
                            condition: "1=1",
                            selected: parseInt(arr[26]),
                        },
                        success: function(response) {
                            //console.log(response);
                            $('#cmbEdSource').html(response);
                        }
                    });

                    //ATTACHMENTS

                    $.ajax({
                        type: 'GET',
                        url: './proc/getGrievAttachments.php',
                        data: {
                            guid: guid,
                        },
                        success: function(response) {
                            //console.log('attachments:'+response);
                            $('#griev_attachments_container').html(response);
                        }
                    });





                    //RESOLUTION INFORMATION
                    $.ajax({
                        type: 'GET',
                        url: './proc/getComboData.php',
                        data: {
                            tableName: "lib_status",
                            valueMember: "id",
                            displayMember: "`status`",
                            condition: "1=1",
                            selected: parseInt(arr[27]),
                        },
                        success: function(response) {
                            // console.log(response);
                            $('#cmbEdStatus').html(response);
                        }
                    });

                    $('#txtEdRemarks').html(arr[22]);

                }
            });


        } else {
            //* LOAD DATA ENTRY FOR NEW grievance
            $('#interv_list_editor_modal_label').html('New Grievance');

           //hidden
            $('#hid_ctrlno').val('0');
            $('#hid_uuid').val('');

            $('#hid_encoded_by').val('');
            $('#hid_date_submitted').val('');
            $('#hid_date_encoded').val('');
            $('#hid_date_modified').val('');
 
           //TAB 1
            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,4)",
                    displayMember: "province",
                    condition: "LEFT(PSGC,2) = '12'",
                    selected: psgc_prov,
                },
                success: function(response) {
                    
                    $('#cmbEdProvince').html(response);
                }
            });
            $('#cmbEdMunicipality').html('');
            $('#cmbEdBarangay').html('');
            $('#cmbEdGRSSubtype').html('');
            $('#txtEdAddress').val('');
            $('#txtEdFirstName').val('');
            $('#txtEdMiddleName').val('');
            $('#txtEdLastName').val('');
            $('#txtEdExt').val('');
            $('#txtEdContactNo').val('');
            $('#txtEdEmail').val('');
            $('#files').val('');
            //TAB 2

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_grstype",
                    valueMember: "id",
                    displayMember: "`grs_type`",
                    condition: "1=1",
                    selected: '',
                },
                success: function(response) {

                    $('#cmbEdGRSCategory').html(response);
                }
            });

            $('#editor-one').html('');
            
            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_eoob",
                    valueMember: "id",
                    displayMember: "`eoob`",
                    condition: "1=1",
                    selected: '',
                },
                success: function(response) {
                    //console.log(response);
                    $('#cmbEdEODB').html(response);
                }
            });

            $('#dtDateReported').val('');

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_grssource",
                    valueMember: "id",
                    displayMember: "`source`",
                    condition: "1=1",
                    selected: '',
                },
                success: function(response) {
                    //console.log(response);
                    $('#cmbEdSource').html(response);
                }
            });

            //ATTACHMENTS


            //RESOLUTION INFORMATION
            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_status",
                    valueMember: "id",
                    displayMember: "`status`",
                    condition: "1=1",
                    selected: 1,
                },
                success: function(response) {
                    //console.log(response);
                    $('#cmbEdStatus').html(response);
                }
            });

            $('#txtEdRemarks').html('');



        }

    });

    function getCurrentDate() {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        return d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
    }

    //on change cmbEdGRSCategory
    $(document).on('change', "#cmbEdGRSCategory", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_grssubtype",
                    valueMember: "id",
                    displayMember: "`subtype`",
                    condition: "`type`="+ value +" ORDER BY subtype",
                    selected: '',
                },
                success: function(response) {

                    $('#cmbEdGRSSubtype').html(response);
                }
            });

    });

    //on change #cmbEdProvince
    $(document).on('change', "#cmbEdProvince", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,6)",
                    displayMember: "MUNICIPALITY",
                    condition: "LEFT(PSGC,4) = '"+value+"' ORDER BY 2",
                    selected: '',
                },
                success: function(response) {
                    //console.log(response);
                    $('#cmbEdMunicipality').html(response);
                    $('#cmbEdBarangay').html('');
                }
            });
    });

    //on change #cmbEdMunicipality
    $(document).on('change', "#cmbEdMunicipality", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()

            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,9)",
                    displayMember: "`BARANGAY`",
                    condition: "LEFT(PSGC,6) = '"+value+"' ORDER BY 2",
                    selected: '',
                },
                success: function(response) {

                    $('#cmbEdBarangay').html(response);
                }
            });
    });


    $(document).on('click', '#btn_griev_preview',function (e){
        e.preventDefault();

            //get grievance details
            var guid = $(this).attr('guid');
            var psgc = $(this).attr('psgc');
            var ctrlno = $(this).attr('ctrlno');
            var docid = $(this).attr('docid');

            $('.view_editor_button').attr('guid',guid);
            $('.view_editor_button').attr('psgc',psgc);
            $('.view_editor_button').attr('ctrlno',ctrlno);
            $('.view_editor_button').attr('docid',docid);

            //***

            $.ajax({
                type: 'GET',
                url: './proc/getGrievanceInfo.php',
                data: {
                    guid: guid,
                },
                success: function(response) {
                    
                    // console.log(response);
                    var arr = response.split('|');
                    /*
                    RESULTS:
                        r[0] = `id`
                        r[1] = `FIRSTNAME`
                        r[2] = `MIDDLENAME`
                        r[3] = `LASTNAME`
                        r[4] = `EXT`
                        r[5] = `PSGC`
                        r[6] = `REGION`
                        r[7] = `PROVINCE`
                        r[8] = `MUNICIPALITY`
                        r[9] = `BARANGAY`
                        r[10] = `CONTACTNO`
                        r[11] = `EMAIL`
                        r[12] = `grs_type`
                        r[13] = `DESCRIPTION`
                        r[14] = `EOOB`
                        r[15] = `DATE_REPORTED`
                        r[16] = `source`
                        r[17] = `status`
                        r[18] = `DATE_SUBMITTED`
                        r[19] = `DATE_MODIFIED`
                        r[20] = `ENCODED_BY`
                        r[21] = `DATE_ENCODED`
                        r[22] = `Remarks`
                        r[23] = `address`

                             24  grs_type_id
                             25  EODB_ID
                             26  source_id
                             27  status_id
                             28  uuid

                             29  grs_subtype_id
                             30  subtype
                             31  modified by


                    */

                    //COMPLIANT INFORMATION
                    $('#ci_name').html(arr[1] + ' ' +  arr[2] + ' ' + arr[3]);
                    $('#ci_contact').html(arr[10]);
                    $('#ci_email').html(arr[11]);
                    $('#ci_prov').html(arr[7]);
                    $('#ci_muni').html(arr[8]);
                    $('#ci_brgy').html(arr[9]);

                    //grievacnce information


                    $('#gi_docid').html(docid);
                    $('#gi_gcategory').html(arr[12]);
                    $('#gi_gtype').html(arr[30]);
                    $('#gi_eodb').html(arr[14]);
                    $('#gi_date_reported').html(arr[15]);
                    $('#gi_gsource').html(arr[16]);
                    $('#gi_assessedby').html(arr[20]);
                    $('#gi_description').html(arr[13]);



                    //grievance status
                    $('#gs_status').html(arr[17]);
                    $('#gi_remarks').html(arr[22]);



                      var today = new Date();
                      var comdate = new Date(arr[15]);
                      var diffMs = (today-comdate); // milliseconds between now & Christmas
                      var diffDays = Math.floor(diffMs / 86400000); // days
                      var diffMonths = Math.floor(diffMs / 8.64e+8); // days
                      var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
                      var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes

                      var duration = "";
                      if (diffMonths>0) {
                          duration = diffMonths + " Months ago";
                      }else if (diffDays>0){
                          duration = diffDays + " days ago";
                      }else if (diffHrs>0){
                          duration = diffHrs + " hours ago";
                      }else if (diffMins>0){
                          duration = diffHrs + " minutes ago";
                      }

                    $('#gs_duration').html(duration);
                    $('#gs_modified_by').html(arr[31]);
                    $('#gs_date_modified').html(arr[19]);

                    //ATTACHMENTS

                    $.ajax({
                        type: 'GET',
                        url: './proc/getGrievAttachments.php',
                        data: {
                            guid: guid,
                            mode: 1, //no deletion allowed
                        },
                        success: function(response) {
                            //console.log('attachments:'+response);
                            $('#griev_attachments_container2').html(response);
                        }
                    });



                }
            });
    });


</script>