<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $headTitle; ?> Admin | Dashboard</title>
   <?php require_once("top-css-js.php");?>
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Profile All</li>
      </ol>
    </section>


    <!-- Main content STARTS-->
    <section class="content">
		<div class="container">

                    <div class="page-header">
                    <h1 class="h2">All Users | <a class="btn btn-default" href='<?php echo base_url("$adminController/usermanager");?>' <span class="glyphicon glyphicon-backward"></span> &nbsp; Go back to list </a></h1> 
                    </div>
    
                <br />
                
                <?php
                    $db = new Database();
                    $SQL = "SELECT * FROM `login` WHERE UserId!='shameel' ORDER BY Id DESC";
                    $res = $db->runQuery($SQL);
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while ($row=  mysqli_fetch_array($res))
                        {   
                            $userPic  = $row["ProfilePhoto"];
                            if($userPic==NULL  || $userPic="")
                                {
                                    if($row["Sex"]=="Male")
                                        $userPic = base_url()."uploads/profile_image/user_default_male.png";
                                    else
                                        $userPic = base_url()."uploads/profile_image/user_default_female.png";
                                    
                                }
                             else
                                 $userPic  = base_url()."uploads/profile_image/" . $row["ProfilePhoto"];
                            ?>
                                <div class="col-xs-3">
                                    <p class="page-header" style="font-size: 2vmin;"><?php echo $row["UserId"]."&nbsp;/&nbsp;".$row["UserType"] . "&nbsp;/&nbsp;" . $row["Status"] ; ?></p>
                                <img src="<?php echo $userPic; ?>" id="img_<?php echo $row['Id'];?>" class="img-rounded img-responsive img-thumbnail img-bordered" width="150px" height="150px" style="outline: 1px solid orange;" />
				<p class="page-header">
				<span>
				<a style="font-size: 2vmin;" class="btn btn-info" name ="<?php echo $row['ProfilePhoto'];?>" id="edit_<?php echo $row['Id'];?>" href="#" title="click to edit photo" onclick="return confirmEdit(this.name, this.id);"><span class="glyphicon glyphicon-edit"></span>Edit</a> 
				<a style="font-size: 2vmin;" class="btn btn-danger" id="del_<?php echo $row['Id'];?>" href="#" title="click to delete photo" onclick="return confirmDelete(this.id);"><span class="glyphicon glyphicon-remove-circle"></span> Delete </a>
				</span>
				</p>
                            </div> 
                            
                            
                       <?php }
                                
                    }    
                    else
                    {
		?>
                <div class="col-xs-12">
                    <div class="alert alert-warning">
                    <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
                </div>
                </div><?php
                    }
                  ?>  
                
                
                </div><!--- container ends -->
                
    </section><!-- Main content ENDING -->



  </div>
  <!-- /.content-wrapper -->
 <?php include "footer.php";?>


<!-- Bootstrap modal FOR ADDING AND EDITING -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <!------ file upload block start -->
                     
                      <div class="form-group">
                            <label for="userfile" class="control-label col-md-3">Profile Image</label>
                            <div class="col-md-9">
                                 <img id="thumpnail" src="<?php echo base_url(); ?>image/no-image.jpg" style="outline: 1px solid orange;" 
                                      class="img-rounded img-responsive img-thumbnail img-bordered" 
                                      height="150" width="150" /><br/><br/>
                                <label class="btn btn-primary btn-file">
                                    
                                   
                                    
                                     Browse New<input type="file"  accept="image/*" name="userfile" id="userfile" class=""
                                                   style='position:absolute;z-index:2;top:0;left:0;filter: 
                                                   alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                                                   opacity:0;background-color:transparent;color:transparent;'
                                                   onchange="$('#upload-file-info').html($(this).val());">
                                     
                                </label>
                                <span class='label label-info' id="upload-file-info"></span>
                                
                            <span class="help-block"></span>
				
                            </div>
                        </div>
                        
                        
                        
                        <!------ file upload BLOCK ends --->
                         <?php require_once('common-hid-fields.php');?>   
                    </form>
            
            </div><!-- body ending -->
            
            <div class="modal-footer">
                
                <button type="button" id="btnSave"  class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload();">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<?php require_once ("bottom-js.php"); ?>

<script>
    var ADMIN_CONTROLLER = $("#hidAdminController").val();
    
	var CSRF_TOCKEN 	= $("#csrf-token").attr('content'); // FOR CSRF for every ajax request.
	var CSRF_NAME		= $("#csrf-name").attr('content');  // FOR CSRF for every ajax request.
    $("#btnSave").click(function (){
        
        var file  = $('#upload-file-info').html();
        
        
        
       if (file=="") {
		
		var errorMsg	 = '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
                    errorMsg	+='<strong style="color:white;">Error ! Please choose an image file.</strong>';
						
		$('#divError').show();
		$('#divError').html(errorMsg);
        
        
        // error msg alert closing in 2 sec.
        $("#divError").fadeTo(2000, 500).slideUp(500, function(){
	  $(".alert").hide();
          });                       
        
        return false;
      }
      
      
      if (typeof FormData == 'undefined')
        {
            bootbox.alert("Oops,Your Browser Don't support FormData API! Use Crome or IE 10 or above!");
            return false;
        }
  
        // upload using formData
         var formData = new FormData("#form");
         var fileField = _('userfile'); // getting the file field object.
          
         formData.append('Id', $("#hidID").val());
         formData.append('userfile', fileField.files[0]); 
		 formData.append('li_token', CSRF_TOCKEN);
 
      
      
        
       var $btn = $("#btnSave");
       $btn.val('Saving');
      
       $(".alert").hide(); // hiding all the message alert.
       $('#btnSave').text('Saving...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var URL =$("#hidBASE_URL").val() + "index.php/" + ADMIN_CONTROLLER +  "/editUserPhoto";
       
       
      $.ajax({
        url : URL,
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
		var msg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
			msg	+='<strong style="color:white;">Saved! image has been changed successfully!.</strong>';
			$('#divMessage').html(msg);
			$('#divMessage').show();
				
			// For message alert closing in 2 sec.
			$("#divMessage").fadeTo(2000, 500).slideUp(500, function(){
				
				$(".alert").hide();
				$("#form")[0].reset(); // reseting form
                                $('#upload-file-info').html("");
			
			});
                $btn.val('Save');  
                $('#btnSave').text('Save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
                $btn.val('reset'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            var errorMsg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
			errorMsg	+='<strong style="color:white;">Error ! Error while changing image.</strong>';
						
			$('#divError').show();
			$('#divError').html(errorMsg);
				
			// For message alert closing in 2 sec.
			$("#divError").fadeTo(2000, 500).slideUp(500, function(){
				
				$("#divError").hide();
				
			});
            
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            $btn.val('reset'); 

        }
    });
       
       
       
       
      
      
       
    }); // click ending

    function initialize()
    {
            	$('#btnSave').text('Save'); //change button text
                $('#btnSave').removeAttr('disabled'); //set button disable
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                $('#modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('Change Photo'); // Set Title to Bootstrap modal title
    
    }
    
    function confirmEdit(imageName, editId)
    {
         bootbox.confirm("Are you sure to change this photo?", function(result) {
         var src = "<?php echo base_url(); ?>uploads/profile_image/" + imageName;
         if(result)
         {
            initialize();
            $("#thumpnail").attr("src", src);
            editId = editId.split("_");
            $("#hidID").val(editId[1]); // setting the id .
           
        } // result if ending
   
         
         }); // bootbox endig
    
    }
    
    
 function confirmDelete(id)
{
    
    id  = id.split("_"); // getting the image id by del.id.
    var imgId   ="#img_"+id[1];
    var photo  = $(imgId).attr("src");
  
    //alert(photo);
   // return;
    
    
    
    if(photo.indexOf("user_default_female.png")>=0 && photo.indexOf("user_default_male.png")>=0)
                {
                    
                    bootbox.alert("No profile image to delete.");
                    return false;
                }    
                
    
    
    bootbox.confirm("Are you sure to delete this profile photo", function(result) {
		
     if(result)
	{
        // ajax delete data to database
        $.ajax({
            url : $("#hidBASE_URL").val() + "index.php/" + ADMIN_CONTROLLER + "/deleteUserPhoto/"+id[1],
            type: "POST",
            dataType: "text",
			data:{li_token:CSRF_TOCKEN},
            success: function(res)
            {
                
                if(res.indexOf("Error!")>=0)
                {
                    bootbox.alert(res);
                    return false;
                }
                 $("#thumpnail").attr("src", res); // setting the default image.
                 location.reload(); // reloading the page to refresh the login profile images.
                 
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                
                bootbox.alert('Error deleting photo');
            }
        });

        }
    }); // bootbox confirm ending
  }
  
  
</script>
</body>
</html>
