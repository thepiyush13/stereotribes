//        var timePicker = {};
function pad(num, size) {
    var s = num + "";
    while (s.length < size)
        s = "0" + s;
    return s;
}


(function($) {

    var Tpr = function(element, options) {
        this.options = $.extend({}, Tpr.defaults, options)
        //this.options = options;
        this.$element = $(element);
        this.timeSlot = {};
    }

    Tpr.defaults = {
        format: 'HH::mm',
        'header': '',
        'interval': 10
    }

    Tpr.prototype.init = function(values) {
        for (var hr = 0; hr < 24; hr++) {
            var dummy = 0;
            for (m = 0; m < 60; m = m + this.options.interval) {
                var key = pad(hr, 2) + ":" + pad(m, 2);
                this.timeSlot[key] = false;
            }
            if (values) {
                for (var i = 0; i < values.length; i++) {
                    if (this.timeSlot.hasOwnProperty(values[i])) {
                        this.timeSlot[values[i]] = true;
                    }
                }
            }
        }
    }

    Tpr.prototype.show = function() {
        var items = [];
        var j = 1, timeGroup = [];
        for (var prop in this.timeSlot) {
            if (this.timeSlot.hasOwnProperty(prop)) {
                if (j == 60 / this.options.interval) {
                    j = 0;
                    timeGroup.push(prop);
                    var timeGroupElements = this.getTimeGroupElements(timeGroup);
                    items.push(timeGroupElements);
                    timeGroup = [];
                } else {
                    timeGroup.push(prop);
                }
                j++;

            }
        }
        var e = items.join('');
        e = '<div class="tprtags"></div><div class="timer-container hide">' + e + '</div>'
        $(this.$element).html($(e));


    };


    Tpr.prototype.getTimeGroupElements = function(groups) {
        var _subItems = '';
        var groupSelected = ''
        for (var i = 0; i < groups.length; i++) {
            var checked = false;
            if (this.timeSlot[groups[i]]) {
                checked = "checked"
                groupSelected = 'style="border-bottom: 2px solid #41cac0;"';
            }
            _subItems = _subItems + '<li><a>' + groups[i] + ' <input class="chk-interval" data-group-interval="' + groups[i] + '" type="checkbox" ' + checked + '></a></li>';
        }
        return '' +
        '<div class="tpr-group"><span class="tpr-default tpr-toggle" ' + groupSelected + ' data-btn-interval="' + groups[0] + '">' + groups[0] + '</span>' +
        '<ul class="xdropdown-menu">' +
        _subItems +
        '</ul></div>';
    }

    Tpr.prototype.initEvents = function() {
        var $that = this.$element;
        var _timeSlot = this.timeSlot;
        var _options = this.options;
        $('.tpr-toggle', this.$element).click(function() {
            $('.tpr-group').not($(this).parent()).removeClass('open');
            if ($(this).parent().hasClass('open')) { 
                $(this).parent().removeClass('open')

            } else {
                $(this).parent().addClass('open');
                positionTimer();
            }
            positionTimer();
            event.stopPropagation();
        });


        var updateTime = function() {
            var els = [], times =[];
            for (p in _timeSlot) {
                if (_timeSlot[p] == true) {
                    els.push('<span class="tag" data-value="'+p+'"><span data-value="'+p+'">' + p + '&nbsp;</span><a class="tprtags-remove-link"></a></span>');
                    times.push(p);
                }
            }
            var e = els.join('');
            if(!els.length) {
                e = '<span class="info">Schedule &nbsp;</span>';
            }
            e = e + '<div class="tprtags-add-container" id="tprtags_addTag">' +
            '<div class="tprtags-add"></div><input id="tprtags_tag" value="" data-default="" style="color: rgb(102, 102, 102); width: 7px;"><input name="tprSchedule" type="hidden" value="'+times.join(',')+'"></div>';

            $('.tprtags', $that).html($(e));
            //attach events on tags
            

            $('.tprtags-add', $that).on("click", function() {
                $('.timer-container').not($('.timer-container', $that)).addClass('hide');
                if ($('.timer-container', $that).hasClass('hide')) {
                    $('.timer-container', $that).removeClass('hide')
                    positionTimer();
                } else {
                    $('.timer-container', $that).addClass('hide')
                }
                event.stopPropagation();
            });
            
            $('.tag', $that).on("click", function(){
                closeAll();
                $('.timer-container', $that).removeClass('hide')
                var _grp = $('.chk-interval[data-group-interval="'+$(this).attr('data-value')+'"]', $that).closest('.tpr-group');
                $('.tpr-toggle', _grp).parent().addClass('open')
                positionTimer();
                event.stopPropagation();
            })
        }
        
        var positionTimer = function() {
            $('.timer-container', $that).css('top', $(".tprtags", $that).offset().top +$(".tprtags", $that).height())
        };

        var closeAll = function() {
            $('.timer-container').addClass('hide');
            $('.tpr-group').removeClass('open');
        };


        $('input.chk-interval', this.$element).click(function() {
            var group = $(this).closest('.tpr-group');
            if ($('input.chk-interval:checked', $(group)).length) {
                $('.tpr-default', group).css('border-bottom', '2px solid #41cac0');
            } else {
                $('.tpr-default', group).css('border-bottom', '');
            }

            for (p in _timeSlot) {
                _timeSlot[p] = false;
            }

            $('input.chk-interval:checked', $that).each(function() {
                var prop = $(this).attr('data-group-interval')
                _timeSlot[prop] = true;
            });
            //updatetime
            updateTime(_timeSlot, $that);
            positionTimer();
            event.stopPropagation();

        })

        updateTime(_timeSlot, $that);
        $(document).on("click", function() {
            closeAll();
        })

    }
    
    Tpr.prototype.getValues = function() {
        var e = [];
        for(p in this.timeSlot) {
            if (this.timeSlot[p] == true) {
                e.push(p);
            } 
        }
        return e.join(',');
    }



    $.fn.tpr = function(options, values) {
        var o;
        this.map(function() {
            var $this = $(this)
            var data = new Tpr(this, options);
            data.init(values);
            data.show();
            data.initEvents();
            o = data;
        })
        return o;
    }

    $.fn.tpr.Constructor = Tpr;

}(jQuery));