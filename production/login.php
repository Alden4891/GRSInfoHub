<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DSWD XII - Offline GRS v0.1! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

  </head>
<?php 
    if (isset($_REQUEST['cmd'])){
        if ($_REQUEST['cmd']=='logout'){
            $timeout = -1;
            setcookie('user_id', '', time() + ($timeout), "/"); 
            setcookie('fullname', '', time() + ($timeout), "/"); 
            setcookie('username', '', time() + ($timeout), "/"); 
            setcookie('password', '', time() + ($timeout), "/"); 
            //setcookie('role_id', '', time() + ($timeout), "/"); 
            setcookie('role', '', time() + ($timeout), "/"); 

            setcookie('branch_ids', '', time() + ($timeout), "/"); 


            setcookie('client_registration', '', time() + ($timeout), "/");
            setcookie('client_deletion', '', time() + ($timeout), "/");
            setcookie('payment_encoding', '', time() + ($timeout), "/");
            setcookie('mcpr_generation', '', time() + ($timeout), "/");
            setcookie('incentives_module', '', time() + ($timeout), "/");
            setcookie('audittrail', '', time() + ($timeout), "/");
            setcookie('settings_useraccounts', '', time() + ($timeout), "/");
            setcookie('settings_accessroles', '', time() + ($timeout), "/");
            setcookie('settings_dbbackup', '', time() + ($timeout), "/");
            setcookie('settings_dbrestore', '', time() + ($timeout), "/");
            setcookie('filemaintenance_agents', '', time() + ($timeout), "/");
            setcookie('filemaintenance_branches', '', time() + ($timeout), "/");
            setcookie('filemaintenance_plans', '', time() + ($timeout), "/");
            setcookie('reports_incentives', '', time() + ($timeout), "/");
            setcookie('reports_audittrails', '', time() + ($timeout), "/");
            setcookie('accounting', '', time() + ($timeout), "/");
            setcookie('burial', '', time() + ($timeout), "/");


            echo "<script>
            window.location = \"login.php\";
            </script>";
        }
    }
    include "dbconnect.php";
?>

  <body class="login">
    <div>


      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="container" novalidate="" action="/echo" method="POST" id="myForm">
              <h1>Login Form</h1>

                <div class="control-group">
                  <div class="controls">
                    <input type="text" id="username" placeholder="username" name="username"  class="form-control" required>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <input type="password" id="password" placeholder="password" name="password"  class="form-control" required>
                  </div>
                </div>

<!--               <div>
                <input id=username type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input id=password type="password" class="form-control" placeholder="Password" required="" />
              </div>
 -->              <div>
                <button type="submit" class="btn btn-default submit" id="btnSubmit" href="index.html" >Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="./images/dswd-logo-gray.svg" style="width: 40px;fill:#ffffff;"> DSWD XII Offline GRS v0.1!</h1>
                  <p>DSWD XII © 2020 All Rights Reserved.</p>
                </div>
                              <div id=rmessagebox></div>

              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form class="container" novalidate="" action="/echo" method="POST" id="myForm2">
              <h1>Create Account</h1>
                <div class="control-group">
                
                    <input type="text" id="rfullname" placeholder="Fullname" name="rfullname"  class="form-control" required>
                    <!-- <div class="invalid-feedback">Sorry, you missed this one.</div> -->
                </div>

                <div class="control-group">
                  <div class="controls">
                    <input type="email" id="remail" placeholder="Email" name="remail"  class="form-control" required>
                  </div>
                </div>


                <div class="control-group" >
                  <div class="controls">
                    <input type="text" id="rposition" placeholder="Position" name="rposition"  class="form-control" required>
                  </div>
                </div>

                <div class="control-group" >
                  <div class="controls">
                    <input type="text" id="rassignment" placeholder="Area of Assignment" name="rassignment"  class="form-control" required>
                  </div>
                </div>

                <div class="control-group" >
                  <div class="controls">
                    <input type="text" id="rusername" placeholder="Username" name="rusername"  class="form-control" required>
                  </div>
                </div>
            
                <div class="control-group" >
                  <!-- Password-->
                  <div class="controls">
                    <input type="password" id="rpassword1" placeholder="Password"  name="rpassword1"  class="form-control" required>
                  </div>
                </div>
             
                <div class="control-group" >
                  <!-- Password -->
                  <div class="controls">
                    <input type="password" id="rpassword2" placeholder="Confirm Password" name="rpassword2"  class="form-control " disabled required>
                  </div>
                </div>



                <button type="submit" class="btn btn-default submit" id="btnSubmit2" href="index.html" >Register</button>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="./images/dswd-logo-gray.svg" style="width: 40px;fill:#ffffff;"> DSWDI Offline GRS v0.1!</h1>
                  <p>DSWD XII © 2020 All Rights Reserved.</p>

                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>


<!-- 
<form class="container" novalidate="" action="/echo" method="POST" id="myForm">
    <div class="form-group">
        <label class="form-control-label" for="inputSuccess1">Enter some input</label>
        <input type="text" class="form-control" name="i1" id="inputSuccess1" required>
        <div class="valid-feedback">Success! You've done it.</div>
        <div class="invalid-feedback">No, you missed this one.</div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="inputSuccess2">Enter some input</label>
        <input type="text" class="form-control" name="i2" required id="inputSuccess2">
        <div class="valid-feedback">Nice! You got this one!</div>
        <div class="invalid-feedback">Sorry, you missed this one.</div>
    </div>
    <div>
        <button type="submit" class="btn btn-secondary" id="btnSubmit">Try It!</button>
    </div>
</form>
<hr>
<form class="container">
    <div class="form-group">
        <label class="form-control-label" for="inputSuccess3">Input with <code>is-valid</code></label>
        <input type="text" class="form-control is-valid" id="inputSuccess3">
        <div class="valid-feedback">Success! You've done it.</div>
    </div>
</form>
 -->

    <!-- buttom page: above the closing body tag -->
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
<script>


//login
$("#btnSubmit").click(function(event) {
    event.preventDefault(); // avoid to execute the actual submit of the form.
    var error_count = 0;

    // Fetch form to apply custom Bootstrap validation
    var form = $("#myForm")
    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
      form.addClass('was-validated');
    // Perform ajax submit here...
    
    if ($('#username').val().trim()=='') {
        $('#messagebox').hide();
        $('#messagebox').fadeIn('slow');
        $('#messagebox').html('<br><div class="alert alert-danger">Plese enter username!.</div>');
        $('#username').focus();

        exit();
    }


    if (error_count==0){
      //send POST here

        $.ajax({  
            type: 'GET',
            url: './proc/login_proc.php', 
            data: { 
                username:$('#username').val(),
                password:$('#password').val(),
                mode:$('#mode').val()
            },
            success: function(response) {
                 //prompt(response,response);
                 if (response.indexOf("**success**") > -1){
                     window.location.href = 'index.php';
                   
                 }else if (response.indexOf("**failed**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">Access Denied!.</div>')
                 }else if (response.indexOf("**ms**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">Access Denied!. This account is not for memorial system</div>');

                 }else if (response.indexOf("**as**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">Access Denied!. This account is not for accounting system</div>');
                 }else if (response.indexOf("**is**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">Access Denied!. This account is not for information system</div>');

                 } else {
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">OPS. </div> <br>ERROR: '+response);                   
                 }


            }
        });


    } //if error ==0


});


$("#rpassword1").keyup(function() {
    if($(this).val().length > 7) {
        // $('#rpassword2').removeClass('');
         $("#rpassword2").prop('disabled',false);
    } else {
         // Disable submit button
         $("#rpassword2").prop('disabled',true);
    }
});

$("#btnSubmit2").click(function(event) {
    event.preventDefault();
    // Fetch form to apply custom Bootstrap validation
    var form = $("#myForm2")
    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
      form.addClass('was-validated');
    var error_count = 0;

    if ($('#rfullname').val().trim()=='') {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Plese enter fullname!.</div>')
        $('#rfullname').focus();
        error_count+=1;
        exit();
    }

    if ($('#remail').val().trim()=='') {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Plese enter email address!.</div>')
        $('#remail').focus();
        error_count+=1;
        exit();
    }

    if ($('#rposition').val().trim()=='') {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Plese enter your position/designation!.</div>')
        $('#rposition').focus();
        error_count+=1;
        exit();
    }

    if ($('#rassignment').val().trim()=='') {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Plese enter area of assignment!.</div>')
        $('#rassignment').focus();
        error_count+=1;
        exit();
    }



    if ($('#rrole').val()=='0'){
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Please select user role</div>')
        $('#rrole').focus();
        error_count+=1;
        exit();
    }

    if ($('#rusername').val().trim()=='') {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Plese enter username!.</div>')
        $('#rusername').focus();
        error_count+=1;
        exit();
    }

    if ($('#rpassword1').val().trim()=='') {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Plese enter password!.</div>')
        $('#rpassword1').focus();
        error_count+=1;
        exit();
    }

    if ($('#rpassword1').val().trim()!=$('#rpassword2').val().trim()) {
        $('#rmessagebox').hide();
        $('#rmessagebox').fadeIn('slow');
        $('#rmessagebox').html('<br><div class="alert alert-danger">Password missmatch!.</div>')
        $('#rpassword2').focus();
        error_count+=1;
        exit();
    }



    if (error_count==0){
      //send POST here
        

        $.ajax({  
            type: 'GET',
            url: './proc/userregistration_proc.php', 
            data: { 
                role_id:1,//$('#rrole').val(),
                fullname:$('#rfullname').val(),
                username:$('#rusername').val(),
                password :$('#rpassword1').val(),
                email :$('#remail').val(),
                assignment :$('#rassignment').val(),
                position :$('#rposition').val()
               
            },
            success: function(response) {
                 //prompt(response,response);
               
                 if (response.indexOf("**success**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-success">Registration Successful. You can now LOGIN</div>')
                    //$('#registrationModal').modal('hide')
                    window.location="login.php";
                 }else if (response.indexOf("**failed**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">Registration Failed!.</div>')
                 }else if (response.indexOf("**exists**") > -1){
                    $('#rmessagebox').hide();
                    $('#rmessagebox').fadeIn('slow');
                    $('#rmessagebox').html('<br><div class="alert alert-danger">Username already exists!.</div>')
                 }


            }
        });


    } //if error ==0

});


</script>