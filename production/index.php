<!DOCTYPE html>
<html lang="en">


<?php
  date_default_timezone_set('Asia/Manila');
    $user_id = "";
    $role = "";
    $user_fullname = "";
    $user_password = "";

    if(!isset($_COOKIE['user_id'])) {
        header("Location: login.php"); /* Redirect browser */
        exit();
    } else {
        //echo "Value is: " . $_COOKIE['user_id'];
        $user_id = $_COOKIE['user_id'];
        $role = $_COOKIE['role'];
        $role_id = $_COOKIE['role_id'];

        $user_fullname  = $_COOKIE['fullname'];
        $user_password = $_COOKIE['password'];

    }

    $page = (isset($_REQUEST['page'])?$_REQUEST['page']:'');
    $cmd = (isset($_REQUEST['cmd'])?$_REQUEST['cmd']:'none');


    $SETTINGS_HIDER = "";
    if ($role_id==2){
      $SETTINGS_HIDER = "hidden";
    }


    include 'dbconnect.php';



?>


  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>DSWD XII | GRS Info Hub v0.1</title>

    <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script> -->
    <script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- ***************************************************************************** -->
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- ***************************************************************************** -->


    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">


    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"> <img src="./images/dswd-logo.svg" style="width: 40px;"> <span>GRS Info Hub V0.1</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="image.php?user_id=<?=$user_id?>" alt="..." class="img-circle profile_img">
              </div>

              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$user_fullname?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> DASHBAORD</span></a></li>
                  <li><a href="?page=grievances"><i class="fa fa-child"></i> GRIEVANCES</span></a></li>
                   <li><a><i class="fa fa-exchange"></i> DATA MANAGEMENT <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?page=importdata">CONSOLIDATE DATA</a></li>
                      <li><a href="?page=exportdata">GENERATE DATA</a></li>
                    </ul>
                  </li>
                  <li><a href="?page=reports"><i class="fa fa-area-chart"></i> REPORTS</span></a></li>
                  <!-- <li><a href="?page=debug"><i class="fa fa-flash"></i> DEBUGGER</span></a></li> -->
                </ul>
              </div>
              <div class="menu_section">

              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="image.php?user_id=<?=$user_id?>" alt=""><?=$user_fullname?> 

                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="#" id="upload_photo"
                        data-toggle="modal"  data-target=".upload_photo_modal"> Change Photo</a>

                    <a class="dropdown-item"  href="#"  
                        data-toggle="modal" data-target=".modal_change_password"> Change Password</a>


                  
                    <a class="dropdown-item"  href="login.php?cmd=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
         
            <?php
                if ($page == 'grievances') {
                     include "grievances.php";
                   //include "interv_list.php";
                }else if ($page == 'reports'){
                   include "reports.php";
                }else if ($page=='' || $page == 'dashboard'){
                   include "dashboard.php";
                }else if ($page == 'importdata'){
                   include "importdata.php";
                // }else if ($page == 'importroster'){
                //    include "importroster.php";
                // }else if ($page == 'importswdi'){
                //    include "importswdi.php";
                }else if ($page == 'exportdata'){
                   include "exportdata.php";
                }else if ($page == 'debug'){
                   include "debug1.php";
                }else{
                              echo "
                            <br><br><br><br>
                            <div class=\"alert alert-danger text-center\">
                               <h2>You are not allowed to access this module. </h2>
                            </div>
                       
                     ";   
                               
                }                

          include 'dbclose.php';
          ?>
          


          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="row">
            <div class="col-sm">
              System Developer: <a href="mailto:aaquinones.fo12@dswd.gov.ph">Alden Quinones</a>
            </div>
            <div class="pull-right">
              GRS Info Hub by <a href="http://fo12.dswd.gov.ph" target="_blank">DSWD XII</a>
            </div>
            
          </div>

          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<div class="modal fade" id="previewGrievModal" tabindex="-1" role="dialog" aria-labelledby="previewGrievModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewGrievModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="previewGrievModalContent">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function (e) {


//preview interv.
$(document).on('click','#viewGriev',function(){

    var guid = $(this).attr('guid');
 
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
                  $('#previewGrievModalLabel').html('CTRL No.' + arr[0]);
                  $('#previewGrievModalContent').html(arr[13]);

                }
            });

});


//check file type
$('#imgfile').bind('change', function() {
    if (this.files[0].size > 1000000){
        $("#imgfile").replaceWith($("#imgfile").val('').clone(true));
        alert("The file is too huge. Please make sure that the file size will not exceed to 1MB");
        return;
    }else if ($('#imgfile').val().substr( ($('#imgfile').val().lastIndexOf('.') +1)) != 'jpg'){
        $("#imgfile").replaceWith($("#imgfile").val('').clone(true));
        alert("Invalid file type. Please select jpg file format!");
        return;        
    }
});

//SAVE form
$('#uploadfile2').on("submit",function (e) {
    e.preventDefault();  

     $.ajax({  
        contentType: false,       
        cache: false,             
        processData:false,        
        type: 'POST',
        url: 'proc/upload_profile_photo_proc.php', 
        data: new FormData(this),
        success: function(response) {
             //alert(response);
             if (response.indexOf("**success**") > -1){
                alert('Pofile Picture successfully updated.');
                window.location="index.php";
             }else if (response.indexOf("Notice") > -1){
                alert("Upload failed: An error has occured while uploading data. Please contact your system developer. ");
             }
        }
    });       
});


});


 




  //CHANGE PASSOWRD
    $(document).on('click','#btn_change_password_submit',function(e){
        e.preventDefault();
        
        var cur_password = "<?=$user_password?>";
        var user_inputed_cur_password = $('#current_password').val();
        var user_inputed_new_password = $('#new_passowrd').val();
        var user_inputed_ver_password = $('#verify_password').val();

        var error_count = 0;
        // console.log('cur_password: '+cur_password);
        if (user_inputed_cur_password == '') {
            $('#current_password').closest("div").addClass("has-error");
            $('#current_password').focus();
            alert('Current Password is required');
            return;            
        }else if (user_inputed_cur_password != cur_password){
            $('#current_password').closest("div").addClass("has-error");
            $('#current_password').focus();
            alert('Incorrect Current Password');
            return;            
        }else if (user_inputed_new_password == '') {
        //}else if (user_inputed_new_password.len) {
            $('#new_passowrd').closest("div").addClass("has-error");
            $('#new_passowrd').focus();
            alert('You forgot to enter your password');
            return;            
        }else if (user_inputed_new_password != user_inputed_ver_password) {
            $('#verify_password').closest("div").addClass("has-error");
            $('#verify_password').focus();
            alert('Password mismatch');
            return;            
        }

           $.ajax({  
              type: 'GET',
              url: './proc/change_password_proc.php', 
              data: { 
                  passowrd:user_inputed_new_password,
                  user_id:"<?=$user_id?>"
              },
              success: function(response) {
                   if (response.indexOf("**success**") > -1){
                      $('#current_password').val('');
                      $('#new_passowrd').val('');
                      $('#verify_password').val('');
                      alert('Password changed! You have to logout to take effect.');          
                   }else if (response.indexOf("**failed**") > -1){
                      alert("Change password failed!");
                     
                   }
                   
              }
          }); 
        


    });

    $("#new_passowrd").keyup(function() {
        if($(this).val().length > 7) {
            // $('#rpassword2').removeClass('');
             $("#verify_password").prop('disabled',false);
        } else {
             // Disable submit button
             $("#verify_password").val('');
             $("#verify_password").prop('disabled',true);
        }
    });
    $("#current_password").keyup(function() {
        var cur_password = "<?=$user_password?>";

        if($(this).val() == cur_password) {
             $("#new_passowrd").prop('disabled',false);
        } else {
             // Disable submit button
             $("#new_passowrd").val('');
             $("#new_passowrd").prop('disabled',true);
        }
    });




  </script>






    <!-- daashboard - scripts ----------------------------------------------------------->
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
    <!-- <script src="../build/js/jquery.flot.axislabels.js"></script> -->
    <!-- /daashboard - scripts ----------------------------------------------------------->

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- ***************************************************************************** -->
    <!--* bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- ***************************************************************************** -->

	
  </body>
</html>




<div class="modal fade upload_photo_modal" id="upload_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
               <form id="uploadfile2" action="" method="post" enctype="multipart/form-data">

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-gg">
                    </i></span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="imgfile" name="imgfile" aria-describedby="inputGroupFileAddon01">
                    <input id="user_id" name="user_id" type="hidden" value="<?=$user_id?>"  />
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
                </div>                 

                 <div class="form-group">
                  <div class="pull-right">
                   <input type="submit" value="UPLOAD" class="btn btn-primary" id="btn_upload_photo"/ >
                  </div>
                 </div>
                 </form>
               </div>
              </div> 
      </div>

    </div>
  </div>
</div>

<div class="modal fade modal_change_password" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

              <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="post">

                 <div class="form-group ">
                  <label class="control-label " for="current_password">
                   Current Passowrd
                  </label>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <i class="fa fa-gg"></i></span>
  </div>
  <input type="password" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="current_password" name="current_password">
</div>

                 </div>



                 <div class="form-group ">
                  <label class="control-label " for="new_passowrd">
                   New Passowrd 
                  </label> (<i>must be 8 character lenght</i>)


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <i class="glyphicon glyphicon-ok-circle"></i></span>
  </div>
  <input type="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1" id="new_passowrd" name="new_passowrd">
</div>

                 <div class="form-group ">
                  <label class="control-label requiredField" for="verify_password">
                   Verify Passowrd
                   <span class="asteriskField">
                    *
                   </span>
                  </label>


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">  <i class="glyphicon glyphicon-eye-open"></i></span>
  </div>
  <input type="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1" id="verify_password" name="verify_password">
</div>

                 </div>


                 <div class="form-group">
                  <div>
                   <button class="btn btn-primary" id="btn_change_password_submit">
                    Save
                   </button>
                  </div>
                 </div>
                 </form>
               </div>
              </div>  


      </div>
    </div>
  </div>
</div>





<div class="modal fade bs-example-modal-sm about_modal" tabindex="-1" role="dialog" aria-labelledby="about_modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">About </h4>
            </div>
            <div class="modal-body">
              <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <b>App Name:</b> GRS Info Hub <br>
                  <b>Version :</b> 1.0 <br><hr>
                  <b>System Developer :</b> Alden A. Quinones | <a href="mailto:alden.roxy@gmail.com">alden.roxy@gmail.com</a><br>

               </div>
              </div>            
            </div>
   
    </div>
  </div>
</div>

