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
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url("$adminController/adminhome"); ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">common-page</li>
      </ol>
    </section>


    <!-- Main content STARTS-->
    <section class="content">
		PUT YOUR CONTENT HERE

    </section><!-- Main content ENDING -->

  </div>
  <!-- /.content-wrapper -->
 
 <?php include 'footer.php';?>


</div>
<!-- ./wrapper -->

<?php require_once ("bottom-js.php"); ?>
</body>
</html>
