<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  
	<?php include 'header.php';?>
	
	
	
	
	
	
	
	<!--<section class="songs-sectn">-->
 <!--       <div class="container">-->
 <!--           <div class="row">-->
	<!--		<?php foreach($song as $val) { ?>-->
 <!--                       <div class="col-md-4">-->
 <!--                           <div class="sng-bx">-->
 <!--                              <div class="embed-responsive embed-responsive-21by9">-->
	<!--							  <iframe class="embed-responsive-item" src="<?php echo $val['Link'];?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
	<!--							</div>-->
 <!--                           </div>-->
 <!--                       </div>-->
	<!--		<?php } ?>-->
                       
						
						
 <!--               </div>-->
				
           
 <!--       </div>-->
 <!--   </section>-->
<section class="intrvw-sectn">
         <div class="container">
             <div class="row justify-content-md-center">
               <?php
                  $i=1;
                  ?>
               <?php foreach($song as $val){ $model='model'. $i;?>
               <div class="Portfolios col-md-4">
                  <div class="revw-bx">
                     <div class="rvws-img">
                        <img src="<?php echo base_url();?>uploads/song_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid">
                     </div>
                     <div class="rvws-content">
                        <a href="#">
                           <div class="desc"><?php echo $val['SongName'];?> </div>
                        </a>
                       <!--  <p><?php echo $val['Details'];?></p> -->
                        <a data-toggle="modal" data-target="#<?php echo $model ?>"  href=" " class="inte-btn" id="video">Watch Video</a>
                        <div class="container reveal-bottom-fade">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="video-inner" style="padding: 0">
                                    <div class="modal fade" id="<?php echo $model ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-lg" role="document">
                                          <!--Content-->
                                          <div class="modal-content">
                                             <!--Body-->
                                             <div class="modal-body mb-0 p-0">
                                                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                                   <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>"
                                                      allowfullscreen></iframe>
                                                </div>
                                             </div>
                                             <!--Footer-->
                                            <!-- <div class="modal-footer justify-content-center">
                                                <span class="mr-4">Spread the word!</span>
                                                <a class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                                                <!--Twitter-->
                                              <!--  <a  class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                                                <!--Linkedin-->
                                             <!--   <a class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>!-->
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
                     </div>
                  </div>
               </div>
               <?php $i++;}    ?>
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
  $('#modal1').modal({backdrop: 'static', keyboard: false})
});


</script>
<script type="text/javascript">
  function pauseVideo() {
  location.reload(true); 
}
</script>
  </body>

</html>
