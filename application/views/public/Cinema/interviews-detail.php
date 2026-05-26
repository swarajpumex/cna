
<!DOCTYPE html>
<html lang="en">
   <head>

      <?php include 'top-css.php';?>
      <title> <?php echo $interview['Title'];?> </title>
       <meta name="description" content="<?php echo $interview['Details'];?>">
       <meta property="og:title" content="<?php echo $interview['Title'];?>" />
       <meta property="og:image" content="<?php echo base_url();?>uploads/interview/<?php echo $interview['Image']; ?>" >
       <meta property="og:image:width" content="850" />
       <meta property="og:image:height" content="500" />
     
       
      
    <!--<style type="text/css">
      .fa {
  padding: 15px;
  font-size: 35px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-google {
  background: #dd4b39;
  color: white;
}

.fa-whatsapp {
  background: #4FCE5D;
  color: white;
}
---->

    </style>
   </head>
   
 
   <body>
       
     
       
     <!---  <script type='text/javascript' src='https://platform-

api.sharethis.com/js/sharethis.js#property=5f86877c6e114d00114c29e4&product

=sticky-share-buttons' async='async'></script>---->





       
      <?php include 'header.php';?>
      <section class="main-sctn pt0">
         <div class="container">
            <div class="row ">

               <div class="col-md-9 pr0">
                  <div class="blog">
                        <!--  <div class="col-md-12">
                           -->

                        <div class="row">
                           
                           <div class="col-md-11">
                            
                              <div class="banner-content ">
                                    <h3><?php echo $interview['Title'];?></h3>
                                    
                                 </div>
                                 
                                
                                  
                                 
                                 <div class="bnrpic">
                                 

                                 <img src="<?php echo base_url();?>uploads/interview/<?php echo $interview['Image'];?>" alt="banner" class="img-fluid">
                                 </div>
                                 
                                 <div class="banner-content">
                                     <!-- <p><b><?php echo $values['By_Line'];?></b></p> -->
                                    <!-- <h5 class="mb-0" ><?php echo $values['FilmName'];?></h5> -->
                                    <p class="mb-2">
                                       <!--  <b><?php echo $values['Place'];?>:</b> -->
                                       <?php echo $interview['Details'];?>
                                    </p>
                                 </div>
                                 
                                  
                             
                           </div>
                           
                           <div class="col-xl-11 col-md-11 stretch-card grid-margin">
                              <div class="embed-responsive embed-responsive-16by9 mt3">
                                  <!--<a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" target="_blank"><img  src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" style="height: 300px;"><button class="btn"><span><img src="<?php echo base_url();?>img/play.png" alt="thumb" width="80" height="80" style="width:80px;"/></span></button></a> -->
                                  
                                  <?php if($interview['Link']){ ?>
                                  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($interview['Link'],17);?>"
                    allowfullscreen></iframe>
                                        <?php } else{?> <iframe class="embed-responsive-item" style="height:0;"></iframe><?php } ?>
                                        
                              </div>
                           </div>
                           
                            
                           
                           
                           
                           
                           
                           
                           
                        </div>
                        
                        
                        
                        
                        <!--.row-->

                 
                 
                  <!-- </div> -->
               </div></div>

                <div class="col-md-3 mt-4">

                        <div class="row">
                          
                           <?php foreach($add as $val){?>
                            
                           <div class="bk-shw" style="margin-bottom: 1em;"> 
                              <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid" style="height: 250px">
                           </div>
                           <?php } ?>
                        </div>
                        
                     </div>
             </div></div>
             
      </section>
      
     
     <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f8e748777d449bf"></script>
     
     
      <?php include 'footer.php';?>
      <?php include 'bottom-js.php';?>
   </body>
</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
  $('.btnShare').click(function(){
elem = $(this);
postToFeed(elem.data('title'), elem.data('desc'), elem.prop('href'), elem.data('image'));

return false;
});

window.fbAsyncInit = function(){
FB.init({
    appId: 'xxxxx', status: true, cookie: true, xfbml: true }); 
};
(function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if(d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; 
    js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
    ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));
function postToFeed(title, desc, url, image){
var obj = {method: 'feed',link: url, picture: 'https://www.codeproject.com/images/'+image,name: title,description: desc};
function callback(response){}
FB.ui(obj, callback);
}
$(document).ready(function() {
  

 
 
var isMobile = {
Android: function() {
return navigator.userAgent.match(/Android/i);
},
BlackBerry: function() {
return navigator.userAgent.match(/BlackBerry/i);
},
iOS: function() {
return navigator.userAgent.match(/iPhone|iPad|iPod/i);
},
Opera: function() {
return navigator.userAgent.match(/Opera Mini/i);
},
Windows: function() {
return navigator.userAgent.match(/IEMobile/i);
},
any: function() {
return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
}
};
$(document).on("click", '.whatsapp', function() {
if( isMobile.any() ) {
var text = $(this).attr("data-text");
var url = $(this).attr("data-link");
var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
var whatsapp_url = "whatsapp://send?text=" + message;
window.location.href = whatsapp_url;
} else {
alert("Please share this article in mobile device");
}
});
});
</script>