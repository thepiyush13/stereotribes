/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    //call init function and process ajax data to grid
    
    pathArray = window.location.href.split( '/' );
protocol = pathArray[0];
host = pathArray[2];
var url =  'http://' + host;
//     url = 'http://localhost/stereotribes/base/get';
    url = url+'/search/get';
    var type = $('#type').val();
    var keyword = $('#keyword').val();
    var qstring  = '?page=0&type='+type+'&keyword='+keyword;
    $.get( url+qstring, function( data ) {  $( "#main_grid_content" ).append( data ).fadeIn('slow'); init(); $('.freewall .brick').css('visibility', 'visible');$('.brick .mask').css('display', 'block');});
data = '';

 $('#load_more_blocks').click(function(){
        var page_no = $('#page_number').val();
         var type = $('#type').val();
    var keyword = $('#keyword').val();
    var qstring  = '?page='+page_no+'&type='+type+'&keyword='+keyword;
        $.get( url+qstring, function( data ) {  $( "#main_grid_content" ).append( data ).fadeIn('slow'); init(); $('.freewall .brick').css('visibility', 'visible');$('.brick .mask').css('display', 'block'); });
        data = '';
        page_no = parseInt(page_no)+1;
        var page_no = $('#page_number').attr('value',page_no);
       
    }) 

    
})

//init();
function init(){
    //init for grid layout 
//    alert('success');
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
     }); wall.fitWidth();
    
    
    //init for grid color and other changes
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
}

function hexToRgb(hex) {
         var bigint = parseInt(hex, 16);
         var r = (bigint >> 16) & 255;
         var g = (bigint >> 8) & 255;
         var b = bigint & 255;
         var o = 0.6;

         return r + "," + g + "," + b + "," + o;
     };

    
