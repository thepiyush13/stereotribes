/* 
 @package MyJs
 * @author Piyush Tripathi
 * @copyright Piyush Tripathi 2013
 * @version 1.0
 * @access private
 * @requires Jquery,Jquery Form Field plugin,jquery form plugin
 */

base_url = 'http://'+$(location).attr('host')+$(location).attr('pathname');
$(document).ready(function() {
//    
//     $('#addons').bind("DOMSubtreeModified", function(){
//$('#addons input[name^="upsales"]').attr('name', 'addons[]');
//             $('#addons input[name^="items"]').attr('name', 'addons[]');
//         });
//    
//    $('#upsales').bind("DOMSubtreeModified", function(){
//$('#upsales input[name^="addon"]').attr('name', 'upsales[]');
//             $('#upsales input[name^="items"]').attr('name', 'upsales[]');
//         });
//    
//    $('#items').bind("DOMSubtreeModified", function(){
//             $('#items input[name^="upsales"]').attr('name', 'items[]');
//         $('#items input[name^="addons"]').attr('name', 'items[]');
//         });
         
         
         
         // for update and delete operations
        
      
      
    
    
    
    
     $('.submit_button').click(function(){
        var form  = $(this).closest('form');
        var url  = form.attr('action');
        var addons = get_html_attributes('#myModal-edit #addons li');
        var upsales = get_html_attributes('#myModal-edit #upsales li');
        
        $('.addons_data').val(addons.join(','));
        $('.upsales_data').val(upsales.join(','));
        
        form.submit();
        
    }) 
    
    $('#btn_create_package').click(function(){
        var package_data  = $('#form_create_package').serialize(); 
        var form  = $('#form_create_package');
        var url  = form.attr('action');
        var addons = get_html_attributes('#addons li');
        var upsales = get_html_attributes('#upsales li');
        var callback = 'result_package_create';
        var data = {
            'package_data':package_data,
            'addons':addons,
            'upsales':upsales
        };
        
       ajax_call(form,url,data,callback);
        
    }) ;
    
    $('#btn_update_package').click(function(){
        var package_data  = $('#form_update_package').serialize(); 
        var form  = $('#form_update_package');
        var url  = form.attr('action');
        var addons = get_html_attributes('#addons li');
        var upsales = get_html_attributes('#upsales li');
        var callback = 'result_package_update';
        var data = {
            'package_data':package_data,
            'addons':addons,
            'upsales':upsales,
            'package_id':$('#package_id').val()
        };
        
       ajax_call(form,url,data,callback);
        
    }) ;
    
    //delete_package_name 
    
    $('.btn_delete_package').click(function(){
        
        var id = $(this).parents('.col-sm-3').find('.package_id').val();
        $('#delete_package_name').text($(this).parents('.col-sm-3').find('.pricing-img h2').text() );
        $('#delete_package_id').val(id); 
        
        
        
    }) ;
    
     $('.btn_delete_addon').click(function(){
        
        var id = $(this).attr('value');
        $('#delete_addon_name').text($(this).parents('tr').children('td').eq(1).text() );
        $('#delete_addon_id').val(id); 
        
        
        
    }) ;
    make_drag_drop();
    
});


function make_drag_drop(){
    
//        $('.sortable').sortable();
//                $('.handles').sortable({
//        handle: 'span'
//        });
                $('.list2').sortable({
        connectWith: '.list2'
        });
//                $('.exclude').sortable({
//        items: ':not(.disabled)'
//        });
//        
}

       



//FUNCTION LIST FOR SPECIFIC COMPONENTS

function set_package_details(package_id){
    if(!package_id){
        return false;
    }
    //get package data 
    var url = 'index.php?r=/packages/getdetails';
    var data = {'package_id':package_id};
    var callback = 'result_package_set';
     ajax_call('body',url,data,callback);
   
    
}

function result_package_create(data){
    
    
    window.location.href= base_url+'/packages/';

}
function result_package_update(data){
    
    
    window.location.href= base_url+'/packages/';

}

function result_package_set(data){
    
    var form = $('#form_update_package');
    var package = data['package_details'];
    form.formHash({
        "Packages[name]": package[0]['name'],
        "Packages[desc]": package[0]['desc'],
        "Packages[usd]": package[0]['usd'],
        "Packages[inr]": package[0]['inr'],
        "Packages[status]": package[0]['status'],        
        "package_id": package[0]['id'],
    } );
    $('textarea').text(package[0]['desc']);
    var addons = create_list(data['package_addons'],'value','addon_id','addon_name');
    $('#addons').html(addons)
    
    var upsales = create_list(data['package_upsales'],'value','addon_id','addon_name');
    $('#upsales').html(upsales)
    
    var items = create_list(data['package_items'],'value','addon_id','addon_name');
    $('#list').html(items)
    
    $('#form_update_package li').attr('draggable','true');
    make_drag_drop();
}

function load_items(type){
    if(type =='create'){
        var form  = $('#form_create_package');
        var callback = 'result_load_items';
        var url  = base_url+'/packages/getdetails';        
        var data  = {'package_id':-1}; 
        
    }else if(type =='update'){
        var form  = $('#form_update_package');
        var callback = 'result_load_items';
        var url  = base_url+'/packages/getdetails';        
        var data  = {'package_id':$('#package_id').val()};        
    }
     ajax_call(form,url,data,callback);
}

//for addons creation and updation 

function set_addon_details(addon_id){
    if(!addon_id){
        return false;
    }
    //get addon data 
    var url = base_url+'/addons/getdetails';
    var data = {'addon_id':addon_id};
    var callback = 'result_addon_set';
     ajax_call('body',url,data,callback);
   
    
}

function result_addon_create(data){
    
    
    window.location.href= base_url+'/addons/';

}
function result_addon_update(data){
    
    
    location.reload();

}

function result_addon_set(data){
    
    var form = $('#form_update_addon');
    var addon = data['addon_details'];
    form.formHash({
        "Addons[name]": addon[0]['name'],
        "Addons[type]": addon[0]['type'],
        "Addons[usd]": addon[0]['usd'],
        "Addons[inr]": addon[0]['inr'],
        "Addons[status]": addon[0]['status'],        
        "addon_id": addon[0]['id'],
        
    } );
    $('textarea').text(addon[0]['desc']);
    if(addon[0]['type']=='group'){
        var htm_sub = create_subaddon_list(data['subaddon_details']);
    $('#subaddon_list').html(htm_sub);
    $('input[value="group"]').click()
    }
    
//    var addons = create_list(data['addon_addons'],'value','addon_id','addon_name');
//    $('#addons').html(addons)
    
   
}
function create_subaddon_list(data){
    if(!data){
        return false;
    }
    
    var htm_sub='';
    $.each(data, function(key, value) {
        htm_sub+=' <div class="item-list"> \n\
            <div class="grp-item"> <input type="hidden" value="'+value['id']+'" class="subaddon_id" name="Subaddon['+key+'][id]" /> \n\
                <label>Name : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" value="'+value['name']+'" placeholder="Addon name" name="Subaddon['+key+'][name]"> \n\
            </div> \n\
            <div class="grp-item"> \n\
                <label>Price (INR) : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" value="'+value['inr']+'" placeholder="Rs xxx" name="Subaddon['+key+'][inr]"> \n\
            </div> \n\
            <div class="grp-item"> \n\
                <label>Price (USD) : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" value="'+value['usd']+'" placeholder="$ xxx" name="Subaddon['+key+'][usd]"> \n\
            </div> \n\
            <span class="btn-dynm remove"><i class="icon-minus"></i></span> \n\
        </div>';
       
    });
    
    return htm_sub;
}
//function load_items(type){
//    if(type =='create'){
//        var form  = $('#form_create_addon');
//        var callback = 'result_load_items';
//        var url  = '/admin/addons/getdetails';        
//        var data  = {'addon_id':-1}; 
//        
//    }else if(type =='update'){
//        var form  = $('#form_update_addon');
//        var callback = 'result_load_items';
//        var url  = '/admin/addons/getdetails';        
//        var data  = {'addon_id':$('#addon_id').val()};        
//    }
//     ajax_call(form,url,data,callback);
//}

//end addons
    
    function result_load_items(data){
        var htm = '';
   
        if(data['package_upsales']){
            htm = create_list(data['package_upsales'], 'value', 'addon_id', 'addon_name');
            $('#upsales').html(htm);
        }
        
        if(data['package_addons']){
            htm = create_list(data['package_addons'], 'value', 'addon_id', 'addon_name');
            $('#addons').html(htm);
        }
        
        if(data['package_items']){
            htm = create_list(data['package_items'], 'value', 'addon_id', 'addon_name');            
            $('#list').html(htm);
        }
        
        $('#addons li,#list li,#upsales li').attr('draggable','true');
         make_drag_drop();
         
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

//FUNCTION LIST FOR REUSE

 //find out values of html elements and return comman seperate values in a array
  function get_html_attributes(selector,attribute){
      if(!attribute){
          return $(selector).map(function() {return $(this).val();}).get()
      }else{
           return $(selector).map(function() {return $(this).attr(attribute) ;}).get()
      }
      
  }
//creates a html list from given options 
function create_list(data, htm_attrib, htm_val, text) {
    if (!htm_attrib) {
        htm_attrib = null;
    }
    if (!htm_val) {
        htm_val = null;
    }
    if(!data || !text){
        return false;
    }


    var obj = data;
    var htm = '';
    $.each(obj, function(key, value) {
        htm += '<li ' + htm_attrib + '="' + value[htm_val] + '" > ' + value[text] + '</li>';

    });
    return htm;
}        
        
function ajax_call(source,url,data,callback){
    
    var crnturl = url;
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: data,
        timeout: 3000,
        beforeSend: function() {
           
        $('<div class="ajax_loader">Loading........... </div>').appendTo(source);
        },
        complete: function() {
            $('.ajax_loader').remove();
          
        },          
        cache: false,
        success: function(result) {
             $('.ajax_loader').remove();
                console.log(result);                
                var fn = window[callback];
                fn(result);
           
        },
        error: function(error) {
             $('.ajax_loader').remove();
          
        //alert("Some problems have occured. Please try again later: " );
            console.log(error.responseText);
        }
    });


}


function get_url_parameter(paramName) {
    var searchString = window.location.search.substring(1),
    i, val, params = searchString.split("&");

    for (i=0;i<params.length;i++) {
        val = params[i].split("=");
        if (val[0] == paramName) {
            return unescape(val[1]);
        }
    }
    return null;
}




 

        
        
        $(document).ready(function(){
            subItems();
            countItem();
             $("#single-item,#group-item").click(function(){
           
            subItems();
           
        });
        
        $(document.body).on('click','.remove', function(){
            $(this).parent().remove();
            countItem();
         });
        $(".add").on('click', function(){
          $('.remove').fadeIn('slow');
            htm=' <div class="item-list"> \n\
            <div class="grp-item">  \n\
                <label>Name : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" id="" placeholder="Addon name" name="Subaddon[name]"> \n\
            </div> \n\
            <div class="grp-item"> \n\
                <label>Price (INR) : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control"  placeholder="Rs xxx" name="Subaddon[inr]"> \n\
            </div> \n\
            <div class="grp-item"> \n\
                <label>Price (USD) : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" id="xxx" placeholder="$ xxx" name="Subaddon[usd]"> \n\
            </div> \n\
            <span class="btn-dynm remove"><i class="icon-minus"></i></span> \n\
        </div>';
            $(htm).appendTo('.group-item');
        });
        
         $(".addSub").on('click', function(){
          $('.remove').fadeIn('slow');
          var count = $('.subaddon_id').length ;
          var key = count;
            htm=' <div class="item-list"> \n\
            <div class="grp-item"> <input type="hidden" value="" class="subaddon_id" name="Subaddon['+key+'][id]" /> \n\
                <label>Name : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" value="" placeholder="Addon name" name="Subaddon['+key+'][name]"> \n\
            </div> \n\
            <div class="grp-item"> \n\
                <label>Price (INR) : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" value="" placeholder="Rs xxx" name="Subaddon['+key+'][inr]"> \n\
            </div> \n\
            <div class="grp-item"> \n\
                <label>Price (USD) : <span class="required">*</span></label> \n\
                <input type="text"  class="form-control" value="" placeholder="$ xxx" name="Subaddon['+key+'][usd]"> \n\
            </div> \n\
            <span class="btn-dynm remove"><i class="icon-minus"></i></span> \n\
        </div>';
            $(htm).appendTo('.group-item');
        });
        
         });

       
        

        function subItems(){
                var item = $('input[name="Addons[type]"]:checked').val();
                if(item=="single"){
                   $(".group-item").fadeOut();
                    $(".single-item").fadeIn();
                }else{
                     $(".single-item").fadeOut('fast');
                     $(".group-item").fadeIn('slow');
                     // alert("clicked");
                }
         }

         function countItem(){
            var count =$('.item-list').length;
            if(count <=2){
               // alert(count);
                $('.remove').fadeOut('fast');
            }else{
                 $('.remove').fadeIn('slow');
            }
         }
