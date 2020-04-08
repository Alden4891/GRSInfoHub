<form method='post' action='' enctype="multipart/form-data">
   <input type="file" id='files' name="files[]" multiple><br>
   <input type="button" id="submit" value='Upload'>
</form>
<!-- Preview -->
<div id='preview'></div>
<script >
    $(document).ready(function(){

$('#submit').click(function(){
    
   var form_data = new FormData();

   // Read selected files
   var totalfiles = document.getElementById('files').files.length;
   for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", document.getElementById('files').files[index]);
   }

   // AJAX request
   $.ajax({
     url: 'upload.php', 
     type: 'post',
     data: form_data,
     //dataType: 'json',
     contentType: false,
     processData: false,
     success: function (response) {

         $('#preview').html(response);
         //alert(1);
         //console.log(response);
       // for(var index = 0; index < response.length; index++) {
       //   var src = response[index];

       //   // Add img element in <div id='preview'>
       //   $('#preview').append(src);
       // }

     }
   });

});

});

</script>