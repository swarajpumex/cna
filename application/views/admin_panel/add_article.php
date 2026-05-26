<!doctype html>
<html class="no-js" lang="en">
	<head>
       <?php include 'top-css.php'?>
	<style>
	.cke_dialog_ui_input_file{
		height:200px!important;
	}
	.cke_dialog_ui_button{
		margin-top:40px!important;
	}
  </style>
    </head>
    <body>
        <!-- header start -->
         <?php include 'main-header.php'?>
        <!-- header end -->
		<section>
			<div class="container">
				<button class="btn" id="btnEdit" onClick="edit();">Save article</button>
				<!--<button class="btn" id="btnCancel" onClick="cancel();" style="display:none;">Cancel edit</button>-->
				<br/></br/>
				
				<form method="POST" action="" name ="form" id="form" role= "form" data-toggle="validator" data-disable="false">
						<input type="hidden" value="<?php echo $article_id;?>" name="id" id="id" class="optional"/>
						
						<div class="row">
						<div class="col-md-3 pb-15">
						<label class="title-label"> select category </label>
						</div>
						<div class="col-md-9">
							<select id="catid" name="catid">
							 <option value=" ">--select--</option>
							<?php if(isset($category)){
							 foreach($category as $row ){
								 $cat=$row['Category'];
								 $id=$row['Id'];?>
							  <option value="<?php echo $id;?>"><?php echo $cat;?></option>
							   <?php } } ?>
							</select>
						</div>
						</div>
						
						<div class="row">
						<div class="col-md-3 pb-15">
						<label class="title-label"> Add article title </label>
						</div>
						<div class="col-md-9">
							<input type="text" class="input-title" value="<?php echo $article_description['ArticleTitle'];?>" id="head" name="head"/>
						</div>
						</div>
						
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
										<?php echo $article_description['Description'];?>
									</textarea>
									 
								</div>
								<span class="help-block" style="display: none;"></span>
							</div>
							
				</form>		
			</div>			
		</section>
            <!-- news area -->
		<input id="hidField" hidden></input>
        <!-- footer -->
         <?php include 'footer.php'?>
        <!-- footer end -->
		<!-- JS here -->
         <?php include 'bottom-js.php'?>
	<script>
		/*$(function () {
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
			CKEDITOR.replace('editor');
			CKEDITOR.replace( 'editor',
				{  //                  ^---Editor Id goes here
					removeDialogTabs :	"ImageButton"
				});
				//bootstrap WYSIHTML5 - text editor
			$(".textarea").wysihtml5();
					//CKEDITOR.instances['editor'].setReadOnly(true); // this is not working while loading.
			//$("#editor").prop("disabled", true);
			$("#btnCancel").hide();
		});*/
	
	
		$(function () {
		
				  CKEDITOR.replace('editor', {
					     filebrowserUploadUrl: "<?php echo base_url();?>site/upload",
						
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
				var data  		= $("#form").serialize();
				var aboutText 	= CKEDITOR.instances['editor'].getData();
				data +="&editor=" + aboutText;
					var controller = $("#hidAdminController").val();
				var URL ="<?php echo base_url();?>index.php/" +"/site/saveArticle";
				$.ajax({
					url : URL,
					data:data,
					type: "POST",
					dataType: "text",
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
						cancel();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						bootbox.alert('Error while saving data.');
					}
				});
			
			/*
			var caption = $("#btnEdit").html();
			if(caption=="Edit article")
			{
				$("#btnEdit").html("Save article");
				$("#btnCancel").show();
				CKEDITOR.instances['editor'].setReadOnly(false);
			}
			else if(caption=="Save article")
			{
				var data  		= $("#form").serialize();
				var aboutText 	= CKEDITOR.instances['editor'].getData();
				aboutText 		= escape(aboutText); //	filtering text. VERY IMPORTANT for quotes and spaces.
				aboutText		= htmlUnescape(aboutText);	 //	filtering text.
				data +="&editor=" + aboutText;
				var controller = $("#hidAdminController").val();
				var URL ="<?php echo base_url();?>index.php/" + controller + "/saveArticle";
				//Ajax Load data from ajax
				$.ajax({
					url : URL,
					data:data,
					type: "POST",
					dataType: "text",
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
						cancel();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						bootbox.alert('Error while saving data.');
					}
				});
			}*/
		}
		function cancel()
		{
			var caption = $("#btnEdit").html();
			if(caption=="Save article")
			{
				$("#btnEdit").html("Edit article");
				$("#btnCancel").hide();
				CKEDITOR.instances['editor'].setReadOnly(true);
			}
		}
	</script>
    </body>
</html>