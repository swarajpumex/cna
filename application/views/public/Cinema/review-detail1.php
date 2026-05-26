<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  
	<?php include 'header.php';?>
	
	
	
	
	
	
	
	
	<section class="revw-sectn">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-md-8">
                    <div class="revw-content-section">
						   
						   
						   
						   <p><?php echo $review['Details']; ?></p>
                         
                                                         
                     
                    </div> 
                   
                    
                    
                </div>
				
				
				
				
				
				
						
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
