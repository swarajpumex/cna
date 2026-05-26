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
			         <?php foreach($review as $val){?>
                        <div class="Portfolios col-md-4">
                            <div class="revw-bx">
                                <div class="rvws-img"><a href="#">
								<img src="<?php echo base_url();?>uploads/review/<?php echo $val['CoverImage'];?>" alt="" class="img-fluid"></a>
                                </div>
                                <div class="rvws-content">
                                    <a href="#"><div class="desc"><?php echo $val['Title'];?> </div></a>
                                    <p><?php echo $val['Description'];?></p>
                                    <a href="<?php echo base_url();?>Site/reviewdetail/<?php echo $val['Id'];?> " class="inte-btn">Read More</a>
                                </div>
                            </div>
                        </div><?php } ?>
                        
						
						
                </div>
           
        </div>
    </section>
	
	
	
	
	
	<div class="space"></div>
	
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
