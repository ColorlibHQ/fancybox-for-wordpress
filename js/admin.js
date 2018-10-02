jQuery(function () {
	
	// Tabs
	jQuery("#fbfwTabs").tabs();
	
	// Hide Donation and twitter stuff on tabs other than Info
	jQuery("#fbfwTabs li a").click(function () {
		if (jQuery(this).is("#ui-id-1")) {
			jQuery("#mfbfwd").show();
			} else {
			jQuery("#mfbfwd").hide();
		}
	});
	
	
	// Hide form fields when not needed (swithed by checkbox)
	function switchBlock(block, button) {
		var buttonValue = jQuery(button + ":checked").val();
		if (buttonValue == "on") {
			jQuery(block).css("display", "inline");
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
	
	
	//Modified
	//Razvan Test Function enable codemirror on FancyBox Extra Calls
	jQuery(document).ready(function(){
		
		//function to initiate On-Off switch buttons
		jQuery('.custom-switch').each(function(){
			new DG.OnOffSwitch({
				el: jQuery(this),
				textOn: 'On',
				textOff: 'Off',
			});
		});
		
		jQuery( ".slider-horizontal" ).each(function(){
			var mySl = jQuery(this);
			var defaultState = mySl.prev('input').val();
			mySl.attr('defSl',defaultState);
		});		
		
		//modified by Razvan
		var textArea = document.getElementById('extraCalls');
		if (jQuery('.CodeMirror').length) {
			
			} else {
			CodeMirror.fromTextArea(textArea);
			
		}
		jQuery( 'input[type="color"]' ).wpColorPicker();
	});
	
	jQuery(window).load(function(){
		jQuery('.CodeMirror').addClass('CodeMirror-focused');
		//function to initiate horizontal slider from jQuery UI
		jQuery( ".slider-horizontal" ).each(function(){
			var mySl = jQuery(this);
			var minSl = parseFloat(mySl.attr('minSl'));
			var maxSl = parseFloat(mySl.attr('maxSl'));
			var defSl = parseFloat(mySl.attr('defSl'));
			var stepSl = parseFloat(mySl.attr('stepSl'));
			console.log(minSl);
			jQuery(this).slider({
				orientation: "horizontal",
				range: "min",
				min: minSl,
				max: maxSl,
				value:defSl,
				step:stepSl,
				slide: function( event, ui ) {
					mySl.prev('input').val( ui.value );
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
	
})

function confirmDefaults() {
	if (confirm(defaults_prompt) == true)
	return true;
	else
	return false;
}

var defaults_prompt = "Are you sure you want to restore FancyBox for WordPress to default settings?";