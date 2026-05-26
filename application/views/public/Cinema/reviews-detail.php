      <!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  
	<?php include 'header.php';?>
	<section id="video" class="video clearfix" style="background: url(<?php echo base_url();?>uploads/review/<?php echo $review['Image']; ?>) center; background-repeat: no-repeat;">
        <div class="container reveal-bottom-fade">
            <div class="row">
                <div class="col-md-12">
                    <div class="video-inner">
					    <a data-toggle="modal" data-target="#modal1">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </a>
                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">

								<!--Content-->
								<div class="modal-content">

								  <!--Body-->
								  <div class="modal-body mb-0 p-0">

									<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
									  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($review['Link'],17);?>"
										allowfullscreen></iframe>
									</div>

								  </div>

								  <!--Footer-->
								  <div class="modal-footer justify-content-center">
									<span class="mr-4">Spread the word!</span>
									<a class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
									<!--Twitter-->
									<a  class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
									
									<!--Linkedin-->
									<a class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

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
            <div class="row justify-content-md-center">
                <div class="col-lg-9 col-md-8">
                    <div class="revw-content-section">
					 <h3><?php echo $review['Title']; ?></h3>  
					 <?php echo $review['Details']; ?> 
						    <!--<div class="revw-pics">
							<?php
								//if(file_exists(substr($img,$baselength)))
								//echo '<img src="'.$img.'"" alt="" class="img-fluid">';
							 ?>
							
							</div>
								
                         
                         
                            <h3><?php echo $review['Title']; ?></h3>                            
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nstrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nstrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa cupidatat non proident, sunt in culpa.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            
							
							
							
							<div class="embed-responsive embed-responsive-21by9">
							 <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/FgWD_v0jpoo"></iframe>
							</div>
							
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nstrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nstrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa cupidatat non proident, sunt in culpa.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
							
							<div class="revw-pics">
							<img src="img/review-detal/01.jpg" alt="" class="img-fluid">
							</div>-->
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
