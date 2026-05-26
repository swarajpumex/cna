<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  
	<?php include 'header.php';?>
	
	
	
	
	
	
	
	<section class="intrvw-sectn">
        <div class="container">
            <div class="row">
			<?php //foreach($review as $val) { ?>
                       <!-- <div class="col-md-4">
                            <div class="revw-bx">
                                <div class="rvws-img"><a href="#">
								<img src="<?php echo base_url();?>img/review/01.jpg" alt="" class="img-fluid"></a>
                                </div>
                                <div class="rvws-content">
                                    <a href="#"><h4> <?php echo $val['Title'];?></h4></a>
                                    <p><?php echo $val['Details'];?></p>
                                    <a href="<?php echo base_url();?>Site/reviewdetail/<?php echo $val['Id'];?>" class="inte-btn">Read More</a>
                                </div>
                            </div>-->
			<?php //} ?>
			
			
			
								
			
			
			
						<?php foreach($review as $val){
									
									
									
									
									$img=$val['Details'];
									$start=strpos($img,'src="');
									$img=substr($img,$start+5);
									$end=strpos($img,'"');
									$img=substr($img,0,$end);
									$baselength=strlen(base_url());
									
								?>	
								
                    <div class="col-md-4">
                            <div class="revw-bx">
                                <div class="rvws-img"><a href="#">
								<?php
								if(file_exists(substr($img,$baselength)))
								echo '<img src="'.$img.'"" alt="" class="img-fluid">';
							 ?>
							</a>
                                </div>
                                <div class="rvws-content">
                                    <a href="#"><h4> <?php echo $val['Title'];?> </h4></a>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    <a href="<?php echo base_url();?>Site/reviewdetail/<?php echo $val['Id'];?>" class="inte-btn">Read More</a>
                                </div>
                            </div>
                        </div><?php } ?>
                       <!-- <div class="col-md-4">
                            <div class="revw-bx">
                                <div class="rvws-img"><a href="#">
								<img src="<?php echo base_url();?>img/review/01.jpg" alt="" class="img-fluid"></a>
                                </div>
                                <div class="rvws-content">
                                    <a href="#"><h4> Chat with Actor </h4></a>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    <a href="<?php echo base_url();?>Site/reviewdetail" class="inte-btn">Read More</a>
                                </div>
                            </div>
                        </div>-->
						
						
						
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
