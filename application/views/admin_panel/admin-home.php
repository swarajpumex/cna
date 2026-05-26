<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $headTitle;?></title>
   <?php require_once("include-css.php"); ?>
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include "header.php";?>
  <?php include "sidebar.php";?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Home
        <small><?php echo $headTitle;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("$adminController/adminHome");?>"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  <?php include "footer.php";?>

 






<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>js/common.js"></script> <!--- common js file-->


<script src="<?php echo base_url(); ?>plugins/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
<script type="text/javascript">

var BASE_URL 			= "<?php echo base_url();?>";
var ADMIN_CONTROLLER    = "<?php echo $adminController;?>";

//------------------------------ NOTIFICATION AUTO LOAD AND HIDE -------------------	
		$("#notificationMenu").click(function(){
			
			if($("#notificationTotal").html()!="")
				{
					//$("#notificationDropdown").show();
					$("#notificationTotal").html("");
				}
               else
			   {
				 $("#notificationContent").hide("");    
			   } 
				   
			});
//------------------------------ NOTIFICATION AUTO LOAD AND HIDE : END -------------------	


//$(document).ready(function(){

	var dataValid = true;
				
		$.ajaxSetup({  //This will change behavior of all subsequent ajax requests!!
                async: false   
                });
		  	
			
			
		
		$('#Loading').hide(); // loading gif image is hiding initially.
		
		
	
		
		
		
		/*

			//--------------- checking number fields ------------------
			
			if(cur.hasClass('number'))
				{
					if (isNaN(cur.val()))
						{
							cur.after('<span class="error"> Must be a number</span>');
							cur.data('valid', false);	
						}
					else
						{
							dataValid = true;
							cur.data('valid', true);
						}
				}
		 }
	
		 */
		 //--------------------------- CONTACT SEND BUTTON CLICK HANDLING----------------------------
		 
		 	$('#btnSubmit').click(function()
				{
				
				
					dataValid = true;
					var errList ="";
					var errorMsg 		 =	'<strong>Error !</strong><hr/><br/>';
					
					$('.required').each(function()
						{
							var current = $(this);
							//current.next().remove();
							if ($.trim(current.val()) =='' || $.trim(current.val())=='0') // second or is for Combobox Selection
							{	
								var name 	 = current.attr('name');
								
								name = replaceAll(name,"_"," ");// replaciing the _ to space for showing error field.
								
								errList +='<li>' + name +  ' is a required field.</li>';
								dataValid = false;
							}
						});
					
							//if(current.data('valid') != true)
							if(!dataValid)
							{
								
								errorMsg		+= 	'<ul class=\"errorList\">' + errList + '</ul>';
								$('#divError').show();
								$('.divError').html(errorMsg);
								return false;
							}
							else
							{
								$('#divError').hide();
								$('#divError').html('');
										
							}
							
								
			
					// ------ validating email id  using regular expressions-----
			
			$('.email').each(function() 
			{
					var cur = $(this);
					var emailPattern = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
					var urlPattern ="";
					if (!emailPattern.test(cur.val()))	
					 {
						
						errList 		='<li>Please enter a valid email.</li>'; 
						errorMsg		+= 	'<ul class=\"errorList\">' + errList + '</ul>';
						
						$('#divError').show();
						$('#divError').html(errorMsg);
						dataValid = false;
					}
			});
		
		
			// ------ validating URL -----
		
			
 		
				
			 $('.number').each(function()
				{
					var current = $(this);
					if(current.data('valid') != true)
						{
							//cur.after('<span class="error"> Invalid Number</span>');
							//dataValid = false;
						}
				});
			 
			 $('.phonenumber').each(function()
				{
					
					var current = $(this);
					if (!isValidPhoneNumber(cur.val()))	
						{
							errList 		='<li>Please enter a valid mobile number.</li>'; 
							errorMsg		+= 	'<ul class=\"errorList\">' + errList + '</ul>';
						
							$('.divError').show();
							$('.divError').html(errorMsg);
							dataValid = false;
						}
				});
			 
			 
				

				var data ="";
				data = $('#changePassForm').serialize();
				
				
				
				if(dataValid)
					{
						
						// checking password matching
						
						
							
						// SEND data through AJAX here ...  
						
						var url ="";
						url ='save_singlefloor.php';
					
						$('#divMessage').html("Please wait...");
						$('#divMessage').show();
						
						
						// ---- AJAX POSTING ----
						$.post(
						url,
						data,
						function(res)
							{
								
								$('#divError').hide();
								$('#divMessage').hide();
								
								
								//alert(res);
								//return;
								
								if(res.search("Missing")>=0 || res.search("Error")>=0)
								{
									$('.divError').show();
									$('.divError').html(res);
								}
								else
								{
									$('#divMessage').show();
									$('#divMessage').html(res);
									clearAll();
								}
							
								
								//$('#information').hide();
								//$('#response').html(data).show();
								
								
							},
						'html'
						);
				
					
					}
				
			});




//}); // Document Ready Ending

$("#changePassword").click(function(event){
		$('#divError').hide();
		$('#divMessage').hide();
		$("#toDoForm").modal('hide');
		$("#changePasswordForm").modal('show');
	});
	
<!-------  for loggined user avatar change : start ----------------------->
$(".changeImage").click(function(){
	 document.getElementById("changeAvatar").click();
});

$("#changeAvatar").change(uploadPic);

function uploadPic()
{
	var formData = new FormData("#avatar-form");
	var fileField = _('changeAvatar');
	
	if(fileField.files[0]==null || fileField.files[0]=="")
		return false;
	
	formData.append('userfile', fileField.files[0]);
	formData.append('li_token', $("#li_token").val());
	formData.append('li_token', $("#li_token").val());
	formData.append('Id', <?php echo $_SESSION['ADMIN_LOGIN_ID'];?>);
	
	
	var url = BASE_URL + "index.php/" + ADMIN_CONTROLLER + "/editUserPhoto";

		$.ajax({
        url : url,
        type: "POST",
        data:  formData,
        dataType: "text",
        processData: false,
        contentType: false,
    	cache: false,
        enctype: 'multipart/form-data',
        success: function(res)
        {
			window.location.reload();
		},
		error:function(xhr,textStatus, errorThrown)
		{
			 
		}
	 });	
}
<!-------  for loggined user avatar change : end ----------------------->

//------------------ THIS IS FOR New Order Notification in Every minute --------------------
$(document).ready(function(){
	
			
		
	
	
/*	
 setInterval(function() {   //calls event after a certain time	
   
   var url="<?php echo base_url();?>index.php/ashrayaAd/getNewOrderNotification"; 
   var orderPageLink ="<?php echo base_url();?>ashrayaAd/orders";
	
	$.ajax({
            url : url,
            type: "POST",
            dataType: "text",
        success: function(data)
        {
			if(data.indexOf("true")>=0)
			{	
				var orderMsg ="You have received a new order.";
				Lobibox.notify('info', {
                    msg: orderMsg
               
				});	
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR.responseText);
                
            
            }
        }); // ajax ending.
     
   }, 10000); // notification in every 1 minute.
	
	*/
	
});// document ending...


</script>
</body>
</html>
