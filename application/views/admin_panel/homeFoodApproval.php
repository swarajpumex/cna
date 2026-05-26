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
        Food Approval
        <small>Food Approval</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminHome");?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Food Approval</li>
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
              <h3 class="box-title"> Homely Food List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dataTable" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  
                  <th>Name</th>
				  <th>Food Item</th>
                  <th>Price</th>
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
				  <th>Food Item</th>
                  <th>Price</th>
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
  <?php include 'common-hid-fields.php';?>
<?php include 'footer.php';?>
<!-- ./wrapper -->

<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/homeFoodApproval.js"></script>


</body>

</html>
