<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?>| Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
  <!--- common for all -->
  <link rel="stylesheet" href="<?php echo base_url('css/common.css');?>">
  <!--- Fav Icon -->
 <link href="<?php echo base_url();?>img/favicon.png" rel="shortcut icon">
 
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
     <a href="#"><b><?php echo $title?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post" onSubmit="return false;" id='loginForm' name="loginForm">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="UserId" required id="userId" name="userId">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" required id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" id="btnSubmit" class="btn btn-primary btn-block btn-flat">Sign In</button>
		 
        </div>
        <!-- /.col -->
      </div>
	  <div class="alert alert-danger divError" style="display:none;" id="divError"></div>
	  
    </form>

   
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    

    $("#btnSubmit").text("Sign In");
    $("#btnSubmit").removeAttr('disabled');
    
	$("#btnSubmit").click(function(){
	
	  var uid=	$("#userId").val();
	  var pass = $("#password").val();
	  var msg = "<strong>Error!</strong><br/> Both fields are mandatory.";
	  
	  if(uid=="" || uid==null)
	  {
	  		$("#divError").html(msg);
			$("#divError").show();
			return false;
	  }
	  
	  if(pass=="" || pass==null)
	  {
	  		$("#divError").html(msg);
			$("#divError").show();
			return false;
	  }
	  	$("#divError").hide();
		
		$("#btnSubmit").text("Login...");
		$("#btnSubmit").attr('disabled',true);
		
		
		var URL = "<?php echo base_url();?>index.php/";
                URL +="<?php echo $adminController;?>/adminLoginCheck";
		var Data = $("#loginForm").serialize()+"&li_token="+$("#csrf-token").attr('content');
		//Ajax submit start 
	    
	
var request = $.ajax({
		url : URL,
		 async:false,
		type: "POST",
		data: Data,
		dataType: "json" 
});

request.done(function ( response) {
var URL = "<?php echo base_url();?>";
                 	URL +="<?php echo $adminController;?>/adminhome";
		
			
			if(response.status)
				window.location=URL;
		        else{
				var msg = "<strong>Error!</strong><br/> Invalid user id or password.";
				$("#divError").html(msg);
				$("#divError").show();
				document.forms[0].reset();
				$("#btnSubmit").text("Sign In");
				$("#btnSubmit").removeAttr('disabled');
		
				return false; }
});
request.fail(function (jqXHR, textStatus) {
    alert('Error get data from ajax :' + jqXHR.responseText);
});

		
		
	
	});
	
	
	
	
  });
</script>
</body>
</html>
