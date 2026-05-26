 <!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
   
  
	<?php include 'header.php';?>
	<!--<section id="video" class="video clearfix" style="background: url(<?php echo base_url();?>uploads/interview/<?php echo $interview['Image']; ?>) ">-->
	<!--<img src="<?php //echo base_url();?>uploads/interview/<?php //echo $interview['CoverImage']; ?>">-->
 <!--       <div class="container reveal-bottom-fade">-->
 <!--           <div class="row">-->
 <!--               <div class="col-md-12">-->
				
                    
								<!--/.Content-->

	<!--						</div>-->
 <!--                       </div>-->
 <!--                   </div>-->
 <!--               </div>-->
 <!--           </div>-->
 <!--       </div>-->
 <!--   </section>-->
	
<section id="video" class="video clearfix" style="background: url(<?php echo base_url();?>uploads/interview/<?php echo $interview['CoverImage']; ?>); background-repeat: no-repeat; background-size:cover; ">
	<!--<img src="<?php// echo base_url();?>uploads/interview/<?php// echo $interview['Image']; ?>">-->
        <div class="container reveal-bottom-fade">
            <div class="row">
                <div class="col-md-12">
				
                    <div class="video-inner" >
                       
					    <a data-toggle="modal" data-target="#modal1" style=" position: absolute; bottom: 0; right: 0; top:100%; width:auto;">
                            <i class="fa fa-play " aria-hidden="true"></i>
                        </a>
                        
                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">

								<!--Content-->
								<div class="modal-content">

								  <!--Body-->
								  <div class="modal-body mb-0 p-0">
                        
									<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
									  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($interview['Link'],17);?>"
										allowfullscreen></iframe>
									</div>

								  </div>

								  <!--Footer-->
								  <div class="modal-footer justify-content-center">
									

									<button class="btn ml-4" data-dismiss="modal">Close</button>

								  </div>

								</div>
								<!--/.Content-->

							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
		
	
	
	
	
	
	<section class="intrvw-sectn">
        <div class="container">
            <div class="row blog-feature justify-content-md-center">
                <div class="col-lg-9 col-md-8">
                    <div class="interws-content-section">
						    <h3><?php echo $interview['Title']; ?> </h3>   
                           
				  <!--<?php echo $interview['Details']; ?>                               -->
                     
                    </div> 
                   
                    
                    
                </div>
				
				
				
				
				 <?Php foreach($add as $val) { ?>
				 <div class="col-lg-4 col-md-3">
				   <div class="advtmnt-bx">
						<img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid">
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
