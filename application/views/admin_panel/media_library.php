<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $headTitle; ?> Admin | Dashboard</title>
  <?php require_once("top-css-js.php");?>
  
<style type="text/css">
 .overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

.overlay:hover {
  display: block;
  background: rgba(0, 0, 0, .3);
}
.button {
  position: absolute;
  width: auto;
  left:0;
  top: 50px;
  right: 0;
  text-align: center;
  opacity: 0;
  transition: opacity .35s ease;
}

.button  {
  width: auto;
  padding: 5px 5px;
  text-align: center;
  color: white;
  border: solid 2px white;
  z-index: 1;
}

.button:hover{
  opacity: 1;
}
 


</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <?php include 'header.php';?>
  <?php include 'sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">	
	
	<section class="intrvw-sectn">
        <div class="container">
            <div class="row ">

			<?php $i=1; foreach($media as $val) { $lib='img_lib'. $i;?>
        <div class="col-md-2" id="<?php echo $lib ?>" >
          <img src="<?php echo base_url();?>uploads/film_image/<?php echo $val['Photo'];?>" alt="" class="img-thumbnail" onclick="changeIt(this.src)">
         
          <div class="overlay">
          <div class="button"> SELECT </div>
         </div></div>
			<?php $i++; } ?>
          </div>
      </div>
  </section>
	

	
	<div class="space"></div>
	
	</div>
	</div>
<?php include 'footer.php';?>
   
<?php include 'bottom-js.php';?>
<script type="text/javascript">
 $('#img_lib1').click(function() {
  console.log($(this).find('img').attr('src'))
})

</script>
<script>
 $('#modal1').on('hidden.bs.modal', function (e) {
  // do something...
  $('#modal1 iframe').attr("src", $("#modal1 iframe").attr("src"));
});


</script>



  </body>

</html>
