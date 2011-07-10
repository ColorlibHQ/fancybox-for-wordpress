<?php

echo "\n".'<link rel="stylesheet" href="'. FBFW_URL . '/css/jquery-ui.css" type="text/css" media="screen" />'."\n";

// Get array with all the options
$settings = mfbfw_get_settings();

// Make selects data
$closePositionArray = array('left','right');
$overlayArray = array(0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1);
$msArray = array(0,25,50,75,100,200,300,400,500,600,700,800,900,1000,1250,1500,1750,2000);
$easingArray = array('easeInQuad','easeOutQuad','easeInOutQuad','easeInCubic','easeOutCubic','easeInOutCubic','easeInQuart','easeOutQuart',
	'easeInOutQuart','easeInQuint','easeOutQuint','easeInOutQuint','easeInSine','easeOutSine','easeInOutSine','easeInExpo',
	'easeOutExpo','easeInOutExpo','easeInCirc','easeOutCirc','easeInOutCirc','easeInElastic','easeOutElastic','easeInOutElastic',
	'easeInBack','easeOutBack','easeInOutBack','easeInBounce','easeOutBounce','easeInOutBounce');

?>