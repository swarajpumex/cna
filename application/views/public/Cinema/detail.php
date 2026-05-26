<!DOCTYPE html>
<html lang="en">
   <head>
       <?php include 'top-css.php';?>
       <?php foreach($films as $values) {?>
        <title> <?php echo $values['FilmName'];?> </title>
       <meta name="description" content="<?php echo $values['Details'];?>">
       <meta property="og:title" content="<?php echo $values['FilmName'];?>" />
       <meta property="og:image" content="<?php echo base_url();?>uploads/film_image/<?php echo $values['Image']; ?>" >
       <meta property="og:image:width" content="850" />
       <meta property="og:image:height" content="500" />
       
      <?php } ?>   
       
      
     






     
   </head>

   <body>
       
       



                    <!---SOCIAL MEDIA SHARE PLUGIN--->     



<!--<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f57a0e8de227f00121470c2&product=sop' async='async'></script>--->



                      
<!--<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f57a0e8de227f00121470c2&product=sop' async='async'></script>--->



	





       
       
      <?php include 'header.php';?>
      <section class="main-sctn pt0">
         <div class="container">
            <div class="row ">
                
               <div class="col-md-9">
                  <div class="blog">
                        <!--  <div class="col-md-12">
                           -->
                           
                          

                        <div class="row">
                           <?php foreach($films as $values) {?>
                           <div class="col-md-11">
                              <div class="banner-content">
                                    <h3><?php echo $values['FilmName'];?></h3>
                                     <?php $date = date('d-m-Y', strtotime($values['DateCreated']));?>
                                    <p class="bnrsubhd"><?php echo $date;?></p>
                                 </div>
                                 
                            <!------------------------------------------------------------------------------------------------------------------------------------->
                                  
                                    <!--- SOCIAL MEDIA SHARING CODE--->
                                    
                               
                                <!--<meta property="og:image:secure_url" itemprop="image" content="https://www.w3schools.com/images/picture.jpg">-->
                                

                               
                                    
                              
                              
                              <title> <?php echo $values['FilmName'];?> </title>
                              
                              <meta name="description" content="<?php echo $values['Details'];?>">
                              <meta property="og:title" content="<?php echo $values['FilmName'];?>" />
                              <meta property="og:url" content="<?php echo base_url();?>" />
                              
                              
                           <meta property="og:image" content="<?php echo base_url();?>uploads/film_image/<?php echo $values['Image']; ?>" >
                          <meta property="og:image:width" content="850" />
                        <meta property="og:image:height" content="500" />
                           <meta property="og:description" content="<?php echo $values['Details'];?>" >
                          
                           

                           <meta name="twitter:title" content="<?php echo $values['FilmName'];?>" >
                           <meta name="twitter:image" content="<?php echo base_url();?>uploads/film_image/<?php echo $values['Image']; ?>" >
                           <meta name="twitter:description" content="<?php echo $values['Details'];?>" >
                           
                         

                           
                           
                           
                           
                           
                         
                         <!--<a href="whatsapp://send?text=<?php echo current_url();?>" >share on whatsapp</a>-->
                         
                        
                         
                      
                        <!-----------------------------------------------------------------------------------------------------------------------------------------------> 
                           
                           
                          
                    
                                   
                         
                           
                              
                                 <div class="bnrpic1">
                                <img src="<?php echo base_url();?>uploads/film_image/<?php echo $values['Image']; ?>" alt="banner" class="img-fluid">
                                 </div>
                                 
                                 
                            
                              
                              
                                 
                                 <div class="banner-content">
                                     <p><b><?php echo $values['By_Line'];?></b></p>
                                    <!-- <h5 class="mb-0" ><?php echo $values['FilmName'];?></h5> -->
                                    <p class="mb-2">
                                        <b><?php echo $values['Place'];?>:</b>
                                       <?php echo $values['Details'];?>
                                    </p>
                                 </div>
                             
                           </div>
                           
                           <div class="col-md-11 mt4">
                               <div class="row">
                           <?php } ?> 
                            <?php foreach($trailer as $val) {?>
                            <div class="col-xl-6 col-md-12 stretch-card grid-margin mb3">
                              <div class="embed-responsive embed-responsive-16by9">
                                  <!--<a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" target="_blank"><img  src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" style="height: 300px;"><button class="btn"><span><img src="<?php echo base_url();?>img/play.png" alt="thumb" width="80" height="80" style="width:80px;"/></span></button></a> -->
                                  
                                  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"  allowfullscreen ></iframe>

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
                            <!--<a onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>&title=<?php echo $title;?>');"  href="javascript: void(0)">SHAREEEEEEE</a>-->
                            
                        </div>
                        <!--.row-->
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="row">
                         
                       <?php foreach($add_detail as $val){?>
                       
                       <div class="bk-shw" style="margin-bottom: 1em;"> 
							 <?= empty($val['Link'])? "" : "<a href=\"{$val['Link']}\" target=\"_blank\">" ?>
                          <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid">
							 <?= empty($val['Link'])? "" : "</a>" ?>
                       </div>
                       <?php } ?>
                    </div>
                    <!--<div class="row">-->
                    <!--   <div class="wk-trnd"></div>-->
                    <!--   <?php foreach($side_add as $val){?>-->
                    <!--   <div class="bk-shw"> -->
                    <!--      <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid" style="height: 250px">-->
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

                
             
             
            
      <?php include 'footer.php';?>
      <?php include 'bottom-js.php';?>
      




      
   </body>
</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="http://cinemanewsagency.com/js/share.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">