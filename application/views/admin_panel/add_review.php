<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $headTitle; ?> Admin | Dashboard</title>
  <?php require_once("top-css-js.php");?>
  

 <style>
	.cke_dialog_ui_input_file{
		height:200px!important;
	}
	.cke_dialog_ui_button{
		margin-top:40px!important;
	}
  </style>
</head>


<body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

 <?php include 'header.php';?>
  <?php include 'sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
   





   <!-- Content Header (Page header) -->
   
	<section class="content-header">
      <h1>
       Add Review
        
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Add Review</li>
      </ol>
    </section>

       







	   <!-- Main content STARTS-->
    
	
	
	
	
	
	
	
	<section class="content">
				<div class="row">
				<!--<button class="btn" id="btnCancel" onClick="cancel();" style="display:none;">Cancel edit</button>-->
				<div class="col-xs-12">
				<form method="POST" action="" name ="add_form" id="add_form" role= "form" data-toggle="validator" data-disable="false" accept-charset="UTF-8">
						<input type="hidden" value="" name="id" class="optional"/>
						
						<div class="row mtop-23">
						<div class="col-md-3 pb-15">
						<label class="title-label"> Add Review Title</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="input-title form-control" id="head" name="head" style="width:300px; height:40px;"placeholder="Review Title"/>
						</div>
						<div class="col-md-5">
							<div class="form-group" id="hideWhenEdit">
                            <label for="userfile" class="control-label col-md-5">Cover Image</label>
                            <div class="col-md-7">
                                <label class="btn btn-primary btn-file">
                                     Browse <input type="file"  accept="image/*" name="file" id="file" 
                                                   style='position:absolute;z-index:2;top:0;left:0;filter: 
                                                   alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                                                   opacity:0;background-color:transparent;color:transparent;'
                                                   onchange="$('#upload-file-info').html($(this).val());">
                                     
                                </label>
                                <span class='label label-info' id="upload-file-info"></span>
                                
                            <span class="help-block"></span>
				
                            </div>
                        </div>
						</div>
						</div>
						
						<!--<div class="col-md-3 pb-15">
						<label class="title-label">Interview Video Link</label>
						</div>
						<div class="col-md-4">
						
							<input type="text" id="URL" name="URL" class="input-title form-control" placeholder="Youtube Short URL eg : https://youtu.be/Blb64VibSeE" style="width:300px; height:40px;">
					
						</div>--><div class="row mtop-23">
						<div class="col-md-3 pb-15">
						<label class="title-label">Details</label>
						</div>
						<div class="col-md-4">
						
							<textarea  id="details" name="details" class="input-title form-control" placeholder="Details" rows="4" cols="50" maxlength="200"></textarea>
					
						</div>
						<div class="col-md-5">
							<div class="form-group" id="hideWhenEdit">
                            <label for="userfile" class="control-label col-md-5">Video Link</label>
                            <div class="col-md-7">
                               <input type="text" id="URL" name="URL" class="input-title form-control optional" placeholder="Youtube Short URL" style="width:200px; height:40px;">
                                <span class='label label-info' id="upload-file-info"></span>
                                
                            <span class="help-block"></span>
				
                            </div>
                        </div>
						</div>
						</div>
						<br>
						<?php require_once('common-hid-fields.php');?>
							<div class="form-group">
								<!--<label for = "Name" class = "">About us text* (this is a required field.) </label>-->
								<div class="box-body pad">
									<?php 
										// replacing single and double cotes
									//	$aboutUsText = str_replace("\'","'",$aboutUsText);
									//	$aboutUsText = str_replace('\"','"',$aboutUsText);
									?>
									<textarea id="editor" name="editor" rows="20" cols="80" style="height:80px !important;">
										<?php //echo $aboutUsText;?>
									</textarea>
									 
								</div>
								<span class="help-block" style="display: none;"></span>
							</div>
				</form>	
				</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<center><button class="btn article-btn btn-primary btn-lg" id="btnEdit" onClick="edit();">Save</button></center>	
					</div>
				</div>			
					
		</section>
		
		
		
		
		
		
		
  </div>	
  <!-- /.content-wrapper -->
<?php include 'footer.php';?>
<!-- ./wrapper -->
<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/user-manager.js"></script>
<script>
		/*$(function () {
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
			CKEDITOR.replace('editor');
				//bootstrap WYSIHTML5 - text editor
			$(".textarea").wysihtml5();
					//CKEDITOR.instances['editor'].setReadOnly(true); // this is not working while loading.
			//$("#editor").prop("disabled", true);
			$("#btnCancel").hide();
			
			
			
		});*/
		
		$(function () {
		
				  CKEDITOR.replace('editor', {
					     filebrowserUploadUrl: "upload",
						
          uiColor: '#2e6da4',
			    language: "en-us",
			    toolbar: "Custom",
          height: "200",
          width: "100%",

			    toolbar_Custom: [
			    	["Bold", "Italic", "Underline"], 
			    	["NumberedList", "BulletedList", "-", "Outdent", "Indent", "-", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock"], 
			    	["Link", "Unlink"],
					{ name: 'insert', items: [ 'Image']},
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
			    ],  
		});	
				$("#btnCancel").hide();
			  });
		
		
		
		
    
		function edit()
		{
			$("#add_form input").each(function(){
				 var $this = $(this);
				 if($this.attr('class')){
					if($this.attr('class').indexOf('has-error')>=0)
					$this.removeClass('has-error');
				}
			});
			$('#catid').removeClass('has-error');
			$('#lanid').removeClass('has-error');
				hasErrors=false;
				$('#add_form input').not('.optional').each(function() {
				var $this = $(this);
				if (!$this.val()) {
					$this.addClass('has-error');
					hasErrors=true;
					bootbox.alert('Error while saving data!. Please Upload CoverImage.');
				}
				});
				
				if($('#catid').val()==""){
						$('#catid').addClass('has-error');
						hasErrors=true;
				}
				if($('#lanid').val()==""){
						$('#lanid').addClass('has-error');
						hasErrors=true;
				}
				if(!hasErrors){
					var data  		=  new FormData($('#add_form')[0]);
					var aboutText 	= CKEDITOR.instances['editor'].getData();
					
					//aboutText 		= encodeURIComponent(aboutText); //	filtering text. VERY IMPORTANT for quotes and spaces.
					//aboutText		= htmlUnescape(aboutText);	 //	filtering text.
					data.append("editor", aboutText);
					var controller = $("#hidAdminController").val(); 
					var URL ="<?php echo base_url();?>index.php/" +"/CinemaAd/saveReview";
				
					$.ajax({
						url : URL,
						data:data,
						type: "POST",
						dataType: "text",
						processData: false,
						contentType: false,
						cache: false,
						enctype: 'multipart/form-data',
						success: function(res)
						{
								var msg="";
								if(res.indexOf("Error")>=0)
								{
										msg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
										msg	+='<strong style="color:white;">' + res +'</strong>';
										$('#divError').html(msg);
										$('#divError').show();
										// For message alert closing in 2 sec.
										$("#divError").fadeTo(2000, 500).slideUp(500, function(){
										$(".alert").hide();
										//$("#form")[0].reset(); // reseting form
										});
										return false;
								}
								msg		= '<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
								msg	+='<strong style="color:white;">Success! Data has been saved successfully!.</strong>';
								$('#divMessage').html(msg);
								$('#divMessage').show();
								// For message alert closing in 2 sec.
								$("#divMessage").fadeTo(2000, 500).slideUp(500, function(){
								$(".alert").hide();
								//$("#form")[0].reset(); // reseting form
								});
							//cancel();
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							bootbox.alert('Error while saving data.');
						}
					});
			}
		}
		function cancel()
		{
			var caption = $("#btnEdit").html();
			if(caption=="Save article")
			{
				$("#btnEdit").html("Save article");
				$("#btnCancel").hide();
				//CKEDITOR.instances['editor'].setReadOnly(true);
			}
		}
	</script>
</div>
</body>

</html>
