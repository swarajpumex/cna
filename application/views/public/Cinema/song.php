<!DOCTYPE html>
<html lang="en">

<head>
   <?php include 'top-css.php'; ?>
</head>

<body>
   <?php include 'logo.php'; ?>

   <?php include 'header.php'; ?>







   <section class="intrvw-sectn">
      <div class="container">
         <div class="row justify-content-md-center">
            <?php
            $i = 1;
            ?>
            <?php foreach ($song as $val) {
               $model = 'model' . $i; ?>
               <div class="Portfolios col-md-4">
                  <div class="revw-bx">
                     <div class="rvws-img">
                        <img src="<?php echo base_url(); ?>uploads/song_image/<?php echo $val['Photo']; ?>" alt="" class="img-fluid" loading="lazy" decoding="async">
                     </div>
                     <div class="rvws-content">
                        <a href="#">
                           <div class="desc"><?php echo $val['SongName']; ?> </div>
                        </a>
                        <!--  <p><?php echo $val['Details']; ?></p> -->
                        <a data-toggle="modal" data-target="#<?php echo $model ?>" href=" " class="inte-btn" id="video">Watch Song</a>
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
                                                   <iframe class="embed-responsive-item" data-src="<?php echo "https://youtube.com/embed/" . substr($val['Link'], 17); ?>"
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
                     </div>
                  </div>
               </div>
            <?php $i++;
            }    ?>
         </div>
         <?php include 'pagination.php'; ?>
      </div>
   </section>



   <?php include 'footer.php'; ?>

   <?php include 'bottom-js.php'; ?>
   <script type="text/javascript">
      $('.modal').on('shown.bs.modal', function() {
         var iframe = $(this).find('iframe[data-src]');
         iframe.attr('src', iframe.data('src'));
      }).on('hidden.bs.modal', function() {
         $(this).find('iframe[data-src]').removeAttr('src');
      });
   </script>
</body>

</html>