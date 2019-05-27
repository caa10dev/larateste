(function ( $ ) {

    $.fn.getZipcode = function(options) {

        var settings = $.extend({
            country: function(){},
            zipcode: function(){},
            onBefore: function(){},
            onAfter: function(){},
            onSuccess: function(endereco){},
            onError: function(message){}
        }, options );

        var RegExp = /^[\.-]/;

        if (typeof(settings.onSuccess) === "function")
            var zipcode = settings.zipcode();
        else
            var zipcode = settings.zipcode;

        if(zipcode == null)
            settings.onError('Nenhum CEP informado');

        settings.onBefore();

        var novoCep = zipcode.replace(/[\.-]/g, "");

        if(settings.country == 32) {
            
            $.get("/util/zipcode/pt-br/"+novoCep, function (json) {

                if(json.code===0)
                    settings.onSuccess(json.endereco);
                else
                    settings.onError(json.message);

                settings.onAfter();

            }, 'json');
        }        
    };

}( jQuery ));
