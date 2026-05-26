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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <?php include 'header.php';?>
  <?php include 'sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add SongLink
        <small>Add SongLink</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add SongLink</li>
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
						<label class="title-label"> Add article title </label>
						</div>
						<div class="col-md-7">
							<input type="text" class="input-title" id="head" name="head"/>
						</div>
						<div class="col-md-2">
							
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
									</textarea>
									 
								</div>
								<span class="help-block" style="display: none;"></span>
							</div>
				</form>	
				</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button class="btn article-btn" id="btnEdit" onClick="edit();">Save article</button>	
					</div>
				</div>			
					
		
    </section><!-- Main content ENDING -->

  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php';?>
<!-- ./wrapper -->

<!-- Bootstrap modal FOR ADDING AND EDITING -->



<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/addsong.js"></script>


</body>

</html>
