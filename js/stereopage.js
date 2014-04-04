/*
  * Author: Utpal Paul(Inkoniq IT Solutions Pvt.Ltd.)
  * Date Created: 21th March, 2014
  * Package: Stereo Tribes 0.1
  * Document: Stereo Tribes Script File
  */

$(document).ready(function() {

    $('.brick .mask').css('display', 'block');

    // Row Collapse

    $('.article-head-collapse').click(function() {
        $(this).parent().find('.collapse-container').slideToggle();
        $(this).find('.collapse-sign').toggleClass('col-open');
    });

    // Character Count

    /*$(".charcount").keyup(function () {
	    var value  = $(this).val().length;
	    $(this).parent().find(".inputcount").text(value);
	    var text  = $(this).val();
	    $('#fundlive-title').text(text);
	});*/

    // Select box with autocomplete

    var countries = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        prefetch: {
            // url points to a json file that contains an array of country names, see
            // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
            url: 'json/countries.json',
            // the json file contains an array of strings, but the Bloodhound
            // suggestion engine expects JavaScript objects so this converts all of
            // those strings
            filter: function(list) {
                return $.map(list, function(country) {
                    return {
                        name: country
                    };                
                });
            }
        }
    });
	 
    // kicks off the loading/processing of `local` and `prefetch`
    countries.initialize();
	 
    // passing in `null` for the `options` arguments will result in the default
    // options being used
    $('#prefetch .stribescountry').typeahead(null, {
        name: 'countries',
        displayKey: 'name',
        // `ttAdapter` wraps the suggestion engine in an adapter that
        // is compatible with the typeahead jQuery plugin
        source: countries.ttAdapter()
    });

    // Select box with autocomplete

    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        prefetch: {
            // url points to a json file that contains an array of country names, see
            // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
            url: 'json/cities.json',
            // the json file contains an array of strings, but the Bloodhound
            // suggestion engine expects JavaScript objects so this converts all of
            // those strings
            filter: function(list) {
                return $.map(list, function(cities) {
                    return {
                        name: cities
                    };                
                });
            }
        }
    });
	 
    // kicks off the loading/processing of `local` and `prefetch`
    cities.initialize();
	 
    // passing in `null` for the `options` arguments will result in the default
    // options being used
    $('#prefetch .stribescity').typeahead(null, {
        name: 'cities',
        displayKey: 'name',
        // `ttAdapter` wraps the suggestion engine in an adapter that
        // is compatible with the typeahead jQuery plugin
        source: cities.ttAdapter()
    });
       
       
   

    $('.date-pick').datePicker().val(new Date().asString()).trigger('change');
    
    /** 
     * datepicker binding with angular Kanchan
     */   
    //    $.datePicker.setDefaults({
    //        // When a date is selected from the picker
    //        onSelect: function(newValue) {
    //            if (window.angular && angular.element)
    //                // Update the angular model
    //                angular.element(this).controller("ngModel").$setViewValue(newValue);
    //        }
    //    });
    
    /**
     * 
     */

    $('.pitchstorytextarea').jqte();
    
    
    /** 
     * Trigger flip image upload
     */
    $('#flipImageUploadForm').on('change', function() {
        $('#flipImageUploadForm').submit();
    });
    
    
    /** 
     * Trigger campaign image upload
     */
    $('#awesomeCampaignImage').on('change', function() {
        $('#awesomeImageUploadForm').submit();
    });

});