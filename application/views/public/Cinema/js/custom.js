/*
Template Name: Benaam - Modren Blog Template
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle

====================================
[  TABLE CONTENT ]
------------------------------------
    
	
	1.0 - Pre Loader
	2.0 - Main Slider
	3.0 - Feature Slider
	4.0 - Video Carousel
	5.0 - Gellary Carousel
	6.0 - Blog Carousel
	7.0 - Breaking News
		
	
	
-------------------------------------
[ END TABLE CONTENT ]
=====================================
*/


(function($) {
        "use strict";

/*============================================
Pre Loader
==============================================*/	
	
	window.onload = function() {
		document.getElementById('spinner').style.display = 'none';
	};
			
/*============================================
Main Slider
==============================================*/		

$('.slider').owlCarousel({
    loop:true,
    margin:0,
    autoplay:true,
    autoplayTimeout:9000,
    nav:true,
    items:1,
    dots:false,
   navText:[ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

/*============================================
Feature Slider
==============================================*/

  $("#feature-slider").owlCarousel({
    navigation : false,
    pagination: false,
    slideSpeed : 4000,
    stopOnHover: true,
	dots: false,
    autoplay:true,
	loop: true,
    autoplayTimeout:4000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
  });
  
  /*============================================
Video Carousel
==============================================*/

$('.carousel-video').flickity({
  asNavFor: '.carousel-main',
  contain: true,
  pageDots: false,
  wrapAround:true,
  freeScroll:true
});

/*============================================
Gellary carousel
==============================================*/

$('.carousel-gellary').flickity({
  contain: true,
  pageDots: false,
  wrapAround:true,
  autoPlay: 4000,
});

/*============================================
Blog carousel
==============================================*/

$('.carousel-blog').flickity({
  pageDots: false,
  wrapAround:true,
  imagesLoaded: true,
  freeScroll: true,
  autoPlay: 5000,
});

/*============================================
Breaking News
==============================================*/

$(window).load(function(e) {
$("#bn1").breakingNews({
	effect		:"slide-h",
	autoplay	:true,
	timer		:5000
});});

})(jQuery);