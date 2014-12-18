<?php
	if ( file_exists('../functions.php') ) {

		require_once('../functions.php');

		/*
			$_GET['h'] is home_url('/');
			$_GET['p'] is nebula_url_components('all');
			$_GET['t'] is urlencode(get_the_title($post->ID));
		*/

		ga_send_pageview($_GET['h'], $_GET['p'], $_GET['t']);
		ga_send_event('JavaScript Disabled', $_SERVER['HTTP_USER_AGENT'], $_GET['t']);

		//Parse detected User Agents here: http://udger.com/resources/online-parser

	} else {
		die('File does not exist.');
	}
?>