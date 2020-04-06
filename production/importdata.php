
          <div class="">

            <div class="page-title">
              <div class="title_left">
                <h3>Consolidate *.mit files</small></h3>
              </div>

<!--               <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Merger Files</h2>
<!--                     <ul class="nav navbar-right panel_toolbox">
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
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-5 mail_list_column">

                        <form>
                          <div class="custom-file">
                            <input type="file"  class="custom-file-input" id="files" multiple accept=".imt;" name="files[]">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <br><br><button disabled id="btn_merge_imt" class="btn btn-sm btn-success btn-block" type="button">Upload</button>

                        </form>          

                    
                          <div class="mail_list" id="filelist">
<!--                             <div class="right"><h3><i class="fa fa-check-square text-success"></i>  File 1 <small>Done!</small></h3></div>
                            <div class="right"><h3><i class="fa fa-check-square text-success"></i>  File 1 <small>Done!</small></h3></div>
                            <div class="right"><h3><i class="fa fa-check-square text-default"></i>  File 3 </h3></div>
 -->
                          </div>
                       



                        

                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-7 mail_view">
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
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
                              <div name="displayOutput" id="displayOutput" style="max-height: 400px;min-height: 300px;border: 1px #000 dashed; overflow-y: scroll; width: 100%;" src="">
                                
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
   // $(document).on('click', '#btn_merge_imt', function(e){
   //    e.preventDefault();
   //    var form_data = new FormData();
   //    alert(form_data);

   //   $.ajax({
   //          url: 'proc/imt_upload_proc.php', /*point to server-side PHP script */
   //          dataType: 'text',   what to expect back from the PHP script, if anything
   //          cache: false,
   //          contentType: false,
   //          processData: false,
   //          data: form_data,                         
   //          type: 'post',
   //          success: function(res){
   //             console.log(res);
   //          }
   //       });      
   //     });


$(document).ready(function(){
   $('#files').on('change', function(e){ 
       var totalfiles = document.getElementById('files').files.length;
       $('#filelist').html('');
       for (var index = 0; index < totalfiles; index++) {
            var fileName = e.target.files[index].name;
            $('#btn_merge_imt').removeAttr('disabled');
            $('#filelist').append('<div class="right"><h3><i class="fa fa-check-square text-success"></i>  '+fileName+' <small></small></h3></div>');
       }
   });
   $(document).on('click', '#btn_merge_imt', function(e){
      e.preventDefault();
       $('#btn_merge_imt').attr('disabled');
       var form_data = new FormData();

       // Read selected files
       var totalfiles = document.getElementById('files').files.length;
       for (var index = 0; index < totalfiles; index++) {
          form_data.append("files[]", document.getElementById('files').files[index]);

          //$('#filelist').append('<div class="right"><h3><i class="fa fa-check-square text-success"></i>  File 1 <small>Done!</small></h3></div>');

       }
             
       // AJAX request
       $.ajax({
         url: 'proc/imt_upload_proc.php', 
         type: 'post',
         data: form_data,
         //dataType: 'json',
         contentType: false,
         processData: false,
         success: function (response) {
         
          //console.log("response: " + response);
          $('#displayOutput').html(response);
           //console.log("length: " + response.length);
           // for(var index = 0; index < response.length; index++) {
           //   var src = response[index];
           //   console.log(src);
           //   // Add img element in <div id='preview'>
           //   //$('#preview').append('<img src="'+src+'" width="200px;" height="200px">');
           // }

         }
       });

    });

});

</Script>