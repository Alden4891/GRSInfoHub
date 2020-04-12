

<!-- Large modal -->
<button type="button" class="btn btn-primary" 
data-backdrop="static" data-keyboard="false"
data-toggle="modal" data-target="#modal_peview_grievance" guid="5e8f1e188ef79" id="btn_griev_preview">Large modal</button>



<!-- GRIEVANCE PREVIEW MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_peview_grievance">
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
                              <i class="fa fa-globe"></i> CTRL No. 234567890-1231231232
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
                    <h2>Grievance Description</h2>

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




<script>
	$(document).on('click', '#btn_griev_preview',function (e){
		e.preventDefault();

            //get grievance details
            var guid = $(this).attr('guid');

            $.ajax({
                type: 'GET',
                url: './proc/getGrievanceInfo.php',
                data: {
                    guid: guid,
                },
                success: function(response) {
                    
                	console.log(response);
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
                        r[19] = `DATE_RESOLVED`
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
                    $('#ci_name').html(arr[1] + ' ' +  arr[2] + ' ' + arr[3]);
                    $('#ci_contact').html(arr[10]);
                    $('#ci_email').html(arr[11]);
                    $('#ci_prov').html(arr[7]);
                    $('#ci_muni').html(arr[8]);
                    $('#ci_brgy').html(arr[9]);

                    //grievacnce information
                    $('#gi_gcategory').html(arr[12]);
                    $('#gi_gtype').html(arr[29]);
                    $('#gi_eodb').html(arr[14]);
                    $('#gi_date_reported').html(arr[15]);
                    $('#gi_gsource').html(arr[16]);
                    $('#gi_assessedby').html(arr[20]);
                    $('#gi_description').html(arr[13]);

                    //grievance status
                    $('#gs_status').html(arr[17]);
                    $('#gi_remarks').html(arr[22]);


		              var today = new Date();
		              var diffMs = (today-arr[15]); // milliseconds between now & Christmas
		              
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


<?php
function dt_difference($dateStart, $dateEnd) {
    $start = sqlInt($dateStart);
    $end = sqlInt($dateEnd);
    $difference = $end - $start;
    $result = array();
    $result['ms'] = $difference;
    $result['hours'] = $difference/3600;
    $result['minutes'] = $difference/60;
    $result['days'] = $difference/86400;
    return $result;
}

?>