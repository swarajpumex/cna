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
        Delivery Boys
        <small>Delivery Boys</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Delivery Boys</li>
      </ol>
    </section>

        <!-- Main content STARTS-->
    <section class="content">
	
        <button class="btn btn-success" onClick="addData();"><i class="glyphicon glyphicon-plus"></i> Add Delivery Boy</button>
        <a class="btn btn-default" href='<?php echo base_url("$adminController/deliveryBoyProfileAll");?>'> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
        <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Delivery Boys List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Created On</th>
                  <th>Password</th>
				   <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
		<tbody>
		
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Created On</th>
                  <th>Password</th>
				   <th>Status</th>
				  <th>Action</th>
	        </tr>
                </tfoot>
          </table> <!-- table ending -->
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
        </div>
        <!-- /.col -->
      </div>
    </section><!-- Main content ENDING -->

  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php';?>
<!-- ./wrapper -->

<!-- Bootstrap modal FOR ADDING-->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Delivery Boy</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" class="optional"/>
                    
					<div class="form-body">		
                        <div class="form-group">
                            <label for="Name" class="control-label col-md-3">Name*</label>
                            <div class="col-md-9">
                                <input name="Name" id="Name" placeholder="Name" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Phone_nbr" class="control-label col-md-3">Contact Number*</label>
                            <div class="col-md-9">
                                <input name="Phone_nbr" id="Phone_nbr" placeholder="Contact Number" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="Password" class="control-label col-md-3">Password*</label>
                            <div class="col-md-9">
                                <input id="Password" name="Password"  placeholder="Password" class="form-control required" required type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Retype_Password" class="control-label col-md-3">Retype Password*</label>
                            <div class="col-md-9">
                                <input id="Retype_Password" name="Retype_Password"  placeholder="Retype Password" class="form-control required" required type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
			 <div class="form-group">
                            <label for="Status" class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" selected="selected">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                <span class="help-block"></span>
				
                            </div>
                        </div>
                        
			<!------ file upload block start -->
      <div class="form-group" id="hideWhenEdit">
                            <label for="userfile" class="control-label col-md-3">Profile Image</label>
                            <div class="col-md-9">
                                <label class="btn btn-primary btn-file">
                                     Browse <input type="file"  accept="image/*" name="userfile" id="userfile"
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
            </div>
            <div class="modal-footer">
                
                <button type="button" id="btnSave" onClick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</div>



<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/delivery.js"></script>


</body>

</html>
