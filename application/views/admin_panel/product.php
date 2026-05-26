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
        Product
        <small>Product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>


	
        <!-- Main content STARTS-->
    <section class="content">
	
        <button class="btn btn-success" onClick="addData();"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
         <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                 
                  <th>Name</th>
                  <th>Price</th>
				  <th>Description</th>
                  <th>Cooked by</th>
                   <th>Category</th>
				    <th>Subcategory</th>
					
				   <th>Owner</th>
				<th>Offer</th>
					<th>Rating</th>
				   <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
		<tbody>
		
                
                </tbody>
                <tfoot>
                <tr>
               
                  <th>Name</th>
                  <th>Price</th>
				  <th>Description</th>
                  <th>Cooked by</th>
                   <th>Category</th>
				     <th>Subcategory</th>
					
				   <th>Owner</th>
					<th>Offer</th>
					<th>Rating</th>
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
                <h3 class="modal-title">Add Product</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    
					<div class="form-body">		
                        <div class="form-group">
                            <label for="Product_name" class="control-label col-md-3">Name*</label>
                            <div class="col-md-9">
                                <input name="product_name" id="product_name" placeholder="Product Name" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Product_price" class="control-label col-md-3">Price*</label>
                            <div class="col-md-9">
                                <input name="product_price" id="product_price" placeholder="Price" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Description" class="control-label col-md-3">Description*</label>
                            <div class="col-md-9">
                                <textarea name="description" id="description" placeholder="Description" class="form-control required"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Cooked_by" class="control-label col-md-3">Cooked By</label>
                            <div class="col-md-9">
                                <input name="Cooked_by" id="Cooked_by" placeholder="Cooked By" class="form-control required" required type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="Owner" class="control-label col-md-3">Owner</label>
                            <div class="col-md-9">
                                <select name="owner" id="owner" class="form-control">
                                    <option value="Admin">Admin</option>
                                    <option value="Restaurant">Restaurant</option>
									<option value="Homemaker">Homemaker</option>
                                </select>
                                <span class="help-block"></span>
				
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="Category" class="control-label col-md-3">Category*</label>
							<div class="col-md-9">
								<select class="form-control" name="Category" id="Category">
									<?php 
										$db = new Database();
										echo $db->fillCombo("Category", "Category", "---SELECT---", "", "Id", "", "", "");
									?>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="SubCategory" class="control-label col-md-3">Sub Category*</label>
							<div class="col-md-9">
								<select class="form-control" name="SubCategory" id="SubCategory">
									<?php 
										$db = new Database();
										echo $db->fillCombo("subcategory", "Subcategory", "---SELECT---", "", "Id", "", "", "");
									?>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						
						
			 <div class="form-group">
                            <label for="Status" class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="Pending" selected="selected">Pending</option>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/product.js"></script>


</body>

</html>
