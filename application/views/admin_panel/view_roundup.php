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
      View Roundup
        <small>  View Roundup</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> View Roundup</li>
      </ol>
    </section>


	
        <!-- Main content STARTS-->
    <section class="content">
	
        <!--<button class="btn btn-success" onClick="addData();"><i class="glyphicon glyphicon-plus"></i> Add Language</button>-->
       <!-- <a class="btn btn-default" href='<?php echo base_url("$adminController/userProfileAll");?>'> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a>--></h1>
        <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> View Roundup List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  
                  <th>Title</th>
                  <th>Video Link</th>
                  <th>Created On</th>
                  
                  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
		<tbody>
		
                
                </tbody>
                <tfoot>
                <tr>
                 <th>Title</th>
                 <th>Video Link</th>
                  <th>Created On</th>
     
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

<!-- Bootstrap modal FOR ADDING AND EDITING -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add User</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" class="optional"/>
                    <div class="form-body">
                        
                        
			
			
                        <div class="form-group">
                            <label for="User_Id" class="control-label col-md-3">Language*</label>
                            <div class="col-md-9">
                                <input name="Language" id="Language" placeholder="Language" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="User_Id" class="control-label col-md-3">Language*</label>
                            <div class="col-md-9">
                                <input name="Language" id="Language" placeholder="Language" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                      			
			 <div class="form-group">
                            <label for="Status" class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="Status" id="Status" class="form-control">
                                    <option value="Active" selected="selected">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                <span class="help-block"></span>
				
                            </div>
                        </div>
                        
			<!------ file upload block start -->
                     
                        
                        
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/roundup.js"></script>


</body>

</html>
