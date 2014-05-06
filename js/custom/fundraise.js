/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var Fundraise = window.Fundraise || {};

Fundraise = {
    init: function() {
        this.bindEvents();
    },
    
    
    contributeStep1: function() {
        var self = this;
        if (!this.validateStep1()) {
            return;
        }

        var block = $('div.fund-block-inner.active-fund');
        $.ajax({
            url: "/fundraise/SaveUserFund",
            method: "POST",
            dataType: "json",
            data: {
                projectId: $('#projectId').val(),
                rewardId: $(block).find('.rewardId').val(),
                amount: $(block).find('.rewardAmount').val(),
                shippingAddress: self.getShippingAddress(),
                newsLetter: $('#newsLetter').is(':checked')
            }
        }).done(function(result) {
            if (result.error === 0) {
                window.location.href = "/paypal/buy?order_id=" + result.data.id ;
            } else {
                console.log("ERROR >>", result);
            }
        }).fail(function(jqXHR, textStatus) {
            console.log(textStatus, " : ", jqXHR);
        });
    },
    /**
     * Return shipping address
     * @returns {Array}
     */
    getShippingAddress: function() {
        var fields = ['firstname', 'lastname', 'addressline1', 'addressline2', 'country', 'city', 'postalcode'];
        var address = [];

        $.each(fields, function(index, field) {
            var v = $('#' + field).val();
            if (!isUndefined(v) && v.trim() != "") {
                address.push(v);
            }
        });

        return address;
    },
    
    validateStep1: function() {
        $.validity.start();
        
        $('#firstname').require();
        $('#lastname').require();
        $('#addressline1').require("Address is required");
        $('#country').require();
        $('#city').require();
        $('#postalcode').require();
        $('#email').require().match('email');
        
        var result = $.validity.end();
        console.log("valid :",result);
        return result.valid;
    },
    
    selectReward : function(el) {
        if($(el).find('.fund-complete-block').length === 0) {
            $('.fund-block-inner').each(function(){
               $(this).removeClass('active-fund').addClass('color-dark');
            });
            $(el).removeClass('color-dark').addClass('active-fund');
            $('#fundContribution').html($(el).find('.rewardAmount').val());
            $('#selectedRewardName').html($(el).find('.reward-type').html());
            $('#rewardId').val($(el).find('.rewardId').val());
        }
    },
    
    bindEvents: function() {
        var self = this;
        $('#contribute-step1').on('click', function() {
            self.contributeStep1();
        });
        
        $('.fund-block-inner').on('click',function(){
            self.selectReward(this);
        });
        
        //Enable first fund block as default
        $("div.fund-block-inner:first-child" ).click();
    }


};

$(document).ready(function() {
    Fundraise.init();
});
