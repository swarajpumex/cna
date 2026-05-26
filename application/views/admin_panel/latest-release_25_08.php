<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $headTitle; ?> Admin | Dashboard</title>
  <?php require_once("top-css-js.php");?>
<style type="text/css">
  .btn-group-sm>.btn, .btn-sm{
    margin: 1px 0;
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
    <section class="content-header">
      <h1>
        Add Movies
        <small>Add Movies</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Movies</li>
      </ol>
    </section>


	
        <!-- Main content STARTS-->
    <section class="content">
                   
        <button class="btn btn-success" onClick="addData();"><i class="glyphicon glyphicon-plus"></i> Add Movies</button>
		        <!--<a class="btn btn-default" href='<?php echo base_url("$adminController/userProfileAll");?>'> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a>--></h1>
        <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Film List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
				 <th>Film Id</th>
                  <th>Film Name</th>
				  <th>Language</th>
				   <th>Category</th>
                  <th>Details</th>
                  <th>Created On</th>
                  <th>Status</th>
				  <th width="250px">Action</th>
                </tr>
                </thead>
		<tbody>
		
                
                </tbody>
                <tfoot>
                <tr>
				   <th>Film Id</th>
                  <th>Film Name</th>
				  <th>Language</th>
				  <th>Category</th>
                 <th>Details</th>
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
                <h3 class="modal-title">Add Releases</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" class="optional"/>
					 <div class="form-body">
                        
                        
			
			
                        <div class="form-group">
                            <label for="Film_Name" class="control-label col-md-3">Film Name*</label>
                            <div class="col-md-9">
                                <input name="Film_Name" id="Film_Name" placeholder="Film Name" class="form-control required" required type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="Language" class="control-label col-md-3">Language*</label>
                            <div class="col-md-9">
                                
                                
                                 <select class="form-control required" required  id="Language" name="Language">
					<?php 
                                            $db = new Database();
                                            $resCombo = $db->fillCombo("language", "Language", "-Select-", "", "Language", "Status='Active'", "Language", "");
                                            echo $resCombo;
                                            ?>
				 </select>
			        <span class="help-block" style="display: none;">Please enter menu item.</span>
                            </div>
                        </div>
						
                        
						
						 <div class="form-group">
                            <label for="Status" class="control-label col-md-3">Category</label>
                            <div class="col-md-9">
                                <select name="Category" id="Category" class="form-control">
                                    <option value="Release" selected="selected">Release</option>
                                    <option value="Upcoming">Upcoming</option>
                                </select>
                                <span class="help-block"></span>
				
                            </div>
                        </div>
                        
                        
                       
                        <div class="form-group">
                            <label for="Discription" class="control-label col-md-3">Details</label>
                            <div class="col-md-9">
                               <textarea name="Details" id="Details" placeholder="Details" class="form-control required" required type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Film_Name" class="control-label col-md-3">Unique Name*</label>
                            <div class="col-md-9">
                                <input name="UniqueName" id="UniqueName" placeholder="Unique Name" class="form-control required" required type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Film_Name" class="control-label col-md-3">By Line*</label>
                            <div class="col-md-9">
                                <input name="By_Line" id="By_Line" placeholder="Line By" class="form-control required" required type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Place" class="control-label col-md-3">Place *</label>
                            <div class="col-md-9">
                                <input name="Place" id="Place" placeholder="Place" class="form-control required" required type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="Date" class="control-label col-md-3">Date Line</label>
                            <div class=' col-md-9' >
                          <input type="text" name="DateCreated" class="form-control datepicker required" required="" id="DateCreated" readonly="">
                        <!--  <div class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                         </div> -->
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
                     
                      <div class="form-group" id="">
                            <label for="userfile" class="control-label col-md-3">Image</label>
                            <div class="col-md-9">
                                <label class="btn btn-primary btn-file">
                                     Browse <input type="file"  accept="image/*" name="userfile" id="userfile" class="optional"
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/latest-release.js"></script>
<script type="text/javascript">
  $('#DateCreated').datepicker();
</script>

</body>

</html>
