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
        Courses
        <small>Manage Courses</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminhome"); ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Courses</li>
      </ol>
    </section>


	<!-- Main content STARTS-->
    <section class="content">
		<button class="btn btn-success" onClick="addData();"><i class="glyphicon glyphicon-plus"></i> Add New</button>
        <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Course List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Duration</th>
                  <th>Description</th>
                  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
		<tbody>
		
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Duration</th>
                  <th>Description</th>
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
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add New</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" class="optional"/>
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label for="Course" class="control-label col-md-3">Course Name*</label>
                            <div class="col-md-9">
                                <input name="Course" id="Course" placeholder="Course Name" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Category" class="control-label col-md-3">Category</label>
                            <div class="col-md-9">
                                <select name="Category" id="Category" class="form-control">
									<?php 
                                        $db = new Database();
                                        $resCombo = $db->fillCombo("categories", "Name", "-Select-", "", "Id", "Status='Active'", "Name", "");
                                        echo $resCombo;
                                    ?>
                                </select>
                                <span class="help-block"></span>
				
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Duration" class="control-label col-md-3">Duration*</label>
                            <div class="col-md-9">
                                <input name="Duration" id="Duration" onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' placeholder="Duration in Hours" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Description" class="control-label col-md-3">Description*</label>
                            <div class="col-md-9">
                                <textarea name="Description" id="Description" placeholder="Enter Your Description" class="form-control required" required type="text"></textarea>
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
                     
						<div class="form-group" id="hideWhenEdit">
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
				
                            </div>
                        </div>
						
						<div class="form-group" id="showWhenEdit" hidden>
							<label for="userfile" class="control-label col-md-3">Preview</label>
							<div><img name="Image" style="max-width:150px;max-height:150px;border:1px solid #000;" src=""></div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/courses.js"></script>

</body>
</html>
