jQuery(function () {
    
    // Tabs
    jQuery("#fbfwTabs").tabs();

    // Hide form fields when not needed (switched by checkbox)
    function switchBlock(block, button) {
        var buttonValue = jQuery(button + ":checked").val();
        if (buttonValue == "on") {
            jQuery(block).css("display", "inline-block");
        } else {
            jQuery(block).css("display", "none");
        }

        jQuery(button).click(function () {
            jQuery(block).animate({
                opacity: "toggle",
                height: "toggle"
            }, 500);
        });

    }


    switchBlock("#borderColorBlock", "#border");
    switchBlock("#closeButtonBlock", "#showCloseButton");
    switchBlock("#overlayBlock", "#overlayShow");
    switchBlock("#titleBlock", "#titleShow");
    switchBlock("#callbackBlock", "#callbackEnable");
    switchBlock("#extraCallsBlock", "#extraCallsEnable");
    switchBlock("#easingBlock", "#easing");

    jQuery(document).ready(function () {
        jQuery(".slider-horizontal").each(function () {
            var mySl = jQuery(this);
            var defaultState = mySl.prev('input').val();
            mySl.attr('defSl', defaultState);
        });




        //Function enable codemirror on FancyBox Extra Calls

        jQuery('.start-editing').click(function () {
            wp.codeEditor.initialize(jQuery(this).next("textarea"));
            jQuery(this).hide();
        });


        //add color picker to buttons
        jQuery('.color-btn').wpColorPicker();
    });

    jQuery(window).load(function () {
        //function to initiate horizontal slider from jQuery UI
        jQuery(".slider-horizontal").each(function () {
            var mySl = jQuery(this);
            var minSl = parseFloat(mySl.attr("minSl"));
            var maxSl = parseFloat(mySl.attr("maxSl"));
            var defSl = parseFloat(mySl.attr("defSl"));
            var stepSl = parseFloat(mySl.attr("stepSl"));
            jQuery(this).slider({
                orientation: "horizontal",
                range: "min",
                min: minSl,
                max: maxSl,
                value: defSl,
                step: stepSl,
                slide: function (event, ui) {
                    mySl.prev("input").val(ui.value);
                }
            });
        });
    });

    // Hide Title Color if not needed
    var titlePosition = jQuery("input:radio[class=titlePosition]:checked").val();

    switch (titlePosition) {
        case "float":
        case "outside":
        case "over":
            jQuery("#titleColorBlock").css("display", "none");
    }

    jQuery("#titlePositionFloat, #titlePositionOutside, #titlePositionOver").click(function () {
        jQuery("#titleColorBlock").hide("slow");
    });

    jQuery("#titlePositionInside").click(function () {
        jQuery("#titleColorBlock").show("slow");
    });


    // Gallery Type
    var galleryType = jQuery("input:radio[class=galleryType]:checked").val();

    switch (galleryType) {
        case "all":
        case "none":
        case "post":
            jQuery("#customExpressionBlock").css("display", "none");
    }

    jQuery("#galleryTypeAll, #galleryTypeNone, #galleryTypePost").click(function () {
        jQuery("#customExpressionBlock").hide("slow");
    });

    jQuery("#galleryTypeCustom").click(function () {
        jQuery("#customExpressionBlock").show("slow");
    });

});

function confirmDefaults() {
    if (confirm(defaults_prompt) == true)
        return true;
    else
        return false;
}

var defaults_prompt = "Are you sure you want to restore FancyBox for WordPress to default settings?";

function activatePlugin( url ) {
    jQuery.ajax( {
        async: true,
        type: 'GET',
        dataType: 'html',
        url: url,
        success: function() {
            location.reload();
        }
    } );
}

jQuery( '.mfbfw-modula-link' ).click(function(evt){
    evt.preventDefault();

    var action = jQuery( this ).data( 'action' ),
        link = jQuery( this ).attr( 'href' );

    jQuery(this).addClass( 'updating-message' );
    jQuery(this).attr( 'disabled', 'disabled' );

    if ( 'install' == action ) {
        wp.updates.installPlugin( { slug: 'modula-best-grid-gallery' } );
    }else{
        activatePlugin( link );
    }

});

jQuery( document ).on( 'wp-plugin-install-success', function( response, data ) {

    if ( 'modula-best-grid-gallery' == data.slug ) {

        jQuery.ajax( {
            type: 'POST',
            data: { action: 'mfbfw_activate_link' },
            dataType: 'json',
            url: ajaxurl,
            success: function( json ) {
                if ( json.status ) {
                    activatePlugin( json.link );
                }
            }
        });

    }
    console.log( response );
    console.log( data );
});