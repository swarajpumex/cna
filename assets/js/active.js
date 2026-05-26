(function ($) {
	"use strict";

  jQuery(document).ready(function($){
    // Remove class in function
    $('ul.nav.navbar-nav li a').on('click', function(){
      $('.navbar-collapse').removeClass('in');
    });

    $(".dropdown_menu").parent("li").children("a").append(' <i class="fa fa-angle-down"></i>');
    // Stiky Navigation
    $(".stickyNav").sticky({ 
       topSpacing: 0,
       zIndex: 11
     });
    // Smoot Scroll Effect
    $('li.smooth-scroll a') .bind('click', function(event){
      var $anchor = $(this);
      var headerHeight = '60';
      $('html, body').stop().animate({
        scrollTop : $($anchor.attr('href')) .offset().top - headerHeight + "px"
      }, 1200, 'easeInOutExpo');
      event.preventDefault();
    });
    // Scrollspy
    $('body').scrollspy({
      target : '.navigation-area',
      offset : 62
    });
    //Scroll To top Function apply
    $(window).scroll(function(){
      var ScrollToTop = jQuery(window).scrollTop();
        //ScrollToTop Function
        if( ScrollToTop > 500){
          jQuery(".ScrollToTop").fadeIn();
        }
        else{
          $(".ScrollToTop").fadeOut();
        }
      });
      //Scroll To top With animate
      $(".ScrollToTop").on('click', function(){
        $("body, html").animate({'scrollTop' : 0}, 1500, 'easeInOutExpo');
        return false
      });

      // Pogo slider script
      var mySlider = $('#home_slider').pogoSlider({
       pauseOnHover: false,
       autoplay : true,
       autoplayTimeout : 7000
     }).data('plugin_pogoSlider');

      // Adding hover style for the feature box
      var serviceBox = $(".service_col", "#service");

      serviceBox.on("mouseover",function(){
        serviceBox.removeClass("active");
        $(this).addClass("active");
        return false
      });
      //Brand Logo Slider
      $(".brand_logo_slider").owlCarousel({
        items: 4,
        loop: true,
        nav: false,
        navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                ],
        autoplay: true,
        autoplayTimeout: 5000,
        margin: 25,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items: 1
            },
            // breakpoint from 480 up
            480 : {
                items: 2
            },
            // breakpoint from 768 up
            768 : {
                items: 4
            }
        },
      });
      //Brand Logo Slider
      $(".brand_logo_slider_2").owlCarousel({
        items: 5,
        loop: true,
        nav: true,
        navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                ],
        autoplay: true,
        autoplayTimeout: 5000,
        margin: 25,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items: 1
            },
            // breakpoint from 480 up
            480 : {
                items: 2
            },
            // breakpoint from 768 up
            768 : {
                items: 5
            }
        },
      });

      // Mixitup
      $(function(){
        $('#Mixitup').mixItUp();
      });
      // Magni Fic Popup
      $('.portfolio_popup').magnificPopup({
        type: 'image',
        gallery:{
          enabled:true
        }
      });
      //Testimonial
      $(".testimonial_wraper").owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                ],
        autoplay: true,
        autoplayTimeout: 5000,
        animateOut: 'fadeOut'
      });
      
      // For Progress Bar
      function RXknob(RXknobClass) {
        RXknobClass = $(RXknobClass);
        RXknobClass.each(function () {
          var $this = $(this),
          knobVal = $this.attr('data-rel'),
          knobAnimate = function () {
            $({
              value: 0
            }).animate({
              value: knobVal
            }, {
              duration : 2000,
              easing   : 'swing',
              progress : function () {
                $this.val(Math.ceil(this.value)).trigger('change');
              }
            });
          };
          $this.knob({
            'draw' : function () {
              $(this.i).val(this.cv + '%').css('font-size', '70px').css('color', '#eeeeee').css('width', '100%').css('margin-left', '-245px');
            }
          });
          $this.waypoint(knobAnimate, { offset: 'bottom-in-view' });
        });
      }
      RXknob('.skill');

      // WOW JS
      new WOW().init();

       //Default Theme
        $("span.color_default").on('click', function(){
            $("body").removeAttr("class");
        });
        //Peter River Color Theme
        $("span.color_peterRiver").on('click', function(){
            $("body").addClass("color_peterRiver_theme").removeClass("color_emerald_theme color_alizarin_theme color_amethyst_theme color_turquoise_theme");
        });
        //Emerald Color Theme
        $("span.color_emerald").on('click', function(){
            $("body").addClass("color_emerald_theme").removeClass("color_peterRiver_theme color_alizarin_theme color_amethyst_theme color_turquoise_theme");
        });
         //Alizarin Color Theme
        $("span.color_alizarin").on('click', function(){
            $("body").addClass("color_alizarin_theme").removeClass("color_peterRiver_theme color_emerald_theme color_amethyst_theme color_turquoise_theme");
        });
         //Amethyst Color Theme
        $("span.color_amethyst").on('click', function(){
            $("body").addClass("color_amethyst_theme").removeClass("color_peterRiver_theme color_emerald_theme color_turquoise_theme color_alizarin_theme");
        });
         //Amethyst Color Theme
        $("span.color_turquoise").on('click', function(){
            $("body").addClass("color_turquoise_theme").removeClass("color_peterRiver_theme color_emerald_theme color_amethyst_theme color_alizarin_theme");
        });

        $(".panel_button").on('click',  function(event){
            event.preventDefault();
            if ( $(this).hasClass(".button_inOut") ) {
                $(".color_panel_box").stop().animate({left:"-150px"}, 500);
            } else {
                $(".color_panel_box").stop().animate({left:"0px"}, 500);
            }
            $(this).toggleClass(".button_inOut");
            return false;
        });
    });

    jQuery(window).load(function(){
        jQuery(".Preloder").fadeOut(500);
    });


}(jQuery));


