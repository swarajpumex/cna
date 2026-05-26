
 <!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

<!-- Boot strap datepicker -->
<script src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js" ></script>

<!-- bootbox-->
<script src="<?php echo base_url(); ?>assets/bootbox-modal/bootbox.min.js"></script>

<!-- for validation -->
<script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/vender/intl-tel-input/js/intlTelInput.min.js"></script>


<!--- For  google recaptcha -->
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer"></script>
<script src="<?php echo base_url(); ?>js/for-recaptcha.js"></script> <!--- for showing recaptcha more than 1 field in a page-->

<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>



<!-- common javascript file -->
<script src="<?php echo base_url(); ?>js/common.js"></script>

<!--- for facy box pop up --->
<script src="<?php echo base_url(); ?>js/jquery.fancybox.min.js"></script>

<!-- for new order  pop up notifications -->
<script src="<?php echo base_url(); ?>notification/js/Lobibox.js"></script>

<script>
    $(".fancybox").fancybox({
   openEffect  : "fade",
   closeEffect : "fade",
   type : "image"
});


var BASE_URL= $("#hidBASE_URL").val();
var ADMIN_CONTROLLER = $("#hidAdminController").val();
var CSRF_TOCKEN 	= $("#csrf-token").attr('content'); // FOR CSRF for every ajax request.
var CSRF_NAME		= $("#csrf-name").attr('content');  // FOR CSRF for every ajax request.


$('#btnChangePass').click(function(){
	var formUtils = {
    
    //if no form errors, remove or hide error messages
    clearErrors: function () {
      $('#emailAlert').remove();
      $('#form_chpass .help-block').hide();
      $('#form_chpass .form-group').removeClass('has-error');
    },
    //upon form clear remove the checked class and replace with unchecked class. Also reset Google ReCaptcha
    clearForm: function () {
      $('#form_chpass .glyphicon').removeClass('glyphicon-check').addClass('glyphicon-unchecked').css({color: ''});
      $('#form_chpass input,textarea').val("");
      
    },
    //when error, show error messages and track that error exists
    addError: function ($input) {
      var parentFormGroup = $input.parents('.form-group');
      parentFormGroup.children('.help-block').show();
      parentFormGroup.addClass('has-error');
    },
    addAjaxMessage: function(msg, isError) {
      $("#btnChangePass").after('<div id="emailAlert" class="alert alert-' + (isError ? 'danger' : 'success') + '" style="margin-top: 5px;">' + $('<div/>').text(msg).html() + '</div>');
    }
  }
  var $form = $("#form_chpass"),
        hasErrors = false;
      if ($form.validator) {
        hasErrors =  $form.validator('validate').hasErrors;
      } else {
        $('#form_chpass input, #form_chpass textarea').not('.optional').each(function() {
          var $this = $(this);
		  if($this.val()=="")
		  {
			hasErrors=true;
			formUtils.addError($(this));
		  }
		});
		
      }
	  if (hasErrors) {
		
		var errorMsg	 = '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
                    errorMsg	+='<strong style="color:white;">Error ! Missing required fields.</strong>';
						
		$('#divErrorChPass').show();
		$('#divErrorChPass').html(errorMsg);
        
        // error msg alert closing in 2 sec.
        $("#divErrorChPass").fadeTo(2000, 500).slideUp(500, function(){
				$(".alert").hide();
          });                       
        
        return false;
      }
	  if($('#Confirm_Pass').val()!=$("#New_Password").val()){
		  alert("hi");
		  hasErrors=true;
		  formUtils.addError($('#Confirm_Pass'));
		  var errorMsg	 = '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
                    errorMsg	+='<strong style="color:white;">Error ! Password Mismatch.</strong>';
						
		$('#divErrorChPass').show();
		$('#divErrorChPass').html(errorMsg);
        
        // error msg alert closing in 2 sec.
        $("#divErrorChPass").fadeTo(2000, 500).slideUp(500, function(){
				$(".alert").hide();
          });                       
        
        return false;
	  }
	  var Data=$("#form_chpass").serialize()+"&li_token="+CSRF_TOCKEN;
	  
	  $.ajax({
        url : $("#hidBASE_URL").val() + "index.php/" + ADMIN_CONTROLLER + "/saveChangePassword",
        type: "POST",
        dataType: "JSON",
		data:Data,
        success: function(res)
        {
			if(!res.status){
				var errorMsg	 = '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
                    errorMsg	+='<strong style="color:white;">Error ! Invalid Current Password.</strong>';
						
				$('#divErrorChPass').show();
				$('#divErrorChPass').html(errorMsg);
        
				// error msg alert closing in 2 sec.
				$("#divErrorChPass").fadeTo(2000, 500).slideUp(500, function(){
					$(".alert").hide();
				});                       
        
				return false;
			}
			var msg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
				msg	+='<strong style="color:white;">Success! Password has been Changed successfully!.</strong>';
				$('#divMessageChPass').html(msg);
				$('#divMessageChPass').show();
				
				// For message alert closing in 2 sec.
				$("#divMessageChPass").fadeTo(1000, 500).slideUp(500, function(){
				
				$(".alert").hide();
			
				$('#modal_form_chpass').modal('hide');
				});

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
     
});
</script>