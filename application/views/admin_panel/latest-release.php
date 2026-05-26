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
<style type="text/css">
 .overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 10px;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

.overlay:hover {
  display: block;
  background: rgba(0, 0, 0, .3);
}


.button  {
  width: 85%;
  padding: 5px 5px;
  text-align: center;
  color: white;
  border: solid 2px white;
  z-index: 1;
  position: absolute;
  
  top: 50px;
  
  opacity: 0;
  transition: opacity .35s ease;
}

.button:hover{
  opacity: 1;
  cursor:pointer;
  font-weight: 600;
  background: rgba(0, 0, 0, .5);
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
				   <th>Title</th>
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
				  <th>Title</th>
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
                     
                      <!-- <div class="form-group" id="">
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
                        </div> -->
                        
                        
                        
                        <!------ file upload BLOCK ends --->
             <div class="form-group" id="">
                            <label for="userfile" class="control-label col-md-3">Image</label>
                            <div class="col-md-9">
                               <button type="button" id="myBtn" onClick="addImg();" class="btn btn-info">Library</button>
                               <input type ="hidden" name="image-selected" readonly="readonly" id="image-selected" class="optional">
                               <label class="btn btn-primary btn-file"> Add New<input type="file"  accept="image/*" name="userfile" id="userfile" class="optional"
                               style='position:absolute;z-index:2;top:0;left:0;filter: 
                               alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                               opacity:0;background-color:transparent;color:transparent;'
                               onchange="$('#upload-file-info').html($(this).val());">
                                     
                                </label>
                                <span class='label label-info' id="upload-file-info"></span>
                                <span  id="upload"></span>
                            <span class="help-block"></span>
                                
                            </div>
                            
                        </div>
             
            <?php require_once('common-hid-fields.php');?>
                
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="button" id="btnSave" onClick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" onClick="cancel()" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</div>


<!-- Bootstrap modal FOR ADDING AND EDITING -->
<div class="modal" id="modal_form1" role="dialog" style="margin:0 3em;">
  <!--  <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Select Image</h3>
    
            </div> -->
    <section class="intrvw-sectn" style="background: #fff;position: absolute; top: 10%; left: 0;right: 0;padding:  5% 0;">
        <div class="container">
            <div class="row ">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
      <?php $i=1; foreach($media as $val) { $lib='img_lib-'. $i;?>
        <div class="col-md-2 poster-list" id="<?php echo $i ?>" >
          <img src="<?php echo base_url();?>uploads/film_image/<?php echo $val['Photo'];?>" id= "<?php echo $lib ?>" alt="" class="img-thumbnail poster" style="height: 125px;">
         
          <div class="button poster-btn" id="poster-btn-<?php echo $i ?>"> SELECT </div>
         </div>
      <?php $i++; } ?>
          </div>
      </div>
  </section>
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<?php require_once ("bottom-js.php"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin/latest-release.js"></script>
<script type="text/javascript">
$('#DateCreated').datepicker();

$(".poster-btn").click(function(){

    var divid = $(this).parent().attr('id');
    var imgsrc= $('#'+ divid +' img').attr('src');
    var fileNameIndex = imgsrc.lastIndexOf("/") + 1;
    var filename = imgsrc.substr(fileNameIndex);
    console.log(imgsrc);
    //$('#image-selected').val(imgsrc);
    $('#image-selected').val(imgsrc);
    $('#modal_form1').modal('toggle'); 
    $('#upload').text(filename);
// document.getElementById("form").reset();
    // divid.children("span").text(imgsrc);
    
  
});
</script>
<script>
    function cancel(){
      location.reload(true);
      }
</script>
</body>

</html>
