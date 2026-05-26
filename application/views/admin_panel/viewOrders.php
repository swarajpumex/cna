<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $headTitle; ?> Admin | Dashboard</title>
  <?php require_once("top-css-js.php");?>
  <?php $CI = & get_instance();?>

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
        Orders
        <small>Orders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
      </ol>
    </section>

        <!-- Main content STARTS-->
    <section class="content">

        <button class="btn btn-default" onClick="reloadTable();"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Name</th>
				  <th>Address</th>
                  <th>Phone Number</th>
                  <th>Ordered On</th>
                  <th>Product</th>
				   <th>Quantity</th>
				   <th>Price</th>
				    <th>Duty</th>
				   <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
				<tbody>

                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
				  <th>Address</th>
                  <th>Phone Number</th>
                  <th>Ordered On</th>
                  <th>Product</th>
				   <th>Quantity</th>
				   <th>Price</th>
				   <th>Duty</th>
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
 
  <!-------------Modal--------->
<div id="StatusModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Status</h4>
        <button type="button" class="close" 
data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form class="form-horizontal" id="statusform">
			<div class="form-group">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="Status" class="control-label col-md-3">Status</label>
						<div class="col-md-9">
							<input type="hidden" name="StatusId" id="StatusId"/>
							<select name="status" id="status" class="form-control">
								<option value="" selected="selected">---SELECT---</option>
								<option value="New">New</option>
								<option value="Viewed">Viewed</option>
								<option value="Packed">Packed</option>
								<option value="Shipped">Shipped</option>
								<option value="Delivered">Delivered</option>
								<option value="Cancelled">Cancelled</option>
							</select>
							<span class="help-block"></span>
						</div> 
					</div>
				</div>
		  </div>
		</form>
    </div>
      <!-- Modal Footer -->
	<div class="modal-footer">
		<button type="button" id="btnSave" onclick="save();" class="btn btn-primary">OK</button>
	</div>
    </div>
  </div>
</div>
<!---------------Modalend------------>
	  
  <!-- /.content-wrapper -->
<?php include 'footer.php';?>
<!-- ./wrapper -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Duty</h3>
				<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" id="id" class="optional"/>
					<div class="form-body">		
						<div class="form-group">
							<label for="BoyName" class="control-label col-md-3">Delivery Boy*</label>
							<div class="col-md-9">
								<select class="form-control" name="name" id="name">
									<?php 
										$db = new Database();
										echo $db->fillCombo("delivery_boy", "Name", "---SELECT---", "", "Id", "", "", "");
									?>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" id="btnSave" onClick="addDuty();" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<!-- End Bootstrap modal -->	
				<?php require_once('common-hid-fields.php');?>
<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/order.js"></script>
</body>

</html>
