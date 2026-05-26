<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  <?php include 'logo.php';?>
	<?php include 'header.php';?>
	
	
	
	
	
	
	
	<!--<section class="intrvw-sectn">-->
 <!--       <div class="container">-->
 <!--           <div class="row">-->
	<!--		         <?php foreach($trailer as $val){?>-->
 <!--                       <div class="col-md-4">-->
 <!--                           <div class="revw-bx">-->
 <!--                               <div class="rvws-img"><a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" target="_blank">-->
	<!--							<img src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"></a>-->
 <!--                               </div>-->
 <!--                               <div class="rvws-content">-->
 <!--                                   <a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" target="_blank"><h4><?php echo $val['FilmName'];?> </h4></a>-->
 <!--                                   <p></p>-->
 <!--                                   <a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" class="inte-btn" target="_blank">Watch Video</a>-->
 <!--                               </div>-->
 <!--                           </div>-->
 <!--                       </div><?php } ?>-->
                        
						
						
 <!--               </div>-->
           
 <!--       </div>-->
         <section class="intrvw-sectn">
         <div class="container">
           <div class="row justify-content-md-center">
               <?php
                  $i=1;
                  ?>
               <?php foreach($trailer as $val){ $model='model'. $i;?>
               <div class="Portfolios col-md-4">
                  <div class="revw-bx">
                     <div class="rvws-img">
                        <img src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid">
                     </div>
                     <div class="rvws-content">
                       
                           <div class="desc"><?php echo $val['FilmName'];?> </div>
                        
                        <p><?php echo $val['Details'];?></p>
                        <a data-toggle="modal" data-target="#<?php echo $model ?>"  href=" " class="inte-btn" id="video">Watch Video</a>
                        <div class="container reveal-bottom-fade">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="video-inner" style="padding: 0">
                                    <div class="modal fade" id="<?php echo $model ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                       <div class="modal-dialog modal-lg" role="document">
                                          <!--Content-->
                                          <div class="modal-content">
                                             <!--Body-->
                                             <div class="modal-body mb-0 p-0">
                                                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                                   <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>"
                                                      allowfullscreen></iframe>
                                                </div>
                                             </div>
                                             <!--Footer-->
                                             <div class="modal-footer justify-content-center">
                                                
                                                <button onclick="pauseVideo()" class="btn ml-4" data-dismiss="modal">Close</button>
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
    //alert();
 location.reload(true); 
// var url = $('#playerID').attr('src');
// $('#playerID').attr('src', '');
// $('#playerID').attr('src', url);
}
</script>
  </body>

</html>
