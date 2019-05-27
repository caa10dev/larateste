(function ($) {

    $.fn.countries = function(options) {

        var select = $(this);

        var settings = $.extend({
            'default': select.attr('default'),
            'onChange': function(country){}
        }, options );

        select.attr('data-search', 0);select.attr('data-maoe', 0);

        $.get("/util/countries", null, function (json) {
            $.each(json, function (key, value) {
                select.append('<option value="' + value.id + '" '+(settings.default==value.id?'selected':'')+'>' + value.name + '</option>');
            })

            settings.onChange(select.val());

        }, 'json');

        select.change(function(){
            settings.onChange(select.val());
        });
    };

    $.fn.states = function(options) {

        var select = $(this);

        var settings = $.extend({
            'default': select.attr('default'),
            'onChange': function(state){}
        }, options ); 

        if(settings.country_id != null) {
            select.attr('data-search', 0);select.attr('data-maoe', 0);

            var clone = $('.overlay_clone').clone(true);
            clone.removeClass('overlay_clone');
            $('.overlay-wrapper').append(clone);
            clone.show();

            select.html('<option>'+settings.messages.loading+'</option>');

            $.get("/util/states/"+settings.country_id, null, function (json) {
                select.html('<option value="">'+settings.messages.select+'</option>');

                $.each(json, function (key, value) {
                    select.append('<option value="' + value.id + '" '+((settings.default==value.id)?'selected':'')+'>' + value.code + '</option>');
                })

            }, 'json').done(function(){
                clone.remove();
            });
        }
        
        select.change(function(){
            settings.onChange(select.val());
        });
    };

    $.fn.cities = function(options) {

        var select = $(this);

        var settings = $.extend({
            'default': select.attr('default'),
            'state_id': null
        }, options );

        if(settings.state_id != null) {

            var clone = $('.overlay_clone').clone(true);
            clone.removeClass('overlay_clone');
            $('.overlay-wrapper').append(clone);
            clone.show();

            select.html('<option>'+settings.messages.loading+'</option>');

            $.get("/util/cities/"+settings.state_id, null, function (json) {
                select.html('<option value="">'+settings.messages.select+'</option>');

                $.each(json, function (key, value) {
                    select.append('<option value="' + value.id + '" '+((settings.default==value.name || settings.default==value.id)?'selected':'')+'>' + value.name + '</option>');
                })

            }, 'json').done(function(){
                clone.remove();
            });

        }
    };

}(jQuery));
