/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var isUndefined = function(v) {
    return (typeof v === 'undefined') ? true : false;
};




var LoveProject = window.LoveProject || {};

LoveProject = {
    
    init : function() {
        this.bindEvents();
    },
    likeOrUnlikeProject: function(el) {
        console.log("Here");
        var id = $(el).attr('data-id');
        if (!id)
            return;

        var action = ($(el).hasClass('liked')) ? 'unlike' : 'liked';
        $.ajax({
            url: "/fundraise/likeOrUnlikeProject",
            method: "POST",
            dataType: "json",
            data: {
                projectId: id,
                action: action
            }
        }).done(function(result) {
            if (result.error === 0) {
                if(result.data=='guest'){
                    //popup the  login modal
                    alert('please login to like this project');
                }else{
                        (result.data === 'liked') ? $(el).addClass('liked') : $(el).removeClass('liked');                    
                }
                
            }
        }).fail(function(jqXHR, textStatus) {
            console.log(textStatus, " : ", jqXHR);
        });

    },
    
    bindEvents : function() {
        $('.likeMe').on('click', function() {
            self.likeOrUnlikeProject(this);
        });
    }
};

$(document).ready(function(){
    LoveProject.init();
});


