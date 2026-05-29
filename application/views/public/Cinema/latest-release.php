<!DOCTYPE html>
<html lang="en">

<head>
   <?php include 'top-css.php'; ?>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
   <style type="text/css">
      .btn {
         position: absolute;
         top: 50%;
         left: 45%;
         transform: translate(-50%, -50%);
         -ms-transform: translate(-50%, -50%);
         background-color: transparent;
         color: white;
         font-size: 16px;
         padding: 12px 24px;
         border: none;
         cursor: pointer;
         border-radius: 5px;
      }

      .btn:hover {
         border: none;
      }

      .btn:active {
         border: none;
      }

      .flickity-prev-next-button {
         display: none;
      }

      .banner-content h5 {
         color: red;
      }

      .banner-content p {
         text-align: justify;
         font-weight: normal;
      }

      .banner-content p img,
      .banner-content img {
         max-width: 100%;
         height: auto;
         display: block;
         margin: 10px 0;
      }
   </style>
</head>

<body>
   <?php include 'logo.php'; ?>

   <?php include 'header.php'; ?>

   <section class="main-sctn pt0">
      <div class="container">
         <div class="row">
            <div class="col-md-9 pr0">
               <div class="row  mb3">
                  <div class="blog">
                     <!--  <div class="col-md-12">
                           -->
                     <div class="row">
                        <?php foreach ($film as $val) { ?>
                           <div class="col-xl-11 col-md-11 stretch-card grid-margin">
                              <div class="position-relative">
                                 <img src="<?php echo base_url(); ?>uploads/film_image/<?php echo $val['Image']; ?>" alt="banner" class="img-fluid" />
                                 <div class="banner-content">
                                    <h5 class="mb-0"><?php echo $val['FilmName']; ?></h5>
                                    <p class="mb-2" style="margin-top: 10px;">
                                       <?php echo html_entity_decode(stripslashes((string) $val['Details']), ENT_QUOTES, 'UTF-8'); ?>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                     </div>
                     <!--.row-->
                  </div>
               </div>
               <!-- </div> -->
               <div class="row  mb3">
                  <div class="blog">
                     <!-- <div class="col-md-12"> -->
                     <div class="row">
                        <?php foreach ($trailer as $val) { ?>
                           <div class="col-xl-11 col-md-11 stretch-card grid-margin">
                              <div class="position-relative">
                                 <a href="<?php echo "https://youtube.com/embed/" . substr($val['TrailerLink'], 17); ?>" target="_blank"><img src="<?php echo base_url(); ?>uploads/trailer_image/<?php echo $val['Photo']; ?>" alt="" style="width:100%;"><button class="btn"><span><img src="<?php echo base_url(); ?>img/play.png" alt="thumb" width="80" height="80" style="width:80px;" /></span></button></a>
                              </div>
                           </div>
                        <?php } ?>
                     </div>
                     <!--.row-->
                  </div>
               </div>
               <!-- </div> -->
            </div>
            <div class="col-md-3">
               <div class="row">
                  <div class="col-md-12">
                     <div class="clctn-hed">
                        <h4>PHOTO GALLERY</h4>
                     </div>
                     <div class="clctn-list" style="border: none;box-shadow: none;">
                        <div class="carousel-blog">
                           <?php foreach ($photo as $val) { ?>
                              <div class="carousel-cell ">
                                 <!-- <div class="col-md-4 pr0">
                                    <img src="<?php echo base_url(); ?>uploads/Crew_image/<?php echo $val['Photo']; ?>" alt="" class="img-fluid"> 
                                    </div> -->
                                 <div class="col-sm-6 col-md-6 col-lg-4">
                                    <img src="<?php echo base_url(); ?>uploads/Crew_image/<?php echo $val['Photo']; ?>" class="img-responsive fit-image">
                                 </div>
                              </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="wk-trnd-lst" style="border: none;box-shadow: none;">
                        <ul>
                           <?Php foreach ($add as $val) { ?>
                              <li>
                                 <div class="advtmnt-bx">
                                    <img src="<?php echo base_url(); ?>uploads/advertise_image/<?php echo $val['Photo']; ?>" alt="" class="img-fluid">
                                 </div>
                              </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="clctn-hed">
                        <h4>LATEST SONGS</h4>
                     </div>
                     <div class="clctn-list" style="border: none;box-shadow: none;">
                        <!-- <table class="table table-borderless"> -->
                        <!--  <tbody> -->
                        <?php foreach ($songs as $val) { ?>
                           <div class="main-lsts">
                              <div class="col-md-4 pr0">
                                 <a href="<?php echo "https://youtube.com/embed/" . substr($val['Link'], 17); ?>" target="_blank"> <img src="<?php echo base_url(); ?>uploads/song_image/<?php echo $val['Photo']; ?>" alt="" class="img-fluid"> </a>
                              </div>
                              <div class="col-md-8 mv-detl">
                                 <a href="<?php echo "https://youtube.com/embed/" . substr($val['Link'], 17); ?>" target="_blank" style="float: left; background: none; color: #000;">
                                    <p><?php echo $val['SongName']; ?></p>
                                 </a>
                              </div>
                           </div>
                        <?php } ?>
                        <!-- </tbody>
                              </table> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- <div class="space"></div> -->
   <?php include 'footer.php'; ?>
   <?php include 'bottom-js.php'; ?>
</body>

</html>