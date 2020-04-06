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

  </div>            <span>sadasd</span>
            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>CTRLNo.</th>
                        <th>Description</th>
                        <th>Date Reported</th>
                        <th>Source</th>
                        <th>EOOB</th>
                        <th>Status</th>
                        <th>Options</th>

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
                                , `lib_psgc`.`PSGC`
                                , `lib_psgc`.`REGION`
                                , `lib_psgc`.`PROVINCE`
                                , `lib_psgc`.`MUNICIPALITY`
                                , `lib_psgc`.`BARANGAY NAME`
                                , `grievances`.`CONTACTNO`
                                , `grievances`.`EMAIL`
                                , `lib_grstype`.`grs_type`
                                , `grievances`.`DESCRIPTION`
                                , `grievances`.`EOOB`
                                , `grievances`.`DATE_REPORTED`
                                , `lib_grssource`.`source`
                                , `lib_status`.`status`
                                , `grievances`.`DATE_SUBMITTED`
                                , `grievances`.`DATE_RESOLVED`
                                , `users`.`fullname`
                                , `grievances`.`DATE_ENCODED`
                                , `grievances`.`Remarks`
                            FROM
                                `db_grs`.`grievances`
                                INNER JOIN `db_grs`.`lib_psgc` 
                                    ON (`grievances`.`PSGC` = `lib_psgc`.`PSGC`)
                                INNER JOIN `db_grs`.`lib_grstype` 
                                    ON (`grievances`.`GRS_TYPE` = `lib_grstype`.`id`)
                                INNER JOIN `db_grs`.`lib_grssource` 
                                    ON (`grievances`.`GRS_SOURCE` = `lib_grssource`.`id`)
                                INNER JOIN `db_grs`.`lib_status` 
                                    ON (`lib_status`.`id` = `grievances`.`STATUS`)
                                INNER JOIN `db_grs`.`users` 
                                    ON (`grievances`.`ENCODED_BY` = `users`.`user_id`);

                             ") or die(mysqli_error());
                            while ($r=mysqli_fetch_array($res_intvlist,MYSQLI_ASSOC)) {

                                $cnt++;

                                $psgc=$r['PSGC'];
                                $ctrlno=$r['id'];
                                $firstname=$r['FIRSTNAME'];
                                $middlename=$r['MIDDLENAME'];
                                $lastname=$r['LASTNAME'];
                                $ext=$r['EXT'];
                                $region=$r['REGION'];
                                $province=$r['PROVINCE'];
                                $municipality=$r['MUNICIPALITY'];
                                $barangayname=$r['BARANGAY NAME'];
                                $contactno=$r['CONTACTNO'];
                                $email=$r['EMAIL'];
                                $grs_type=$r['grs_type'];
                                $description=substr($r['DESCRIPTION'], 0,300)."... <a href=\"#\">Read more</a>";
                                $eoob=$r['EOOB'];
                                $date_reported=$r['DATE_REPORTED'];
                                $source=$r['source'];
                                $status=$r['status'];
                                $date_submitted=$r['DATE_SUBMITTED'];
                                $date_resolved=$r['DATE_RESOLVED'];
                                $fullname=$r['fullname'];
                                $date_encoded=$r['DATE_ENCODED'];
                                $remarks=$r['Remarks'];


                                $btn_detail_class = "";

                                echo "
                                    <tr class=\"\">
                                        <td class=\"even gradeC\"> $ctrlno</td>
                                        <td>$description</td>
                                        <td>$date_reported</td>
                                        <td>$source</td>
                                        <td>$eoob</td>
                                        <td>$status</td>
                                        <td>

                                            <button type=\"button\" class=\"btn btn-info\" aria-label=\"Left Align\"  data-toggle=\"modal\" data-target=\"#interv_list_editor_modal\" ctrlno=\"$ctrlno\" id=\"btn_interv_list_editor_open\" psgc=\"$psgc\">
                                              <span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span>
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

<script>
    //submit interv editor
    $(document).on('click', "#btnSubmitIntv", function(e) {
        e.preventDefault();
        if (confirm('You are about to save the changes you made. Do you want to continue?')) {

            var hidden_interv_id = $('#hidden_interv_id').val();
            var hidden_hhid = $('#hidden_hhid').val().replace(/[\s\r\n]+$/, '');
            var cmbEdBarangay = $('#cmbEdBarangay').val();
            var numYDS = $('#numYDS').val();
            var dtDateConducted = $('#dtDateConducted').val();
            var txtTitle = $('#txtTitle').val();
            //var txtIntervDescription = $('#txtIntervDescription').val();
            var txtIntervDescription = $('#editor-one').html();

            var has_error = false;
            if (cmbEdBarangay < 0) {
                notification_show('The following fields are required! <br> <ul><li>Compoents</li><li>Classification</li><li>Program/Service</li></ul>');
                // $('#cmbEdBarangay').closest('div').addClass('has-error');
                // $('#cmbEdMunicipality').closest('div').addClass('has-error');
                // $('#cmbEdProvince').closest('div').addClass('has-error');
                has_error = true;
            } else if (numYDS <= 0) {
                notification_show('YDS field is required!');
                has_error = true;
            } else if (txtTitle == "") {
                notification_show('Title field is required!');
                $('#txtTitle').closest('div').addClass('has-error');
                has_error = true;
            } else if (txtIntervDescription == "" > 0) {
                notification_show('Intervention field is required!');
                //$('#txtIntervDescription').closest('div').addClass('has-error');
                has_error = true;
            } else {
                //save data
                $.ajax({
                    type: 'POST',
                    url: 'proc/intervention_save.php',
                    data: {
                        subject: txtTitle,
                        details: txtIntervDescription,
                        date_conducted: dtDateConducted,
                        yds_child_count: numYDS,
                        program_id: cmbEdBarangay,
                        HOUSEHOLD_ID: hidden_hhid,
                        interv_id: hidden_interv_id,
                        user_id: "<?=$user_id?>"
                    },
                    success: function(response) {
                        //console.log(response);
                        $('#intev_tablebody_container').html(response);
                        $('#interv_list_editor_modal').modal('hide');

                    }
                });

            }

        }

    });

    //* show modal on btnIntervlistShowModal clicked
    $(document).on('click', "#btnIntervlistShowModal", function(e) {
        e.preventDefault();
        var ctrlno = $(this).attr('ctrlno');

        //load modal list;
        $('#interv_list_editor_modal_label').html('CTRL No.' + ctrlno);
        //get header data
        $.ajax({
            type: 'POST',
            url: 'proc/getGrievanceInfo.php',
            data: {
                ctrlno: ctrlno
            },
            success: function(response) {

                var r = response.split('|');
                /*
                    r[0] = id
                    r[1] = firstname
                    r[2] = middlename
                    r[3] = lastname
                    r[4] = ext
                    r[5] = region
                    r[6] = province
                    r[7] = municipality
                    r[8] = barangayname
                    r[9] = contactno
                    r[10] = email
                    r[11] = grs_type
                    r[12] = description
                    r[13] = eoob
                    r[14] = date_reported
                    r[15] = source
                    r[16] = status
                    r[17] = date_submitted
                    r[18] = date_resolved
                    r[19] = fullname
                    r[20] = date_encoded
                    r[21] = remarks

                */


                return;

                $('#ih_grantee').html(r[1]);
                $('#ih_sex').html(r[2]);
                $('#ih_birthdate').html(r[3]);
                $('#ih_age').html(r[4]);
                $('#ih_region').html(r[5]);
                $('#ih_province').html(r[6]);
                $('#ih_municipality').html(r[7]);
                $('#ih_barangay').html(r[8]);
                $('#ih_hhstatus').html(r[9]);
                $('#ih_ipaffil').html(r[10]);
                $('#ih_setgroup').html(r[11]);

            }

        });

        //get table data
        $.ajax({
            type: 'POST',
            url: 'proc/get_intervention_list.php',
            data: {
                ctrlno: ctrlno
            },
            success: function(response) {
                $('#intev_tablebody_container').html(response);

            }
        });
    });

    //delete intervention
    $(document).on('click', '#btn_delete_intervention', function(e) {
        e.preventDefault();
        if (confirm('You are about to delete this intervention. Do you want to continue?')) {
            var tr = $(this).closest('tr');
            $.ajax({
                type: 'POST',
                url: 'proc/intervention_delete.php',
                data: {
                    interv_id: $(this).attr('interv_id')
                },
                success: function(response) {

                    if (response.indexOf("**success**") > -1) {

                        tr.fadeOut(500, function() {
                            alert(response);
                            parent.remove();
                        });
                    }

                }
            });

        }
    });

    function  notification_show(msg){
        $('#editors-notification').removeAttr('hidden');
        $('#editors-notification-container').html(msg);
    }

    //open intervention editor
    $(document).on('click', "#btn_interv_list_editor_open", function(e) {
        e.preventDefault();

        var ctrlno = $(this).attr('ctrlno');
        var psgc = $(this).attr('psgc');
       


        if (psgc > 0) {
            //* LOAD DATA ENTRY FOR EDITING
            var psgc_prov = parseInt(psgc.substring(0, 4));
            var psgc_muni = parseInt(psgc.substring(0, 6));
            var psgc_brgy = parseInt(psgc.substring(0, 9));


            //var date_conducted = new Date($(this).closest('tr').find('td:eq(4)').text());
            var date_conducted = $(this).closest('tr').find('td:eq(4)').text();

            $('#interv_list_editor_modal_label').html('CTRL No.' + ctrlno );
           
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
                    console.log(response);
                    $('#cmbEdMunicipality').html(response);
                }
            });
            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_psgc",
                    valueMember: "DISTINCT LEFT(PSGC,9)",
                    displayMember: "`BARANGAY NAME`",
                    condition: "LEFT(PSGC,6) = '"+psgc_muni+"' ORDER BY 2",
                    selected: psgc_brgy,
                },
                success: function(response) {

                    $('#cmbEdBarangay').html(response);
                }
            });


            //get intervention details
            $.ajax({
                type: 'GET',
                url: './proc/getGrievanceInfo.php',
                data: {
                    ctrlno: ctrlno,
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
                        r[9] = `BARANGAY NAME`
                        r[10] = `CONTACTNO`
                        r[11] = `EMAIL`
                        r[12] = `grs_type`
                        r[13] = `DESCRIPTION`
                        r[14] = `EOOB`
                        r[15] = `DATE_REPORTED`
                        r[16] = `source`
                        r[17] = `status`
                        r[18] = `DATE_SUBMITTED`
                        r[19] = `DATE_RESOLVED`
                        r[20] = `fullname`
                        r[21] = `DATE_ENCODED`
                        r[22] = `Remarks`

                    */
                            //*** im here
                    $('#txtEdFirstName').val(arr[1]);
                    $('#txtEdMiddleName').val(arr[2]);
                    $('#txtEdLastName').val(arr[3]);
                    $('#txtEdExt').val(arr[4]);



                }
            });

            //$("#dtDateConducted").val(date_conducted);
            //get title 
            //get intervention details

        } else {
            //* LOAD DATA ENTRY FOR NEW INTERVENTION

            $('#interv_list_editor_modal_label').html('New Grievance');

            //get interv component values
            $.ajax({
                type: 'GET',
                url: './proc/getComboData.php',
                data: {
                    tableName: "lib_comp",
                    valueMember: "comp_id",
                    displayMember: "comp_desc",
                    condition: "comp_id > 0",
                    selected: "-1"
                },
                success: function(response) {

                    $('#cmbEdProvince').html(response);

                    //reset
                    $('#cmbEdMunicipality').html('<option value="-1">Select</option>;');
                    $('#cmbEdBarangay').html('<option value="-1">Select</option>;');
                    $('#txtTitle').val('');
                    // $('#txtIntervDescription').val('');
                    $('#editor-one').html('');
                    $('#dtDateConducted').val(getCurrentDate());
                    $('#numYDS').val(0);
                    $('#hidden_interv_id').val(0);

                }
            });
        }

        //if edit mode then
        //load date entry for cmbEdMunicipality, cmbEdBarangay
        //select the values for each drop-down objects

    });

    function getCurrentDate() {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        return d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
    }

    //on change #cmbEdProvince
    $(document).on('change', "#cmbEdProvince", function(e) {
        e.preventDefault();
        var value = $(this).children("option:selected").val()

        //get interv component values
        $.ajax({
            type: 'GET',
            url: './proc/getComboData.php',
            data: {
                tableName: "lib_subcomp",
                valueMember: "subcomp_id",
                displayMember: "subcomp",
                condition: "comp_id = " + value,
            },
            success: function(response) {

                $('#cmbEdMunicipality').html(response);
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
                tableName: "lib_programs",
                valueMember: "program_id",
                displayMember: "program",
                condition: "subcomp_id = " + value,
            },
            success: function(response) {

                $('#cmbEdBarangay').html(response);
            }
        });
    });
</script>

<!-- INTERVENTION EDITOR Modal  -->
<div class="modal fade bd-example-modal-lg" id="interv_list_editor_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

                    <form>

<div class="x_content">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Complainant Info</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Grievance Info</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Adjudication</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="form-group">
                            <input type="hidden" name="hidden_interv_id" id="hidden_interv_id" value="0">
                            <input type="hidden" name="hidden_hhid" id="hidden_hhid" value="">
                            <label for="cmbEdProvince" class="control-label has-error">Province</label>
                            <select id="cmbEdProvince" name="cmbEdProvince" required="required" class="select form-control">
                                <option value="-1">Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cmbEdMunicipality" class="control-label">Municipality</label>
                            <select id="cmbEdMunicipality" name="cmbEdMunicipality" class="select form-control" required="required">
                                <option value="-1">Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cmbEdBarangay" class="control-label">Barangay</label>
                            <select id="cmbEdBarangay" name="cmbEdBarangay" class="select form-control" required="required">
                                <option value="-1">Select</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txtEdFirstName" class="control-label">First Name</label>
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
                                <input id="txtEdMiddleName" name="txtEdMiddleName" type="text" class="form-control" required="required" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtEdLastName" class="control-label">Last Name</label>
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
                                <input id="txtEdExt" name="txtEdExt" type="text" class="form-control" required="required" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtEdContactNo" class="control-label">Contact Number</label>
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
                                <input id="txtEdEmail" name="txtEdEmail" type="email" class="form-control" required="required" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="dtDateConducted" class="control-label">Date Conducted</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="dtDateConducted" name="dtDateConducted" type="date" class="form-control" required="required">
                            </div>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="form-group">
                            <label for="txtTitle" class="control-label">Title</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-amazon"></i>
                                </div>
                                <input id="txtTitle" name="txtTitle" type="text" class="form-control" required="required">
                            </div>
                        </div>
<!--                         
                        <div class="form-group">
                            <label for="txtIntervDescription" class="control-label">Intervention Details</label>
                            <textarea id="txtIntervDescription" name="txtIntervDescription" cols="40" rows="5" class="form-control" aria-describedby="txtIntervDescriptionHelpBlock" required="required"></textarea>
                            <span id="txtIntervDescriptionHelpBlock" class="help-block">State the comprehensive intervention</span>
                        </div>
 -->
                        <div class="form-group">
                            <label for="txtIntervDescription" class="control-label">Intervention Details</label>

                            <!-- editor-one wrapper -->
                            <div class="x_content">
                              <div id="alerts"></div>
                              <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                                <div class="btn-group">
                                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                  </ul>
                                </div>

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
                              <div id="editor-one" class="editor-wrapper"></div>
                              <textarea name="descr" id="descr" style="display:none;"></textarea>
                              <br />
                              <div class="ln_solid"></div>
                            </div>
                         <!-- /editor-one wrapper -->


                        </div>

                        <div class="form-group">
                            <button name="submit" type="submit" class="btn btn-primary" id=btnSubmitIntv name=btnSubmitIntv>Save</button>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk 
                      </div>
                    </div>
                  </div>







                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- /INTERVENTION EDITOR Modal  -->

