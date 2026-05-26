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
       Box Office Collection 
        <small>  Box Office Collection </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  Box Office Collection  </li>
      </ol>
    </section>


	
        <!-- Main content STARTS-->
    <section class="content">
	
        <button class="btn btn-success" onClick="addData();"><i class="glyphicon glyphicon-plus"></i>   Add Box Office Collection </button>
		<a href="<?php echo base_url();?>CinemaAd/latestRelease"><button class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</button></a>
        <!--<a class="btn btn-default" href='<?php echo base_url("$adminController/userProfileAll");?>'> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>-->
        <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">BoxOffice Collection </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
				  <th>No.</th>
                  <th>Film Name</th>
				  <th>Box office collection</th>
                 
                  <th>Created On</th>
                 
                  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
		<tbody>
		
                
                </tbody>
                <tfoot>
                <tr>
				    <th>No.</th>
                  <th>Film Name</th>
				  <th>Box office collection</th>
                 
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
                           <!--  <label for="Film_Name" class="control-label col-md-3">Film Id*</label> -->
                            <div class="col-md-9">
                                <input name="Film_Id" id="Film_Id" placeholder="Film Id" class="form-control required" required type="hidden" value="<?php echo $latestreleaseid?>" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $latestreleaseid?>" name="latestreleaseid" id="latestreleaseid" class="optional"/>
			
			
                        <div class="form-group">
                            <label for="Film_Name" class="control-label col-md-3">Film Name*</label>
                            <div class="col-md-9">
                                <input name="Film_Name" id="Film_Name" placeholder="Film Name" class="form-control required" required type="text" value="<?php echo $film['FilmName'];?>" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="collection" class="control-label col-md-3">Box office collection*</label>
                            <div class="col-md-9">
                                <input name="Boxoffice" id="Boxoffice" placeholder="Box Office Collection" class="form-control required" required type="text">
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/boxoffice.js"></script>


</body>

</html>
