
var table;
var BASE_URL= $("#hidBASE_URL").val();
var ADMIN_CONTROLLER = $("#hidAdminController").val();

var CSRF_TOCKEN 	= $("#csrf-token").attr('content'); // FOR CSRF for every ajax request.
var CSRF_NAME		= $("#csrf-name").attr('content');  // FOR CSRF for every ajax request.
	
/////////////////////// CHANGE THESE URLS  FOR AJAX //////////////////////////////////////////////////////////////////////////////

$(document).ready(function() {

 
  
//=================================================================================================================================
 

$.widget.bridge('uibutton', $.ui.button);

var save_method; //for save method string

    //datatables
    table = $('#dataTable').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "ordering": true,
        "searching": true,
		
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": BASE_URL + "index.php/" + ADMIN_CONTROLLER +"/userList", //<?php echo site_url('person/ajax_list')?>
            "type": "POST",
			"data": {li_token :CSRF_TOCKEN}, // for Cross Site Request Forgery, here li_token is should
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
			
        },
		{ "targets": [2], "searchable": true, "orderable": false, "visible": true }, // Show Count column
		{ "targets": [3], "searchable": true, "orderable": false, "visible": true }, // Count Title Column
		{ "targets": [4], "searchable": true, "orderable": false, "visible": true }, // linkPage Column
		
        ],
		

    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

  
    
  // $('#example1').DataTable({});

});


function addData()
{
    save_method = 'add';
	$('#btnSave').text('Save'); //change button text
    $('#btnSave').removeAttr('disabled'); //set button disable
	$('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add New'); // Set Title to Bootstrap modal title
    
    //showing image upload area when add data.
    $('#hideWhenEdit').show();

    $("#divError").hide();
    $("#divMessage").hide();
    $('#hidID').val("0");
}


function editData(id)
{
    var EDIT_URL  =  $("#hidBASE_URL").val() + "index.php/" + ADMIN_CONTROLLER + "/getEditUser";
	
	save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    
    // hiding image upload area when editing data.
    $('#hideWhenEdit').hide();
    
    $("#divError").hide();
    $("#divMessage").hide();
	
    //Ajax Load data from ajax
    $.ajax({
        url : EDIT_URL + "/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.Id);
	    $('[name="hidID"]').val(data.Id);
			
            $('[name="User_Id"]').val(data.UserId);
            $('[name="User_Group"]').val(data.UserGropId);
            //$('[name="dob"]').datepicker('update',data.dob);
            $('[name="Password"]').val("xxxxxxxxxxxxxx");
            $('[name="Retype_Password"]').val("xxxxxxxxxxxxxx");
            $('[name="Count_Title"]').val(data.countTitle);
			$('[name="Sex"]').val(data.Sex);
			$('[name="Status"]').val(data.Status);
			
			$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function reloadTable()
{
   
    table.ajax.reload(null,false); //reload datatable ajax 
}


function save()
{
    
    
    
    //------------------------------- VALIDATION START -----

var formUtils = {
    isValidEmail: function (email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    },
    //if no form errors, remove or hide error messages
    clearErrors: function () {
      $('#emailAlert').remove();
      $('#form .help-block').hide();
      $('#form .form-group').removeClass('has-error');
    },
    //upon form clear remove the checked class and replace with unchecked class. Also reset Google ReCaptcha
    clearForm: function () {
      $('#form .glyphicon').removeClass('glyphicon-check').addClass('glyphicon-unchecked').css({color: ''});
      $('#form input,textarea').val("");
      
    },
    //when error, show error messages and track that error exists
    addError: function ($input) {
      var parentFormGroup = $input.parents('.form-group');
      parentFormGroup.children('.help-block').show();
      parentFormGroup.addClass('has-error');
    },
    addAjaxMessage: function(msg, isError) {
      $("#btnSave").after('<div id="emailAlert" class="alert alert-' + (isError ? 'danger' : 'success') + '" style="margin-top: 5px;">' + $('<div/>').text(msg).html() + '</div>');
    }
  };
  
    
    var url;
    var base_url;
    var adminController;

      var $btn = $(this);
      $btn.val('Saving');
      formUtils.clearErrors();

      var repass =false;
      //do a little client-side validation -- check that each field has a value and e-mail field is in proper format
      //use bootstrap validator (https://github.com/1000hz/bootstrap-validator) if provided, otherwise a bit of custom validation
      var $form = $("#form"),
        hasErrors = false;
      if ($form.validator) {
        hasErrors =  $form.validator('validate').hasErrors;
      } else {
        $('#form input, #form textarea').not('.optional').each(function() {
          var $this = $(this);
	  
          if (($this.is(':checkbox') && !$this.is(':checked')) || !$this.val()) {
            hasErrors = true;
            formUtils.addError($(this));
          }
		
          //------ validating comboboxes -----
		
		var $userGroup = $('#User_Group');
		var $sex       = $('#Sex');
                
		if ($userGroup.val()==""){
			
			hasErrors = true;
			formUtils.addError($userGroup.parent());
		  }
                  
                 if ($sex.val()==""){
			
			hasErrors = true;
			formUtils.addError($sex.parent());
		  } 
                  
           // matching password fields
           
           	var $password = $('#Password');
                var $rePassword = $('#Retype_Password');
		
                
		if ($password.val()!=$rePassword.val()){
			
			repass = true;
			formUtils.addError($rePassword.parent());
		  } 
           
           
		  
        });
     		
      }
     
      if (hasErrors) {
		
		var errorMsg	 = '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
                    errorMsg	+='<strong style="color:white;">Error ! Missing required fields.</strong>';
						
		$('#divError').show();
		$('#divError').html(errorMsg);
        $btn.val('reset');
        
        // error msg alert closing in 2 sec.
        $("#divError").fadeTo(2000, 500).slideUp(500, function(){
	  $(".alert").hide();
          });                       
        
        return false;
      }

        //---------------------- Repass checking --->
      if (repass) {
		
		var errorMsg	 = '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
                    errorMsg	+='<strong style="color:white;">Error ! Miss matching password and retype password fields.</strong>';
		$('#divError').show();
		$('#divError').html(errorMsg);
        $btn.val('reset');
        
        // error msg alert closing in 2 sec.
        $("#divError").fadeTo(2000, 500).slideUp(500, function(){
	  $(".alert").hide();
          });                       
        
        return false;
      }
      

    
    $(".alert").hide(); // hiding all the message alert.
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 

    if(save_method == 'add') {
        base_url = $("#hidBASE_URL").val(); // for delete after saving .
        adminController = $("#hidAdminController").val();
        
        url = $("#hidBASE_URL").val() + "index.php/" + ADMIN_CONTROLLER + "/saveUser";
    } 

  // ajax adding data to database
  // FormData is using for ajax file uploading.
  
 if (typeof FormData == 'undefined')
  {
      bootbox.alert("Oops,Your Browser Don't support FormData API! Use IE 10 or Above!");
      return false;
  }
  
         var formData = new FormData($('#form')[0]);
         var fileField = _('userfile'); // getting the file field object.
          
         formData.append('User_Id', $("#User_Id").val());
         
         //checking file are a is hidden or not. this is only for add data.
         
         if($("#hideWhenEdit").is(":visible")) 
            formData.append('userfile', fileField.files[0]); 
    
            //formData.append('userfile', $("#userfile").val());
       
         formData.append('User_Group', $("#User_Group").val());
         formData.append('Password', $("#Password").val()); // ####
         formData.append('Sex', $("#Sex").val());
         formData.append('Status', $("#Status").val());
         formData.append('hidID', $("#hidID").val()); // for save or edit.
		 formData.append('li_token', CSRF_TOCKEN);
         
    
    
   // alert(formData);
    //return;
    $.ajax({
        url : url,
        type: "POST",
         //data: $('#form').serialize(),
        data:  formData,
        dataType: "text",
        processData: false,
        contentType: false,
    	cache: false,
        enctype: 'multipart/form-data',
        success: function(res)
        {
		
		//console.log(res);
		//return;
             if(res.indexOf("Exists")>=0)
		  {
				var errorMsg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
				    errorMsg		+='<strong style="color:white;">Error ! This user id already exists.</strong>';
					
				$('#divError').show();
				$('#divError').html(errorMsg);
				$btn.val('reset');
                                              
                                reloadTable();
                                $("#hidBASE_URL").val(base_url); // for delete after load table.
                                $("#hidAdminController").val(adminController);
                                $('#upload-file-info').html(""); //clearing the file.
                                $('#btnSave').text('Save'); //change button text
                                $('#btnSave').attr('disabled',false); //set button enable 
				
                                return false;
		
		  }
                  
                  // if error
                  if(res.indexOf("Error")>=0)
		  {
				var errorMsg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
				    errorMsg		+='<strong style="color:white;">' + res +'</strong>';
					
				$('#divError').show();
				$('#divError').html(errorMsg);
				$btn.val('reset');
				        
                                reloadTable();
                                $("#hidBASE_URL").val(base_url); // for delete after load table.
                                $("#hidAdminController").val(adminController);
                                $('#upload-file-info').html(""); //clearing the file.
                                $('#btnSave').text('Save'); //change button text
                                $('#btnSave').attr('disabled',false); //set button enable 
				
                
                                return false;
		
		  }
                  
                  
     
            
            
            
                var saveOrEdit ="saved";
                var EDIT_ID = $("#hidID").val();
		if(EDIT_ID>0)
                    var saveOrEdit ="edited";
			
		  
		var msg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
			msg	+='<strong style="color:white;">Success! Data has been ' + saveOrEdit  + ' successfully!.</strong>';
			$('#divMessage').html(msg);
			$('#divMessage').show();
				
			// For message alert closing in 2 sec.
			$("#divMessage").fadeTo(2000, 500).slideUp(500, function(){
				
				$(".alert").hide();
				//$("#form")[0].reset(); // reseting form
			
			});
                $btn.val('Save');  
                if(EDIT_ID==0)
                     formUtils.clearForm();               
                
                //$('#modal_form').modal('hide');
                reloadTable();
                $("#hidBASE_URL").val(base_url); // for delete after load table.
                $("#hidAdminController").val(adminController);
                $('#upload-file-info').html(""); //clearing the file.
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            var errorMsg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
			errorMsg	+='<strong style="color:white;">Error ! Error while saving data.</strong>';
						
			$('#divError').show();
			$('#divError').html(errorMsg);
				
			// For message alert closing in 2 sec.
			$("#divError").fadeTo(2000, 500).slideUp(500, function(){
				
				$("#divError").hide();
				
			});
            
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function deleteData(id)
{
    
    bootbox.confirm({
			message: "Are you Sure to Delete this Data?",
			buttons: {
				confirm: {
					label: "Yes",
					className: 'btn-success'
				},
				cancel: {
					label: "No",
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result==false)
				return;	
        // ajax delete data to database
        $.ajax({
            url : $("#hidBASE_URL").val() + "index.php/" + ADMIN_CONTROLLER + "/deleteUser/"+id,
            type: "POST",
            dataType: "text",
			data:{li_token:$('#csrf-token').attr('content')},
            success: function(res)
            {
                
                 if(res.indexOf("Details exists")>=0)
                 {
                     var errorMsg ='<span style="color:red; font-weight:bold;">Sorry Can\'t delete this data, details exists.<span>'; 
                     bootbox.alert(errorMsg);
                     return false;
                 }
                 
                 if(res.indexOf("Error")>=0)
                 {
                     var errorMsg ='<span style="color:red; font-weight:bold;">' + res +'<span>'; 
                     bootbox.alert(errorMsg);
                     return false;
                 }
                 
                reloadTable();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                bootbox.alert('Error deleting data');
            }
        });

        }
    }); // bootbox confirm ending
}
