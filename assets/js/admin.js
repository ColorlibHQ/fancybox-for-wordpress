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

        jQuery(button).on('click', function () {
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

    jQuery(".slider-horizontal").each(function () {
        var mySl = jQuery(this);
        var defaultState = mySl.prev('input').val();
        mySl.attr('defSl', defaultState);
    });

    //Function enable codemirror on FancyBox Extra Calls
    jQuery('.start-editing').on('click', function () {
        wp.codeEditor.initialize(jQuery(this).next("textarea"));
        jQuery(this).hide();
    });


    //add color picker to buttons
    jQuery('.color-btn').wpColorPicker();

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

    // Hide Title Color if not needed
    var titlePosition = jQuery("input:radio[class=titlePosition]:checked").val();

    switch (titlePosition) {
        case "float":
        case "outside":
        case "over":
            jQuery("#titleColorBlock").css("display", "none");
    }

    jQuery("#titlePositionFloat, #titlePositionOutside, #titlePositionOver").on('click', function () {
        jQuery("#titleColorBlock").hide("slow");
    });

    jQuery("#titlePositionInside").on('click', function () {
        jQuery("#titleColorBlock").show("slow");
    });


    // Gallery Type
    var galleryType = jQuery("input:radio[class=galleryType]:checked").val();

    switch (galleryType) {
        case "all":
        case "none":
        case "post":
        case "single_gutenberg_block" :
            jQuery("#customExpressionBlock").css("display", "none");
    }

    jQuery("#galleryTypeAll, #galleryTypeNone, #galleryTypePost, #galleryTypeGutenbergBlock").on('click', function () {
        jQuery("#customExpressionBlock").hide("slow");
    });

    jQuery("#galleryTypeCustom").on('click', function () {
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