<!DOCTYPE html>
<html lang="en">

<head>
   <?php include 'top-css.php'; ?>
   <style type="text/css">
      .detail-content img {
         max-width: 100%;
         height: auto;
         display: block;
         margin: 12px 0;
      }

      /* .detail-content p {
         margin: 0 0 0.35em;
         line-height: 1.30;
         font-size: 16px;
      } */

      .detail-content p:last-child {
         margin-bottom: 0;
      }
   </style>
   <?php foreach ($films as $values) { ?>
      <?php
      $metaTitle = htmlspecialchars($values['FilmName'], ENT_QUOTES, 'UTF-8');
      $metaDescription = htmlspecialchars(trim(strip_tags($values['Details'])), ENT_QUOTES, 'UTF-8');
      ?>
      <title> <?php echo $metaTitle; ?> </title>
      <meta name="description" content="<?php echo $metaDescription; ?>">
      <meta property="og:title" content="<?php echo $metaTitle; ?>" />
      <meta property="og:image" content="<?php echo base_url(); ?>uploads/film_image/<?php echo $values['Image']; ?>">
      <meta property="og:image:width" content="850" />
      <meta property="og:image:height" content="500" />
      <meta property="og:description" content="<?php echo $metaDescription; ?>">
      <meta name="twitter:title" content="<?php echo $metaTitle; ?>">
      <meta name="twitter:image" content="<?php echo base_url(); ?>uploads/film_image/<?php echo $values['Image']; ?>">
      <meta name="twitter:description" content="<?php echo $metaDescription; ?>">

   <?php } ?>










</head>

<body>





   <!---SOCIAL MEDIA SHARE PLUGIN--->



   <!--<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f57a0e8de227f00121470c2&product=sop' async='async'></script>--->




   <!--<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f57a0e8de227f00121470c2&product=sop' async='async'></script>--->











   <?php include 'header.php'; ?>
   <section class="main-sctn pt0">
      <div class="container">
         <div class="row ">

            <div class="col-md-9">
               <div class="blog">
                  <!--  <div class="col-md-12">
                           -->



                  <div class="row">
                     <?php foreach ($films as $values) { ?>
                        <div class="col-md-11">
                           <div class="banner-content">
                              <h3><?php echo $values['FilmName']; ?></h3>
                              <?php $date = date('d-m-Y', strtotime($values['DateCreated'])); ?>
                              <p class="bnrsubhd"><?php echo $date; ?></p>
                           </div>

                           <!------------------------------------------------------------------------------------------------------------------------------------->

                           <!--- SOCIAL MEDIA SHARING CODE--->


                           <!--<meta property="og:image:secure_url" itemprop="image" content="https://www.w3schools.com/images/picture.jpg">-->

                           <!--<a href="whatsapp://send?text=<?php echo current_url(); ?>" >share on whatsapp</a>-->




                           <!----------------------------------------------------------------------------------------------------------------------------------------------->








                           <div class="bnrpic1">
                              <img src="<?php echo base_url(); ?>uploads/film_image/<?php echo $values['Image']; ?>" alt="banner" class="img-fluid">
                           </div>






                           <div class="banner-content">
                              <p><b><?php echo $values['By_Line']; ?></b></p>
                              <!-- <h5 class="mb-0" ><?php echo $values['FilmName']; ?></h5> -->
                              <div class="mb-2 detail-content" style="font-size: 24px;">
                                 <b><?php echo $values['Place']; ?> : </b>
                                 <?php
                                 $detailsInline = trim((string) $values['Details']);
                                 $detailsInline = html_entity_decode(stripslashes($detailsInline), ENT_QUOTES, 'UTF-8');
                                 $detailsInline = preg_replace('/<\?xml[^>]*\?>/i', '', $detailsInline);
                                 $detailsInline = preg_replace('/^\s*<p[^>]*>/i', '', $detailsInline);
                                 $detailsInline = preg_replace('/<\/p>\s*$/i', '', $detailsInline);
                                 echo $detailsInline;
                                 ?>
                              </div>
                           </div>

                        </div>

                        <div class="col-md-11 mt4">
                           <div class="row">
                           <?php } ?>
                           <?php foreach ($trailer as $val) { ?>
                              <div class="col-xl-6 col-md-12 stretch-card grid-margin mb3">
                                 <div class="embed-responsive embed-responsive-16by9">
                                    <!--<a href="<?php echo "https://youtube.com/embed/" . substr($val['TrailerLink'], 17); ?>" target="_blank"><img  src="<?php echo base_url(); ?>uploads/trailer_image/<?php echo $val['Photo']; ?>" alt="" style="height: 300px;"><button class="btn"><span><img src="<?php echo base_url(); ?>img/play.png" alt="thumb" width="80" height="80" style="width:80px;"/></span></button></a> -->

                                    <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/" . substr($val['TrailerLink'], 17); ?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                 </div>
                              </div>
                           <?php } ?>
                           </div>
                        </div>





                        <?php

                        //$title=$values['FilmName'];
                        //$summary="Dedscccc";
                        //$image="http://cinemanewsagency.com/uploads/film_image/a47b258484bca2a803fb05a5b0d6212c.jpg";
                        //$url="http://cinemanewsagency.com/Site/detail/MarakkarArabikkadalinteSimham1";
                        ?>
                        <!--<a onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&title=<?php echo $title; ?>');"  href="javascript: void(0)">SHAREEEEEEE</a>-->

                  </div>
                  <!--.row-->
               </div>
            </div>
            <div class="col-md-3 mt-4">
               <div class="row">

                  <?php foreach ($add_detail as $val) { ?>

                     <div class="bk-shw" style="margin-bottom: 1em;">
                        <?= empty($val['Link']) ? "" : "<a href=\"{$val['Link']}\" target=\"_blank\">" ?>
                        <img src="<?php echo base_url(); ?>uploads/advertise_image/<?php echo $val['Photo']; ?>" alt="Image" class="img-fluid">
                        <?= empty($val['Link']) ? "" : "</a>" ?>
                     </div>
                  <?php } ?>
               </div>
               <!--<div class="row">-->
               <!--   <div class="wk-trnd"></div>-->
               <!--   <?php foreach ($side_add as $val) { ?>-->
               <!--   <div class="bk-shw"> -->
               <!--      <img src="<?php echo base_url(); ?>uploads/advertise_image/<?php echo $val['Photo']; ?>" alt="Image" class="img-fluid" style="height: 250px">-->
               <!--   </div>-->
               <!--   <?php } ?>-->
               <!--</div>-->
            </div>

         </div>




      </div>
      </div>




   </section>





   <!-- Go to www.addthis.com/dashboard to customize your tools -->
   <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f8e748777d449bf"></script>





   <?php include 'footer.php'; ?>
   <?php include 'bottom-js.php'; ?>






</body>

</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="http://cinemanewsagency.com/js/share.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">