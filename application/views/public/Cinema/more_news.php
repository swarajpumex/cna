<!DOCTYPE html>
<html lang="en">
   <head>
      <?php include 'top-css.php';?>
   </head>
   <body>
     	<?php include 'logo.php';?>
	<?php include 'header.php';?>
      <section class="main-sctn">
         <div class="container">
            <!-- <hr noshade style="margin-top:-20px;"> -->
            <div class="row">
               <!--<div class="tab-content" id="pills-tabContent">-->
               <!--   <div class="tab-pane fade show active" id="showall" role="tabpanel" aria-labelledby="showall-tab">-->
                     <div class="col-md-9">
                         <div class="row justify-content-md-center">
                        <?php 
                           foreach( $film as $val ){ ?>
                        <div class="Portfolio col-md-3 new_class">
                           <a href="<?php echo base_url();?>Site/detail/<?php echo $val['UniqueName'];?>">
                           <img class="card-img" src="<?php echo base_url();?>uploads/film_image/<?php echo $val['Image'];?>" alt="">
                           </a>
                           <div class="desc"><a href="<?php echo base_url();?>Site/detail/<?php echo $val['UniqueName'];?>"><?php echo $val['FilmName'];?></a></div>
                         <!--  <div class="mv-detl d-flex justify-content-center"> <a href="<?php echo base_url();?>Site/detail/<?php echo $val['UniqueName'];?>">MORE</a></div>!-->
                        </div>
                        <?php } ?>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="row">
                           <?php foreach($add_news_list as $val){?>
                           <div class="bk-shw" style="margin-bottom: 1em;"> 
							 <?= empty($val['Link'])? "" : "<a href=\"{$val['Link']}\" target=\"_blank\">" ?>
                              <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid">
							 <?= empty($val['Link'])? "" : "</a>" ?>
                           </div>
                           <?php } ?>
                        </div>
                        <!--<div class="row">-->
                        <!--   <div class="wk-trnd" style="background: #fff;margin-top: 0"></div>-->
                        <!--   <?php foreach($side_add as $val){?>-->
                        <!--   <div class="bk-shw"> -->
                        <!--      <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid" style="height: 250px">-->
                        <!--   </div>-->
                        <!--   <?php } ?>-->
                        <!--</div>-->
                     </div>
                     
            </div>
                  
           <!--    </div>-->
           <!--</div>-->
            
         <!--</div>-->
         <!--</div>-->
         <!--</div>-->
         </div>  
      </section>
      <div class="space"></div>
      <?php include 'footer.php';?>
      <?php include 'bottom-js.php';?>
   </body>
</html>