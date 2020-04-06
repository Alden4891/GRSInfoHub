
          <div class="">

            <div class="page-title">
              <div class="title_left">
                <h3>Household Roster</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upload/Update Household Roster</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-5 mail_list_column">

                        <form>
                          <div class="custom-file">
                            <input type="file"  class="custom-file-input" id="files" multiple accept=".xlsx;" name="files[]">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <br><br><button disabled id="btn_merge_roster" class="btn btn-sm btn-success btn-block" type="button">Upload</button>

                        </form>          

                    
                          <div class="mail_list" id="filelist">
                          </div>

                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-7 mail_view">
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                
                                <!-- <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button> -->
                                <button id="btn_refresh" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Reset"><i class="fa fa-refresh"></i></button>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"> </p>
                            </div>
                            <div class="col-md-12">
                              <h4> OUTPUT</h4>
                            </div>
                          </div>
                          <div class="view-mail">
                              <div name="displayOutput" id="displayOutput" style="max-height: 300px;min-height: 300px;border: 1px #000 dashed; overflow-y: scroll; width: 100%;" src="">
                                1. Browse and select the file to uplaod <br> 
                                2. You can upload multiple files<br> 
                                3. Files should be in Microsoft Excel Format (*.xlsx)<br> 
                                4. Total file size should not exceed to 100BM Limit.
                              </div>
                          </div>

                        </div>

                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


<Script>


$(document).ready(function(){


   $('#btn_refresh').on('click', function(e){
        e.preventDefault();
        location.reload();

   });

   $('#files').on('change', function(e){ 
       var totalfiles = document.getElementById('files').files.length;
       $('#filelist').html('');
       for (var index = 0; index < totalfiles; index++) {
            var fileName = e.target.files[index].name;
            $('#btn_merge_roster').removeAttr('disabled');
            $('#filelist').append('<div class="right"><i id="'+fileName+'" class="fa fa-check-square text-success"></i>  '+fileName+' <small></small></div>');
       }

        $('#displayOutput').html(totalfiles+' files ready for upload. Press upload button to begin.');
   });

   $(document).on('click', '#btn_merge_roster', function(e){
      e.preventDefault();
       $('#btn_merge_roster').attr('disabled');
       var form_data = new FormData();

       // Read selected files
       var totalfiles = document.getElementById('files').files.length;
       for (var index = 0; index < totalfiles; index++) {
          form_data.append("files[]", document.getElementById('files').files[index]);


       }
             
       // AJAX request
       $('#displayOutput').html(' Commencing file upload. <br>Please wait while the system is busy uploading your files.');
       
       $.ajax({
         url: 'proc/roster_upload_proc.php', 
         type: 'post',
         data: form_data,

         contentType: !1,
         cache: !1,
         processData: !1,

          xhrFields: {
              onprogress: function(e) {
                  //console.log(e.target.responseText)
                  $("#displayOutput").html(e.target.responseText);
                  $("#displayOutput").scrollTop(1000000);

                  //[fo12_family_roster_cotabato_city.xlsx] Completed rows: 84420
                  //var arr_resp = e.target.responseText.split('<br>');
                  //$('#fo12_family_roster_cotabato_city.xlsx')


                  //if (e.lengthComputable) {
                  //    console.log(e.loaded / e.total * 100 + '%');
                  //}
          }},
         success: function (response) {
         
          //console.log("response: " + response);
            $('#displayOutput').html(response);

         }
       });

       // $.ajax({
       //   url: 'proc/roster_upload_proc.php', 
       //   type: 'post',
       //   data: form_data,
       //   //dataType: 'json',
       //   //contentType: false,
       //   processData: false,
       //   success: function (response) {
         
       //    //console.log("response: " + response);
       //      $('#displayOutput').html(response);

       //   }
       // });

    });

});

</Script>