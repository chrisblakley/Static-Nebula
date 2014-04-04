<?php

//PHP-Mobile-Detect - http://mobiledetect.net
//Before running conditions using this, you must have $detect = new Mobile_Detect(); before the logic.
//For an example of this, see the footer.php of the theme.
//Logic can fire from "isMobile()" or "isTablet()" or "is('AndroidOS')". View the Mobile_Detect.php file in /includes/ to see the full list.
require_once 'Mobile_Detect.php';


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