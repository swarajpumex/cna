
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php include 'top-css.php';?>
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
      <style type="text/css">
         .btn {
         position: absolute;
         top: 50%;
         left: 50%;
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
         .btn:hover{
         border: none;
         }
         .btn:active{
         border: none;
         }
         .flickity-prev-next-button{
         display: none;
         }
         .banner-content h3 {
    color: #8a1b49;
    font-size: 36px;
    font-weight: 700;
         }
         .banner-content p{
             text-align: justify;
    font-weight: normal;
    font-size: 24px;
    line-height: 32px;
         }

      </style>
   </head>
   <body>
       
       
       
      <?php include 'header.php';?>
      <section class="main-sctn pt0">
         <div class="container">
            <div class="row">
               <div class="col-md-8 pr0">
                  <div class="row  mb3">
                     <div class="blog">
                        <!--  <div class="col-md-12">
                           -->

                        <div class="row">
                           <?php foreach($films as $values) {?>
                           <div class="col-xl-11 col-md-11 stretch-card grid-margin">
                              <div class="position-relative">
                                 <div class="banner-content" style="margin:10px 0">
                                    <h3 class="mb-0" ><?php echo $values['FilmName'];?></h3>
                                     <?php $date = date('d-m-Y', strtotime($values['CreatedOn']));?>
                                    <p class="mb-2" style="color: #ddd;"><?php echo $date;?></p>
                                 </div>
                                 <img src="<?php echo base_url();?>uploads/film_image/<?php echo $values['Photo']; ?>" alt="banner" class="img-fluid" style="margin:0 0 10px 0 "/>
                                 
                                 <div class="banner-content">
                                     <p class="mb-2" style="color: #000;"><b><?php echo $values['By_Line'];?></b></p>
                                    <!-- <h5 class="mb-0" ><?php echo $values['FilmName'];?></h5> -->
                                    <p class="mb-2" style="margin-top: 10px;">
                                        <b><?php echo $values['Place'];?>:</b>
                                       <?php echo $values['Details'];?>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           
                           
                           <?php } ?> 
                            <?php foreach($trailer as $val) {?>
                            <div class="col-xl-11 col-md-11 stretch-card grid-margin">
                              <div class="position-relative" style="width: 100%;">
                                  <!--<a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" target="_blank"><img  src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" style="height: 300px;"><button class="btn"><span><img src="<?php echo base_url();?>img/play.png" alt="thumb" width="80" height="80" style="width:80px;"/></span></button></a> -->
                                  
                                  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" style="height: 300px;width: 100%;" allowfullscreen ></iframe>

                              </div>
                           </div>
                           <?php } ?> 
                           
                           
                        </div>
                        <!--.row-->
                     </div>
                  </div>
                  <!-- </div> -->
                 
                  <!-- </div> -->
               </div>
               <div class="col-md-4">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="clctn-hed">
                           <h4>CAST & CREW</h4>
                        </div>
                        <!-- <div class="clctn-list" style="border: none;box-shadow: none;">
                           <div class="carousel-blog">
                              <?php foreach($photo as $val){?>
                              <div class="carousel-cell "> -->
                                 <!-- <div class="col-md-4 pr0">
                                    <img src="<?php echo base_url();?>uploads/Crew_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> 
                                    </div> -->
                                <!--  <div class="col-sm-12 col-md-12 col-lg-12">
                                    <img src="<?php echo base_url();?>uploads/Crew_image/<?php echo $val['Photo'];?>" class="img-responsive fit-image">
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                     </div> -->
                      <div class="row">
                     <div class="col-md-12">
                      <?php foreach($photo as $val){?>          
                           <img src='<?php echo base_url();?>uploads/Crew_image/<?php echo $val['Photo'];?>'  alt="" class="img-responsive img-rounded" style="max-height: 108px; max-width: 108px; margin-bottom:10px;margin-right: 5px;box-sizing: border-box;">
                     <?php } ?>
                  </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="clctn-hed">
                           <h4>THEATORS</h4>
                        </div>
                        <!-- <div class="clctn-list" style="border: none;box-shadow: none;">
                           <div class="carousel-blog">
                              <?php foreach($photo as $val){?>
                              <div class="carousel-cell "> -->
                                 <!-- <div class="col-md-4 pr0">
                                    <img src="<?php echo base_url();?>uploads/Crew_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> 
                                    </div> -->
                                <!--  <div class="col-sm-12 col-md-12 col-lg-12">
                                    <img src="<?php echo base_url();?>uploads/Crew_image/<?php echo $val['Photo'];?>" class="img-responsive fit-image">
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                     </div> -->
                      <div class="row">
                     <div class="col-md-12">
                     <div class="wk-trnd-lst" style="border: none;box-shadow: none;">
                        <ul>
                        <?php foreach($theater as $val){ ?>
                           <li style="text-align: left;">
                            <h5><?php echo $val['TheaterName'];?></h5>

                             <span><?php echo $val['Place'];?></span>
                           </li>
                           
                        <?php } ?>
                           
                        </ul>
                     </div>
                  </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="wk-trnd-lst" style="border: none;box-shadow: none;">
                           <ul>
                              <?Php foreach($add as $val) { ?>
                              <li>
                                 <div class="advtmnt-bx">
                                    <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid">
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
                        <!-- <div class="clctn-list" style="border: none;box-shadow: none;"> -->
                           <!-- <table class="table table-borderless"> -->
                           <!--  <tbody> -->
                           <!-- <?php foreach($songs as $val){ ?>
                           <div class="main-lsts">
                              <div class="col-md-4 pr0">
                                 <a href="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>"  target="_blank" > <img src="<?php echo base_url();?>uploads/song_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> </a>
                              </div>
                              <div class="col-md-8 mv-detl">
                                 <a href="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>"  target="_blank" style="float: left; background: none; color: #000;">
                                    <p><?php echo $val['SongName'];?></p>
                                 </a>
                              </div>
                           </div>
                           <?php } ?> -->
                           <!-- </tbody>
                              </table> -->
                        <!-- </div> -->
                        <div class="row">
                     <div class="col-md-12">
                      <?php foreach($songs as $val){?>          
                           <a href="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>"  target="_blank" ><img src='<?php echo base_url();?>uploads/song_image/<?php echo $val['Photo'];?>'  alt="" class="img-responsive img-rounded" style="max-height: 108px; max-width: 108px; margin-bottom:10px;margin-right: 5px;box-sizing: border-box;"></a>
                     <?php } ?>
                  </div>
                  </div>

                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="clctn-hed">
                           <h4>BOXOFFICE COLLECTION</h4>
                        </div>
                       
                      <div class="row">
                     <div class="col-md-12">
                     <div class="wk-trnd-lst" style="border: none;box-shadow: none;">
                        <ul>
                        <?php foreach($boxoffice as $val){ ?>
                           <li style="text-align: left;">
                            <h3><?php echo $val['Boxoffice'];?></h3>
                               <?php $date = date('d-m-Y', strtotime($values['CreatedOn']));?>
                             <span><?php echo $date;?></span>
                           </li>
                           
                        <?php } ?>
                           
                        </ul>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- <div class="space"></div> -->
      <?php include 'footer.php';?>
      <?php include 'bottom-js.php';?>
   </body>
</html>