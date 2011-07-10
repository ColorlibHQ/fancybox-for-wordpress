
jQuery(function(){

  // Tabs
  jQuery("#fbfwTabs").tabs();
	
	// Hide Donation and twitter stuff on tabs other than Info
  jQuery("#fbfwTabs li a").click(function(){
		jQuery("#mfbfwd").hide();
  });
	
	jQuery("#show-mfbfwd").click(function(){
		jQuery("#mfbfwd").show();
  });

  // Advanced Settings Switcher
  jQuery("#advOpsSwitch").click(function(){
		jQuery(".advOpts").toggle("slow");
  });

  // Troubleshooting & Settings Switcher
  jQuery("#troOpsSwitch").click(function(){
		jQuery(".troOpts").toggle("slow");
  });

  // Hide Custom Expresion textarea if not needed
  var galleryType = jQuery("input:radio[name=mfbfw_galleryType]:checked").val();

  switch (galleryType) {
	case "all":
	case "none":
	case "post":
	  jQuery("#customExpressionBlock").css("display", "none");
  }

  jQuery("#mfbfw_galleryTypeAll").click(function () {
	jQuery("#customExpressionBlock").hide("slow");
  });

  jQuery("#mfbfw_galleryTypePost").click(function () {
	jQuery("#customExpressionBlock").hide("slow");
  });

  jQuery("#mfbfw_galleryTypeCustom").click(function () {
	jQuery("#customExpressionBlock").show("slow");
  });

})
