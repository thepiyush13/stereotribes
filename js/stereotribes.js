 /*
  * Author: Utpal Paul(Inkoniq IT Solutions Pvt.Ltd.)
  * Date Created: 27th January, 2014
  * Package: Stereo Tribes 0.1
  * Document: Stereo Tribes Script File
  */



 $(window).load(function() {
     $('#bgvid').css('display', 'block');
 });

 $(document).ready(function() {
      $('.navbar').css('display', 'block');
      
      $('.freewall .brick').css('visibility', 'visible');
      $('.brick .mask').css('display', 'block');

      $window = $(window);
                
      $('section[data-type="background"]').each(function(){
        var $bgobj = $(this); // assigning the object
                      
          $(window).scroll(function() {
                      
              // Scroll the background at var speed
              // the yPos is a negative value because we're scrolling it UP!                
              var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
              
              // Put together our final background position
              var coords = 'center '+ yPos + 'px';

              // Move the background
              $bgobj.css({ backgroundPosition: coords });
      
          }); // window scroll Ends

      });

      $('footer[data-type="background"]').each(function(){
        var $bgobj = $(this); // assigning the object
                      
          $(window).scroll(function() {
                      
              // Scroll the background at var speed
              // the yPos is a negative value because we're scrolling it UP!                
              var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
              
              // Put together our final background position
              var coords = 'center '+ yPos + 'px';

              // Move the background
              $bgobj.css({ backgroundPosition: coords });
      
          }); // window scroll Ends

      });

      /* 
       * Create HTML5 elements for IE's sake
       */

      document.createElement("article");
      document.createElement("section");
     /* 
      *
      * Function for video section height
      *
      */

     var windowHeight = $(window).height();

     $('body.home').css('padding-top', windowHeight);

     $('#bgvid').css('min-height', windowHeight);

     $(window).resize(function() {
         var windowHeight = $(window).height();
         $('body.home').css('padding-top', windowHeight);
         $('#bgvid').css('min-height', windowHeight);
     });


     /*
      *
      * Function for video section height
      *
      */

     $('#secondary-nav').waypoint('sticky', {
         offset: 50
     });


     /*
      *
      * Function for Animated blocks
      *
      */

     var wall = new freewall('.freewall');
     wall.reset({
         selector: '.brick',
         animate: true,
         gutterX: 2,
         gutterY: 2,
         cellW: 265,
         cellH: 265,
         fixSize: 0,
         onResize: function() {
             wall.fitWidth();
         }
     });

     $('body').on('click', '#sec-navigation li', function() {
         $("#sec-navigation li").removeClass("active");
         var filter = $(this).addClass('active').data('filter');
         if (filter) {
             wall.filter(filter);
         } else {
             wall.unFilter();
         }
     });

     wall.fitWidth();

     function hexToRgb(hex) {
         var bigint = parseInt(hex, 16);
         var r = (bigint >> 16) & 255;
         var g = (bigint >> 8) & 255;
         var b = bigint & 255;
         var o = 0.6;

         return r + "," + g + "," + b + "," + o;
     };

     $('div.brick').each(function() {
         var dataColor = $(this).data('color').replace('#', '');
         $(this).find('.fund-featured-count-block').css('background-color', 'rgba(' + hexToRgb(dataColor) + ')');
         $(this).find('.fund-normal-count-block').css('background-color', 'rgba(' + hexToRgb(dataColor) + ')');
         $(this).find('.fund-notation').css('width', $(this).data('percent'));
         $(this).find('.fund-notation').css('background-color', $(this).data('color'));
         $(this).find('.icon-location').css('color', $(this).data('color'));
         $(this).find('.maskheaderwrap').css('background-color', $(this).data('color'));
         $(this).find('.bordercut').css('border-left-color', $(this).data('color'));
     });

  	// click event for touch devices
    var width = $(window).width();
    if (width < 1025){

      $('.brickhover').on('click',function(){
        $(this).toggleClass('brickclick');
      });

    };

    // Prevent search dropdown from closing
    $('.menu-search').click(function(e) {
        e.stopPropagation();
    });

    $('.menuplay-categories').click(function(e) {
        e.stopPropagation();
    });
    
    $('.join-icons > a > i').click(function(e) {
        e.stopPropagation();
    });


 });

 
