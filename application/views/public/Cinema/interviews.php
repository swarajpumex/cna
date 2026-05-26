<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  
	<?php include 'logo.php';?>
	<?php include 'header.php';?>
	
	
	
	
	
	
	
	<section class="intrvw-sectn">
        <div class="container">
            <div class="row justify-content-md-center">
			<?php foreach($interview as $val) {?>
                        <div class="Portfolios col-md-3">
                            <div class="intrvw-bx">
                               <div class="intrvw-img">
								<a href="#">
								<img src="<?php echo base_url();?>uploads/interview/<?php echo $val['CoverImage'];?>" alt="" class="img-fluid">
								</a>
                                    <!--<div class="intrvw-date">
                                        <h3>13 <small>Jun</small></h3>
                                    </div>-->
                                </div>
                                <div class="intrvw-content">
                                    <a href="<?php echo base_url();?>Site/interviewdetails/<?php echo $val['Id'];?>"><div class="desc"> <?php echo $val['Title']; ?></div>
                                     <!--<p><?php echo $val['Description']; ?></p>-->
                                     </a>
                                  <!--<a href="<?php echo base_url();?>Site/interviewdetails/<?php echo $val['Id'];?>" class="inte-btn">Read More</a>-->
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
