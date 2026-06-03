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

      .youtube-trailer-wrap {
         position: relative;
         width: 100%;
         max-width: 100%;
         height: 0;
         padding-top: 56.25%;
         margin: 0 0 15px;
      }

      .youtube-trailer-frame {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         border: 0;
         display: block;
      }

      .detail-content .social-video-embed-instagram,
      .detail-content .social-video-embed-facebook,
      .detail-content iframe[src*="instagram.com"],
      .detail-content iframe[src*="facebook.com/plugins/video.php"],
      .detail-content iframe[src*="facebook.com/plugins/post.php"],
      .detail-content iframe[src*="facebook.com/watch"],
      .detail-content iframe[src*="facebook.com/reel"] {
         width: 100% !important;
         max-width: 100% !important;
         height: auto !important;
         display: block;
         margin: 15px 0;
         border: 0;
      }

      @media (max-width: 768px) {

         .detail-content .social-video-embed-instagram,
         .detail-content .social-video-embed-facebook,
         .detail-content iframe[src*="instagram.com"],
         .detail-content iframe[src*="facebook.com/plugins/video.php"],
         .detail-content iframe[src*="facebook.com/plugins/post.php"],
         .detail-content iframe[src*="facebook.com/watch"],
         .detail-content iframe[src*="facebook.com/reel"] {
            max-width: 100% !important;
         }
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

   <?php include 'header.php'; ?>
   <section class="main-sctn pt0">

      <script>
         (function() {
            function isYouTubeEmbed(iframe) {
               var src = (iframe.getAttribute('src') || '').toLowerCase();
               return src.indexOf('youtube.com/embed/') !== -1 ||
                  src.indexOf('youtube-nocookie.com/embed/') !== -1 ||
                  src.indexOf('youtu.be/') !== -1;
            }

            function parsePixels(value) {
               if (!value) {
                  return null;
               }

               var match = String(value).match(/(\d+(?:\.\d+)?)/);
               return match ? parseFloat(match[1]) : null;
            }

            function parseStylePixels(styleText, prop) {
               if (!styleText) {
                  return null;
               }

               var regex = new RegExp(prop + '\\s*:\\s*(\\d+(?:\\.\\d+)?)px', 'i');
               var match = String(styleText).match(regex);
               return match ? parseFloat(match[1]) : null;
            }

            function getDimensionsFromSrc(src) {
               if (!src || !window.URL) {
                  return null;
               }

               try {
                  var url = new URL(src, window.location.href);
                  var width = parsePixels(url.searchParams.get('width'));
                  var height = parsePixels(url.searchParams.get('height'));
                  if (width > 0 && height > 0) {
                     return {
                        width: width,
                        height: height
                     };
                  }
               } catch (e) {
                  return null;
               }

               return null;
            }

            function getEmbedDimensions(iframe) {
               var styleText = iframe.getAttribute('style') || '';
               var width = parsePixels(iframe.getAttribute('width')) ||
                  parsePixels(iframe.style.width) ||
                  parseStylePixels(styleText, 'width');
               var height = parsePixels(iframe.getAttribute('height')) ||
                  parsePixels(iframe.style.height) ||
                  parseStylePixels(styleText, 'height');

               if (width > 0 && height > 0) {
                  return {
                     width: width,
                     height: height
                  };
               }

               return getDimensionsFromSrc(iframe.getAttribute('src') || '');
            }

            function getEmbedType(iframe) {
               var src = (iframe.getAttribute('src') || '').toLowerCase();
               if (iframe.classList.contains('social-video-embed-instagram') || src.indexOf('instagram.com') !== -1) {
                  return 'instagram';
               }

               if (iframe.classList.contains('social-video-embed-facebook') ||
                  src.indexOf('facebook.com/plugins/video.php') !== -1 ||
                  src.indexOf('facebook.com/plugins/post.php') !== -1 ||
                  src.indexOf('facebook.com/watch') !== -1 ||
                  src.indexOf('facebook.com/reel') !== -1) {
                  return 'facebook';
               }

               return '';
            }

            function isFacebookEmbed(iframe) {
               var src = (iframe.getAttribute('src') || '').toLowerCase();
               return iframe.classList.contains('social-video-embed-facebook') ||
                  src.indexOf('facebook.com/plugins/video.php') !== -1 ||
                  src.indexOf('facebook.com/plugins/post.php') !== -1 ||
                  src.indexOf('facebook.com/watch') !== -1 ||
                  src.indexOf('facebook.com/reel') !== -1;
            }

            function isSocialEmbed(iframe) {
               var src = (iframe.getAttribute('src') || '').toLowerCase();
               return iframe.classList.contains('social-video-embed-instagram') ||
                  (src.indexOf('instagram.com') !== -1 && src.indexOf('/embed') !== -1);
            }

            function wrapYouTubeEmbeds() {
               var iframes = document.querySelectorAll('.detail-content iframe');
               if (!iframes.length) {
                  return;
               }

               iframes.forEach(function(iframe) {
                  if (!isYouTubeEmbed(iframe)) {
                     return;
                  }

                  if (iframe.parentElement && iframe.parentElement.classList.contains('youtube-trailer-wrap')) {
                     return;
                  }

                  var wrapper = document.createElement('div');
                  wrapper.className = 'youtube-trailer-wrap';

                  iframe.classList.add('youtube-trailer-frame');
                  iframe.style.removeProperty('max-width');
                  iframe.style.removeProperty('aspect-ratio');
                  iframe.style.removeProperty('height');
                  iframe.style.removeProperty('min-height');
                  iframe.style.removeProperty('margin');
                  iframe.style.removeProperty('width');

                  var parent = iframe.parentNode;
                  parent.insertBefore(wrapper, iframe);
                  wrapper.appendChild(iframe);
               });
            }

            function wrapSocialEmbeds() {
               var iframes = document.querySelectorAll('.detail-content iframe');
               if (!iframes.length) {
                  return;
               }

               iframes.forEach(function(iframe) {
                  if (isYouTubeEmbed(iframe)) {
                     return;
                  }

                  var type = getEmbedType(iframe);
                  if (!type && !isSocialEmbed(iframe) && !isFacebookEmbed(iframe)) {
                     return;
                  }

                  var dimensions = getEmbedDimensions(iframe);
                  if (!dimensions) {
                     if (type === 'instagram') {
                        dimensions = {
                           width: 540,
                           height: 850
                        };
                     } else if (type === 'facebook') {
                        dimensions = {
                           width: 500,
                           height: 750
                        };
                     }
                  }

                  if (dimensions) {
                     iframe.style.setProperty('max-width', dimensions.width + 'px', 'important');
                     iframe.style.setProperty('aspect-ratio', dimensions.width + ' / ' + dimensions.height, 'important');
                  }

                  iframe.style.setProperty('width', '100%', 'important');
                  iframe.style.setProperty('height', 'auto', 'important');
                  iframe.style.setProperty('min-height', '0', 'important');
                  iframe.style.setProperty('display', 'block', 'important');
                  iframe.style.setProperty('margin', '15px 0', 'important');
               });
            }

            function initEmbedSizing() {
               wrapYouTubeEmbeds();
               wrapSocialEmbeds();
            }

            document.addEventListener('DOMContentLoaded', initEmbedSizing);
            window.addEventListener('load', initEmbedSizing);
         })();
      </script>
      <div class="container">
         <div class="row ">

            <div class="col-md-9">
               <div class="blog">
                  <div class="row">
                     <?php foreach ($films as $values) { ?>
                        <div class="col-md-11">
                           <div class="banner-content">
                              <h3><?php echo $values['FilmName']; ?></h3>
                              <?php $date = date('d-m-Y', strtotime($values['DateCreated'])); ?>
                              <p class="bnrsubhd"><?php echo $date; ?></p>
                           </div>

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
                                 <div class="youtube-trailer-wrap">
                                    <!--<a href="<?php echo "https://youtube.com/embed/" . substr($val['TrailerLink'], 17); ?>" target="_blank"><img  src="<?php echo base_url(); ?>uploads/trailer_image/<?php echo $val['Photo']; ?>" alt="" style="height: 300px;"><button class="btn"><span><img src="<?php echo base_url(); ?>img/play.png" alt="thumb" width="80" height="80" style="width:80px;"/></span></button></a> -->

                                    <iframe class="youtube-trailer-frame" src="<?php echo "https://youtube.com/embed/" . substr($val['TrailerLink'], 17); ?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                 </div>
                              </div>
                           <?php } ?>
                           </div>
                        </div>
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