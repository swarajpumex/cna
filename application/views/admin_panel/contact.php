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
		<!-- PUT YOUR CONTENT HERE -->



    <div class="row" style="margin-bottom:10px">
      <div class="form-horizontal">
        <label class=" control-label" for="Message" style="margin-left: 20px;">Contact Info</label>
        <div class="" style="margin: 20px; width:500px" >
          <textarea class="form-control" style="height:110px;" id="address" name="address"> <?php echo $contact ?> </textarea>
        </div>
        <button class="btn btn-success" id="update_btn" onclick="update_contact();" style="margin: 20px; width:100px; ">Update</button>
      </div>
    </div>

    </section><!-- Main content ENDING -->

  </div>
  <!-- /.content-wrapper -->
 
 <?php include 'footer.php';?>


</div>
<!-- ./wrapper -->

<?php require_once ("bottom-js.php"); ?>



<!-- Script for update button functioning -->
<script type="text/javascript">
  
  function update_contact(){
    var xyz= $.ajax({
    url:"<?php echo base_url();?>"+"index.php/sacAd/update_contact",
    data:{address:$('#address').val()},
    type:"get", 
    dataType:"json"
  });

  xyz.done(function (res){
    bootbox.alert("Contact Info Updated Successfully");
  });

  xyz.fail(function(){
        bootbox.alert("This is the default alert!");
  
  });

  }
  
</script>

</body>
</html>
