 /*
  * Author: Utpal Paul(Inkoniq IT Solutions Pvt.Ltd.)
  * Date Created: 27th January, 2014
  * Package: Stereo Tribes 0.1
  * Document: Stereo Tribes Script File
  */

 $(window).load(function() {
     $('.navbar').css('display', 'block');
     $('#bgvid').css('display', 'block');
     $('.freewall .brick').css('visibility', 'visible');
     $('.brick .mask').css('display', 'block');
 });

 $(document).ready(function() {

  $('#sec-navigation li a').click(function() {
    // fetch the class of the clicked item
    var ourClass = $(this).attr('class');
    
    // reset the active class on all the buttons
    $('#sec-navigation li').removeClass('active');
    // update the active state on our clicked button
    $(this).parent().addClass('active');
    
    if(ourClass == 'all') {
      // show all our items
      $('#freewall').children('div.brick').show();  
    }
    else {
      // hide all elements that don't share ourClass
      $('#freewall').children('div:not(.' + ourClass + ')').hide();
      // show all elements that do share ourClass
      $('#freewall').children('div.' + ourClass).show();
    }
    return false;
  });

     /* 
      *
      * Function for video section height
      *
      */

     var windowHeight = $(window).height();

     $('body.home').css('padding-top', windowHeight - 80);

     $('#bgvid').css('height', windowHeight - 80);

     $('.menuanimate').css('height', windowHeight + 35);

     $(window).resize(function() {
         var windowHeight = $(window).height();
         $('body.home').css('padding-top', windowHeight - 80);
         $('#bgvid').css('height', windowHeight - 80);
         $('.menuanimate').css('height', windowHeight + 35);
     });


     /*
      *
      * Function for video section height
      *
      */

     $('#secondary-nav').waypoint('sticky', {
         offset: 50
     });

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

 });