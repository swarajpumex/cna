<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  <?php include 'logo.php';?>
	<?php include 'header.php';?>
	
	
	
	
	
	
	
	<section class="songs-sectn">
        <div class="container">
            <div class="row justify-content-md-center">
			
			<?php foreach($trailer as $val) { ?>
                        <div class="col-md-4">
                            <div class="sng-bx">
                               <div class="embed-responsive embed-responsive-21by9">
								  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
                            </div>
                        </div>
						
			<?php } ?>
                     
           
						
                </div>
				
        </div>
    </section>
	
	
<?php include 'footer.php';?>
   
<?php include 'bottom-js.php';?>
<script>
 $('#modal1').on('hidden.bs.modal', function (e) {
  // do something...
  $('#modal1 iframe').attr("src", $("#modal1 iframe").attr("src"));
});


</script>
  </body>

</html>
