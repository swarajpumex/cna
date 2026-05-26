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

<?php include 'header.php';?>
<?php include 'sidebar.php';?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        About
        <small>Settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminhome"); ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About</li>
      </ol>
    </section>


    <!-- Main content STARTS-->
    <section class="content">
		<div class="row" style="margin-bottom:10px">
			<label class=" col-xs-offset-5 col-xs-2 control-label text-center">Image of About</label>
			<div class="col-xs-offset-4  col-xs-4 popular-listing-box" style="padding:2%;width:auto;">
				<figure class="effect-ming"><img style="max-height:90%;max-width:100%;" src="../../../uploads/settings/<?php echo $details->AboutImage?>"> <figcaption>
				 <ul>
                                            <li><a href="javascript:void();" onclick=""><input type="file"  accept="image/*" name="userfile" id="userfile" class="optional"
                                                   style='position:absolute;z-index:2;top:0;left:0;filter: 
                                                   alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                                                   opacity:0;background-color:transparent;color:transparent;'
                                                   onchange="save();"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </figcaption>
									</figure>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<label class=" col-xs-offset-5 col-xs-2 control-label text-center">Image of MD</label>
			<div class="col-xs-offset-5  col-xs-4 popular-listing-box" style="padding:2%;width:auto;">
				<figure class="effect-ming"><img style="max-height:90%;max-width:100%;" src="../../../uploads/settings/<?php echo $details->MDImage?>"> <figcaption>
				 <ul>
                                            <li><a href="javascript:void();" onclick=""><input type="file"  accept="image/*" name="userfile1" id="userfile1" class="optional"
                                                   style='position:absolute;z-index:2;top:0;left:0;filter: 
                                                   alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                                                   opacity:0;background-color:transparent;color:transparent;'
                                                   onchange="save1();"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </figcaption>
									</figure>
			</div>
		</div>
		<form name="form" method="post" id="form">
	
	
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="Name">Name of MD</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" value="<?php echo $details->Name;?>" id="Name" name="Name">
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="Message">Message of MD</label>
				<div class="col-xs-10">
					<textarea class="form-control" style="height:110px;" id="Message" name="Message"><?php echo $details->Message;?></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="About">About</label>
				<div class="col-xs-10">
					<textarea class="form-control" style="height:110px;" id="About" name="About"><?php echo $details->About;?></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="Vision">Vision</label>
				<div class="col-xs-10">
					<textarea class="form-control" style="height:110px;" id="Vision" name="Vision"><?php echo $details->Vision;?></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="Mission">Mission</label>
				<div class="col-xs-10">
					<textarea class="form-control" style="height:110px;" id="Mission" name="Mission"><?php echo $details->Mission;?></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="Quality">Quality Policy</label>
				<div class="col-xs-10">
					<textarea class="form-control" style="height:110px;" id="Quality" name="Quality"><?php echo $details->Quality;?></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px">
			<div class="form-horizontal">
				<label class="col-xs-2 control-label" for="FooterAbout">About in Footer</label>
				<div class="col-xs-10">
					<textarea class="form-control" style="height:110px;" id="FooterAbout" name="FooterAbout"><?php echo $details->FooterAbout;?></textarea>
				</div>
			</div>
		</div>
		</form>
		<div class="row">
			<button class="col-xs-offset-10 col-xs-2 btn btn-success" id="btnSave">Save</button>
		</div>
	</section><!-- Main content ENDING -->

  </div>
  <!-- /.content-wrapper -->
 
 <?php include 'footer.php';?>


</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal_form" role="dialog" style="margin-top:20%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title text-center"><i class="fa fa-spinner fa-spin"></i> Please Wait</h3>
			</div>	
		</div>
	</div>
</div>
<?php require_once('common-hid-fields.php');?>

<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/about.js"></script>

</body>
</html>
