<?php

//Set server timezone to match Wordpress
date_default_timezone_set('America/New_York');


//Track Google Page Speed tests
if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Google Page Speed') !== false ) {
	$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
	$currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	if ( strpos($currentURL, ".js") !== false ) {
		exit();
	} else {
		global $post;
		$currentTitle = get_the_title($post->ID);
	}

	ga_send_event('Google Page Speed', $currentURL, $currentTitle);
}


//Add the calling card to the browser console
function nebula_calling_card() {
	//@TODO "Nebula" 0: if chrome or firefox... (find what other browsers support this)
	echo "<script>
		if ( document.getElementsByTagName('html')[0].className.indexOf('lte-ie8') < 0 ) {
		console.log('%c', 'padding: 28px 119px; line-height: 35px; background: url(" . get_template_directory_uri() . "/images/phg/phg-logo.png) no-repeat; background-size: auto 60px;');
		console.log('%c Created using Nebula ', 'padding: 2px 10px; background: #0098d7; color: #fff;');
		}
	</script>";
}


function pinckneyhugogroup($anim=false){
	if ( $anim ) {
		$anim = 'anim';
	}
	echo '<a class="phg ' . $anim . '" href="http://www.pinckneyhugo.com/" target="_blank"><span class="pinckney">Pinckney</span><span class="hugo">Hugo</span><span class="group">Group</span></a>';
}



function nebula_custom_excerpt($text=false, $length=55, $hellip=false, $link=false, $more=false) {
	$string = strip_tags(strip_shortcodes($text), '');

	$string = string_limit_words($string, $length);

	if ( $hellip ) {
		if ( $string[1] == 1 ) {
			$string[0] .= '&hellip; ';
		}
	}

	if ( isset($link) && isset($more) && $more != '' ) {
		$string[0] .= ' <a class="nebula_custom_excerpt" href="' . $link . '">' . $more . '</a>';
	}

	return $string[0];
}

header(base64_decode('RGV2ZWxvcGVkLXdpdGgtTmVidWxhOiBodHRwOi8vZ2VhcnNpZGUuY29tL25lYnVsYQ'.'=='));


//Add custom body classes
function nebula_body_classes($classes) {
	$spaces_and_dots = array(' ', '.');
	$underscores_and_hyphens = array('_', '-');

	//$classes[] = strtolower(str_replace($spaces_and_dots, $underscores_and_hyphens, nebula_device_detect())); //Add Device info to body classes //@TODO "Nebula" 0: Enable once better detection is set up.
	$classes[] = strtolower(str_replace($spaces_and_dots, $underscores_and_hyphens, nebula_os_detect())); //Add Operating System info to body classes
	$classes[] = strtolower(str_replace($spaces_and_dots, $underscores_and_hyphens, wp_browser_detect())); //Add Browser info to body classes
	$classes[] = str_replace($spaces_and_dots, $underscores_and_hyphens, $GLOBALS['browser_detect']['os']) . '_' . str_replace($spaces_and_dots, $underscores_and_hyphens, $GLOBALS['browser_detect']['os_number']); //Alternate OS detection with OS version too
	$classes[] = str_replace($spaces_and_dots, $underscores_and_hyphens, $GLOBALS['browser_detect']['browser_working']); //Rendering engine
	$classes[] = str_replace($spaces_and_dots, $underscores_and_hyphens, $GLOBALS['browser_detect']['browser_name']) . '_' . str_replace($spaces_and_dots, $underscores_and_hyphens, $GLOBALS['browser_detect']['browser_math_number']); //Browser name and major version number

	//Mobile
	if ( $is_iphone ) {
    	$classes[] = 'iphone';
    }
	if ( $GLOBALS["mobile_detect"]->isMobile() ) {
		$classes[] = 'mobile';
	} else {
		$classes[] = 'no-mobile';
	}
	if ( $GLOBALS["mobile_detect"]->isTablet() ) {
		$classes[] = 'tablet';
	}
	if ( $GLOBALS["mobile_detect"]->isiOS() ) {
		$classes[] = 'ios';
	}
	if ( $GLOBALS["mobile_detect"]->isAndroidOS() ) {
		$classes[] = 'androidos';
	}

	//Time of Day
	$classes[] = ( currently_open() ) ? 'business-open' : 'business-closed';
	if ( contains(date('H'), array('00', '01', '02')) ) {
		$classes[] = 'time-early time-night';
	} elseif ( contains(date('H'), array('03', '04', '05')) ) {
		$classes[] = 'time-late time-night';
	} elseif ( contains(date('H'), array('06', '07', '08')) ) {
		$classes[] = 'time-early time-morning';
	} elseif ( contains(date('H'), array('09', '10', '11')) ) {
		$classes[] = 'time-late time-morning';
	} elseif ( contains(date('H'), array('12', '13', '14')) ) {
		$classes[] = 'time-early time-afternoon';
	} elseif ( contains(date('H'), array('15', '16', '17')) ) {
		$classes[] = 'time-late time-afternoon';
	} elseif ( contains(date('H'), array('18', '19', '20')) ) {
		$classes[] = 'time-early time-evening';
	} elseif ( contains(date('H'), array('21', '22', '23')) ) {
		$classes[] = 'time-late time-evening';
	}
	$classes[] = 'day-' . strtolower(date('l'));
	$classes[] = 'month-' . strtolower(date('F'));

    return $classes;
}



//Detect weather for Zip Code (using Yahoo! Weather)
function nebula_weather($zipcode=null, $data=null, $fresh=null){
	if ( $zipcode && is_string($zipcode) && !ctype_digit($zipcode) ) { //ctype_alpha($zipcode)
		$data = $zipcode;
		$zipcode = nebula_settings_conditional_text('nebula_postal_code', '13204');
	} elseif ( !$zipcode ) {
		$zipcode = nebula_settings_conditional_text('nebula_postal_code', '13204');
	}

	if ( $zipcode != $current_weather['zip'] || isset($fresh) ) {
		$url = 'http://weather.yahooapis.com/forecastrss?p=' . $zipcode;
		$use_errors = libxml_use_internal_errors(true);
		$xml = simplexml_load_file($url);
		if ( !$xml ) {
			$xml = simplexml_load_file('http://gearside.com/wp-content/themes/gearside2014/includes/static-weather.xml'); //Set a static fallback to prevent PHP errors @TODO "Nebula" 0: Change hard-coded URL!
		}
		libxml_clear_errors();
		libxml_use_internal_errors($use_errors);

		global $current_weather;
		$current_weather['conditions'] = $xml->channel->item->children('yweather', TRUE)->condition->attributes()->text;
		$current_weather['temp'] = $xml->channel->item->children('yweather', TRUE)->condition->attributes()->temp;
		$current_weather['city'] = $xml->channel->children('yweather', TRUE)->location->attributes()->city;
		$current_weather['state'] = $xml->channel->children('yweather', TRUE)->location->attributes()->region;
		$current_weather['city_state'] = $current_weather['city'] . ', ' . $current_weather['state'];
		$current_weather['zip'] = $zipcode;
		$current_weather['sunrise'] = $xml->channel->children('yweather', TRUE)->astronomy->attributes()->sunrise;
		$current_weather['sunset'] = $xml->channel->children('yweather', TRUE)->astronomy->attributes()->sunset;
		$current_weather["sunrise_seconds"] = strtotime($current_weather['sunrise'])-strtotime('today'); //Sunrise in seconds
		$current_weather["sunset_seconds"] = strtotime($current_weather['sunset'])-strtotime('today'); //Sunset in seconds
		$current_weather["noon_seconds"] = (($current_weather["sunset_seconds"]-$current_weather["sunrise_seconds"])/2)+$current_weather["sunrise_seconds"]; //Solar noon in seconds
		$current_weather['time_seconds'] = time()-strtotime("today");
	}

	if ( $data && isset($current_weather[$data]) ) {
		return $current_weather[$data];
	} elseif ( $data && !isset($current_weather[$data]) ) {
		return 'Error: Requested data "' . $data . '" is not defined.';
	} else {
		return $current_weather;
	}
}

function vimeo_meta($videoID) {
	$xml = simplexml_load_string(file_get_contents("http://vimeo.com/api/v2/video/" . $videoID . ".xml")); //@TODO "Nebula" 0: Use WP_Filesystem methods instead of file_get_contents
	$GLOBALS['vimeo_meta']['id'] = $videoID;
	$GLOBALS['vimeo_meta']['title'] = $xml->video->title;
	$GLOBALS['vimeo_meta']['safetitle'] = str_replace(" ", "-", $GLOBALS['vimeo_meta']['title']);
	$GLOBALS['vimeo_meta']['description'] = $xml->video->description;
	$GLOBALS['vimeo_meta']['upload_date'] = $xml->video->upload_date;
	$GLOBALS['vimeo_meta']['thumbnail'] = $xml->video->thumbnail_large;
	$GLOBALS['vimeo_meta']['url'] = $xml->video->url;
	$GLOBALS['vimeo_meta']['user'] = $xml->video->user_name;
	$GLOBALS['vimeo_meta']['seconds'] = strval($xml->video->duration);
	$GLOBALS['vimeo_meta']['duration'] = intval(gmdate("i", $GLOBALS['vimeo_meta']['seconds'])) . gmdate(":s", $GLOBALS['vimeo_meta']['seconds']);
	return $GLOBALS['vimeo_meta'];
}


function youtube_meta($videoID) {
	$xml = simplexml_load_string(file_get_contents("https://gdata.youtube.com/feeds/api/videos/" . $videoID)); //@TODO "Nebula" 0: Use WP_Filesystem methods instead of file_get_contents
	$GLOBALS['youtube_meta']['origin'] = nebula_url_components('basedomain');
	$GLOBALS['youtube_meta']['id'] = $videoID;
	$GLOBALS['youtube_meta']['title'] = $xml->title;
	$GLOBALS['youtube_meta']['safetitle'] = str_replace(" ", "-", $GLOBALS['youtube_meta']['title']);
	$GLOBALS['youtube_meta']['content'] = $xml->content;
	$GLOBALS['youtube_meta']['href'] = $xml->link['href'];
	$GLOBALS['youtube_meta']['author'] = $xml->author->name;
	$temp = $xml->xpath('//yt:duration[@seconds]');
    $GLOBALS['youtube_meta']['seconds'] = strval($temp[0]->attributes()->seconds);
	$GLOBALS['youtube_meta']['duration'] = intval(gmdate("i", $GLOBALS['youtube_meta']['seconds'])) . gmdate(":s", $GLOBALS['youtube_meta']['seconds']);
	return $GLOBALS['youtube_meta'];
}




//Create tel: link if on mobile, otherwise return unlinked, human-readable number
function nebula_tel_link($phone, $postd=''){
	if ( $GLOBALS["mobile_detect"]->isMobile() ) {
		if ( $postd ) {
			$search = array('#', 'p', 'w');
			$replace   = array('%23', ',', ';');
			$postd = str_replace($search, $replace, $postd);
			if ( strpos($postd, ',') === false || strpos($postd, ';') === false ) {
				$postd = ',' . $postd;
			}
		}
		return '<a class="nebula-tel-link" href="tel:' . nebula_phone_format($phone, 'tel') . $postd . '">' . nebula_phone_format($phone, 'human') . '</a>';
	} else {
		return nebula_phone_format($phone, 'human');
	}
}

//Create sms: link if on mobile, otherwise return unlinked, human-readable number
function nebula_sms_link($phone, $message=''){
	if ( $GLOBALS["mobile_detect"]->isMobile() ) {
		$sep = ( $GLOBALS["mobile_detect"]->isiOS() ) ? '?' : ';';
		//@TODO "Nebula" 0: Encode $message string here...?
		return '<a class="nebula-sms-link" href="sms:' . nebula_phone_format($phone, 'tel') . $sep . 'body=' . $message . '">' . nebula_phone_format($phone, 'human') . '</a>';
	} else {
		return nebula_phone_format($phone, 'human');
	}
}

//Convert phone numbers into ten digital dial-able or to human-readable
function nebula_phone_format($number, $format=''){

	if ( $format == 'human' && (strpos($number, ')') == 4 || strpos($number, ')') == 6) ) {
		//Format is already human-readable
		return $number;
	} elseif ( $format == 'tel' && (strpos($number, '+1') == 0 && strlen($number) == 12) ) {
		//Format is already dialable
		return $number;
	}

	if ( (strpos($number, '+1') == 0 && strlen($number) == 12) || (strpos($number, '1') == 0 && strlen($number) == 11) || strlen($number) == 10 && $format != 'tel' ) {
		//Convert from dialable to human
		if ( strpos($number, '1') == 0 && strlen($number) == 11 ) {
			//13154786700
			$number = '(' . substr($number, 1, 3) . ') ' . substr($number, 4, 3) . '-' . substr($number, 7);
		} elseif ( strlen($number) == 10 ) {
			//3154786700
			$number = '(' . substr($number, 0, 3) . ') ' . substr($number, 3, 3) . '-' . substr($number, 6);
		} elseif ( strpos($number, '+1') == 0 && strlen($number) == 12 ) {
			//+13154786700
			$number = '(' . substr($number, 2, 3) . ') ' . substr($number, 5, 3) . '-' . substr($number, 8);
		} else {
			return 'Error: Unknown format.';
		}
		//@TODO "Nebula" 0: Maybe any numbers after "," "p" ";" or "w" could be added to the human-readable in brackets, like: (315) 555-1346 [323]
		//To do the above, set a remainder variable from above and add it to the return (if it exists). Maybe even add them to a span with a class so they can be hidden if undesired?
		return $number;
	} else {
		if ( strlen($number) < 7 ) {
			return 'Error: Too few digits.';
		} elseif ( strlen($number) < 10 ) {
			return 'Error: Too few digits (area code is required).';
		}
		//Convert from human to dialable
		if ( strpos($number, '1') != '0' ) {
			$number = '1 ' . $number;
		}

		if ( strpos($number,'x') !== false ) {
			$postd = ';p' . substr($number, strpos($number, "x") + 1);
		} else {
			$postd = '';
		}
		$number = str_replace(array(' ', '-', '(', ')', '.', 'x'), '', $number);
		$number = substr($number, 0, 11);
		return '+' . $number . $postd;
	}
}