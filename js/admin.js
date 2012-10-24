/* idTabs ~ Sean Catchpole - Version 2.2 - MIT/GPL */
(function(){var dep={"jQuery":"http://code.jquery.com/jquery-latest.min.js"};var init=function(){(function($){$.fn.idTabs=function(){var s={};for(var i=0;i<arguments.length;++i){var a=arguments[i];switch(a.constructor){case Object:$.extend(s,a);break;case Boolean:s.change=a;break;case Number:s.start=a;break;case Function:s.click=a;break;case String:if(a.charAt(0)=='.')s.selected=a;else if(a.charAt(0)=='!')s.event=a;else s.start=a;break;}}
if(typeof s['return']=="function")
s.change=s['return'];return this.each(function(){$.idTabs(this,s);});}
$.idTabs=function(tabs,options){var meta=($.metadata)?$(tabs).metadata():{};var s=$.extend({},$.idTabs.settings,meta,options);if(s.selected.charAt(0)=='.')s.selected=s.selected.substr(1);if(s.event.charAt(0)=='!')s.event=s.event.substr(1);if(s.start==null)s.start=-1;var showId=function(){if($(this).is('.'+s.selected))
return s.change;var id="#"+this.href.split('#')[1];var aList=[];var idList=[];$("a",tabs).each(function(){if(this.href.match(/#/)){aList.push(this);idList.push("#"+this.href.split('#')[1]);}});if(s.click&&!s.click.apply(this,[id,idList,tabs,s]))return s.change;for(i in aList)$(aList[i]).removeClass(s.selected);for(i in idList)$(idList[i]).hide();$(this).addClass(s.selected);$(id).show();return s.change;}
var list=$("a[href*='#']",tabs).unbind(s.event,showId).bind(s.event,showId);list.each(function(){$("#"+this.href.split('#')[1]).hide();});var test=false;if((test=list.filter('.'+s.selected)).length);else if(typeof s.start=="number"&&(test=list.eq(s.start)).length);else if(typeof s.start=="string"&&(test=list.filter("[href*='#"+s.start+"']")).length);if(test){test.removeClass(s.selected);test.trigger(s.event);}
return s;}
$.idTabs.settings={start:0,change:false,click:null,selected:".selected",event:"!click"};$.idTabs.version="2.2";$(function(){$(".idTabs").idTabs();});})(jQuery);}
var check=function(o,s){s=s.split('.');while(o&&s.length)o=o[s.shift()];return o;}
var head=document.getElementsByTagName("head")[0];var add=function(url){var s=document.createElement("script");s.type="text/javascript";s.src=url;head.appendChild(s);}
var s=document.getElementsByTagName('script');var src=s[s.length-1].src;var ok=true;for(d in dep){if(check(this,d))continue;ok=false;add(dep[d]);}if(ok)return init();add(src);})();


jQuery(function (){

	// Tabs
	jQuery("#fbfw_tabs").idTabs();


	// Hide Donation and twitter stuff on tabs other than Info
	jQuery("#fbfwTabs .nav-tab").click(function (){
		if (jQuery(this).attr("href") == "#fbfw-info") {
			jQuery("#mfbfwd").show();
		} else {
			jQuery("#mfbfwd").hide();
		}
	});


	// Hide form fields when not needed (swithed by checkbox)
	function switchBlock(block,button) {
		var buttonValue = jQuery(button + ":checked").val();
		if (buttonValue == "on") { jQuery(block).css("display", "inline"); }
		else { jQuery(block).css("display", "none"); }

		jQuery(button).click(function (){
			jQuery(block).animate({opacity: "toggle", height: "toggle"}, 500);
		});
	}

	switchBlock("#borderColorBlock","#border");
	switchBlock("#closeButtonBlock","#showCloseButton");
	switchBlock("#overlayBlock","#overlayShow");
	switchBlock("#titleBlock","#titleShow");
	switchBlock("#callbackBlock","#callbackEnable");
	switchBlock("#extraCallsBlock","#extraCallsEnable");
	switchBlock("#easingBlock","#easing");


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


	// Color Picker
	var $color_inputs = jQuery("input.mfbfw_colorpicker");
	$color_inputs.each(function () {
		var $input = jQuery(this);
		var $pickerId = "#" + jQuery(this).attr("id") + "_picker";
		jQuery($pickerId).farbtastic($input);
		jQuery($input).click(function () {
			jQuery($pickerId).animate({opacity: "toggle", height: "toggle"}, 500)
		});
	});

})

function confirmDefaults() {
	if (confirm(defaults_prompt) == true)
		return true;
	else
		return false;
}

var defaults_prompt = "Are you sure you want to restore FancyBox for WordPress to default settings?";
