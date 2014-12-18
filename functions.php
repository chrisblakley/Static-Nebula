<?php
/**
 * Functions
 */



/*==========================
 Important Global Variables
 ===========================*/
$GLOBALS['ga'] = ''; //@TODO "Analytics" 5: Change Google Analytics Tracking ID here!

$GLOBALS['bloginfo']['name'] = 'Static Nebula';
$GLOBALS['bloginfo']['home_url'] = 'http://remotelynk.com/'; //@TODO "Permalinks" 5: Change the root URL here. Be sure to update this variable after go-live!
$GLOBALS['bloginfo']['template_directory'] = 'http://remotelynk.com'; //No trailing slash!
//$GLOBALS['bloginfo']['template_directory'] = rtrim($protocol . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/'); //@TODO: Replace this with nebula_url_components(); - Also need to figure out placement of this line since it would need nebula_utilities.php to work, but the end of THAT file needs THIS variable.
$GLOBALS['bloginfo']['admin_email'] = 'chris@gearside.com';



/*==========================
 Include Nebula Utility Functions
 ===========================*/
require_once('functions/nebula_utilities.php'); //Nebula Utilities




/*==========================
 Include Remaining Nebula Functions Groups
 ===========================*/
require_once('functions/nebula_optimization.php'); //Nebula Optimization
require_once('functions/nebula_functions.php'); //Nebula Functions
require_once('functions/nebula_security.php'); //Nebula Security
require_once('functions/nebula_wireframing.php'); //Nebula Wireframing (can be commented out after launch)
//require_once('functions/nebula_inprogress.php'); //Nebula In Progress (Functions currently being developed. Recommended to remain commented out.)







//Control how scripts are loaded, and force clear cache for debugging
if ( array_key_exists('debug', $_GET) ) {
	$GLOBALS["debug"] = true;
	$GLOBALS["defer"] = '';
	$GLOBALS["async"] = '';
	$GLOBALS["gumby_debug"] = 'gumby-debug';
	header("Expires: Fri, 28 Mar 1986 02:40:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
} else {
	$GLOBALS["debug"] = false;
	$GLOBALS["defer"] = 'defer';
	$GLOBALS["async"] = 'async';
	$GLOBALS["gumby_debug"] = 'defer';
}




function nebula_facebook_link() {
	echo '<p class="facebook-connect-con"><i class="fa fa-facebook-square"></i> <a class="facebook-connect" href="#">Connect with Facebook</a></p>';
}


/*==========================

 Custom Functions

 ===========================*/




















//Close functions.php. Do not add anything after this closing tag!! ?>