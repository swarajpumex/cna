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
        Dashboard
        <small>Gallery</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminhome"); ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gallery</li>
      </ol>
    </section>


    <!-- Main content STARTS-->
    <section class="content">
		<form id="form" name="form">
			<label  id="input_file" class="btn btn-primary btn-file">
                                     Add New <input type="file"  accept="image/*" name="userfile" id="userfile" class="optional"
                                                   style='position:absolute;z-index:2;top:0;left:0;filter: 
                                                   alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                                                   opacity:0;background-color:transparent;color:transparent;cursor:pointer;'
                                                   onchange="save();" hidden>
                                     
                                </label>
		</form>
        <br />
        <div class="row">
			<div class="row">
			<?php $i=0; foreach($images as $row): $i++?>
			<div class="col-md-3 col-sm-4 popular-listing-box" style="padding:2%;">
				<figure class="effect-ming"><img style="max-height:90%;max-width:100%;" src="<?php echo base_url()."uploads/gallery/".$row['Image'];?>"> <figcaption>
				 <ul>
                                            <li><a href="javascript:void();" onclick="deleteData('<?php echo $row['Image'];?>');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </figcaption>
									</figure>
			</div>
			<?php
			if($i%4==0)
				echo '</div><div class="row">';
			endforeach;?>
			</div>
			
			
			
			
			
			
			
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/gallery.js"></script>


</body>


</body>
</html>
