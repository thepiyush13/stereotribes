$(function() {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
});

$(document).ready(function() {
    $('input[name="newSourceInput"]').attr('disabled', true).hide();

    $('#feed-category').multiselect({
        buttonClass: 'btn',
        buttonWidth: 'auto',
        buttonText: function(options) {
            if (options.length == 0) {
                return 'None selected <b class="caret"></b>';
            }
            else if (options.length > 6) {
                return options.length + ' selected  <b class="caret"></b>';
            }
            else {
                var selected = '';
                options.each(function() {
                    selected += $(this).text() + ', ';
                });
                return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
            }
        },
        onChange: function(element, checked) {
            if (checked == true) {
                // action taken here if true
            }
            else if (checked == false) {
                if (confirm('Do you wish to deselect the element?')) {
                    // action taken here
                }
                else {
                    $("#feed-category").multiselect('select', element.val());
                    return false;
                }
            }
        }
    });



});


$('button[name="newSourceBtn"]').on('click', function() {
    $('select[name="feedUrl"]').attr('disabled', true).hide();
    $('input[name="newSourceInput"]').attr('disabled', false).show();
});


//$(function() {
//
//    // Tags Input
//    $(".tagsinput").tagsInput();
//
//    // Switch
//    $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch();
//
//});