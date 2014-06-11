<?php

//PHP-Mobile-Detect - https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
//Before running conditions using this, you must have $detect = new Mobile_Detect(); before the logic.
//Logic can fire from "$detect->isMobile()" or "$detect->isTablet()" or "$detect->is('AndroidOS')".
require_once 'includes/Mobile_Detect.php';
$GLOBALS["mobile_detect"] = new Mobile_Detect();


function mobile_classes() {
	$mobile_classes = '';
	if ( $GLOBALS["mobile_detect"]->isMobile() ) {
		$mobile_classes .= ' mobile';
	} else {
		$mobile_classes .= ' no-mobile';
	}
	if ( $GLOBALS["mobile_detect"]->isTablet() ) {
		$mobile_classes .= ' tablet';
	}
	if ( $GLOBALS["mobile_detect"]->isiOS() ) {
		$mobile_classes .= ' ios';
	}
	if ( $GLOBALS["mobile_detect"]->isAndroidOS() ) {
		$mobile_classes .= ' androidos';
	}
	echo $mobile_classes;
}

//Control how scripts are loaded, and force clear cache for debugging
if ( array_key_exists('debug', $_GET) ) {
	$GLOBALS["defer"] = '';
	$GLOBALS["async"] = '';
	$GLOBALS["gumby_debug"] = 'gumby-debug';
	header("Expires: Fri, 28 Mar 1986 02:40:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
} else {
	$GLOBALS["defer"] = 'defer';
	$GLOBALS["async"] = 'async';
	$GLOBALS["gumby_debug"] = '';
}


//Automatically convert HEX colors to RGB.
function hex2rgb( $colour ) {
	if ( $colour[0] == '#' ) {
		$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
		list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
		list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
		return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

?>