jQuery.noConflict();

jQuery(document).ready(function() {

	getQueryStrings();
	if ( GET('killall') || GET('kill') || GET('die') ) {
		throw ' (Manually terminated main.js)';
	} else if ( GET('layout') ) {
		console.log('Visualizing layout...');
		[].forEach.call(jQuery("*"),function(a){a.style.outline="1px solid #"+(~~(Math.random()*(1<<24))).toString(16)});
	}

	facebookSDK();
	conditionalJSLoading();

	//Init Custom Functions
	gaEventTracking();

	helperFunctions();
	socialSharing();
	dropdownWidthController();
	overflowDetector();
	subnavExpanders();
	nebulaFixeder();

	/* Choose whether to use mmenu or doubletaptogo for mobile device navigation */
	mmenus();
	//jQuery('#primarynav .menu-item-has-children').doubleTapToGo();

	powerFooterWidthDist();
	menuSearchReplacement();
	pageVisibility();


	//Detect if loaded in an iframe
	if ( window != window.parent ) {
		jQuery('html').addClass('in-iframe');
		if ( window.parent.location.toString().indexOf('wp-admin') == -1 ) {
			ga('send', 'event', 'Iframe', 'Loaded within: ' + window.parent.location, {'nonInteraction': 1});
		}
	}

	if ( jQuery('body').hasClass('search-no-results') || jQuery('body').hasClass('error404') ) {
		pageSuggestion();
	}

	vimeoControls();

	mapInfo = [];
	getAllLocations();
	mapActions();

	//Fix for <p> tags wrapping my pre spans in the WYSIWYG
	jQuery('span.nebula-code').parent('p').css('margin-bottom', '0px');

	jQuery('.wpcf7-captchar').attr('title', 'Not case-sensitive');

	if ( !jQuery('html').hasClass('lte-ie8') ) { //@TODO "Nebula" 0: This breaks in IE8. This conditional should only be a temporary fix.
		viewport = updateViewportDimensions();
	}

	jQuery(window).resize(function() {
		waitForFinalEvent(function(){

	    	//Window resize functions here.
	    	powerFooterWidthDist();

	    	//Track size change
	    	if ( !jQuery('html').hasClass('lte-ie8') ) { //@TODO "Nebula" 0: This breaks in IE8. This conditional should only be a temporary fix.
		    	viewportResized = updateViewportDimensions();
		    	if ( viewport.width > viewportResized.width ) {
		    		ga('send', 'event', 'Window Resize', 'Smaller', viewport.width + 'px to ' + viewportResized.width + 'px');
		    	} else if ( viewport.width < viewportResized.width ) {
		    		ga('send', 'event', 'Window Resize', 'Bigger', viewport.width + 'px to ' + viewportResized.width + 'px');
		    	}
		    	viewport = updateViewportDimensions();
	    	}

		}, 500, "unique resize ID 1");
	});


}); //End Document Ready




jQuery(window).on('load', function() {

	jQuery('a, li, tr').removeClass('hover');
	jQuery('html').addClass('loaded');
	jQuery('.unhideonload').removeClass('hidden');

}); //End Window Load


/*==========================

 Functions

 ===========================*/

//Zebra-striper, First-child/Last-child, Hover helper functions, add "external" rel to outbound links
function helperFunctions(){
	jQuery('li:even, tr:even').addClass('even');
	jQuery('li:odd, tr:odd').addClass('odd');
	jQuery('ul:first-child, li:first-child, tr:first-child').addClass('first-child');
	jQuery('li:last-child, tr:last-child').addClass('last-child');
	jQuery('.column:first-child, .columns:first-child').addClass('first-child');
	jQuery('a:hover, li:hover, tr:hover').addClass('hover');
	jQuery('a').each(function(){
		var a = new RegExp('/' + window.location.host + '/');
		if( !a.test(this.href) ) {
			var rel = ( typeof jQuery(this).attr('rel') !== 'undefined' ? jQuery(this).attr('rel') + ' ' : '' );
			jQuery(this).attr('rel', rel + 'external');
		}
	});
	jQuery('.lte-ie9 .nebulashadow.inner-bottom, .lte-ie9 .nebulashadow.above').hide(); //@TODO "Nebula" 0: Anything we can do here to alleviate the issue? May need to just hide
} //end helperFunctions()


//Create Facebook functions
function facebookSDK() {
	window.fbAsyncInit = function() { //This is called once the Facebook SDK is initialized (from the footer)
		FB.init({
			appId: social['facebook_app_id'],
			channelUrl: bloginfo['template_directory'] + '/includes/channel.php',
			status: true,
			xfbml: true
		});

		window.FBuser = '';
		window.FBstatus = false;
		checkFacebookStatus();

		//Facebook Likes
		FB.Event.subscribe('edge.create', function(href, widget) {
			var currentPage = jQuery(document).attr('title');
			ga('send', {
				'hitType': 'social',
				'socialNetwork': 'Facebook',
				'socialAction': 'Like',
				'socialTarget': href,
				'page': currentPage
			});
			ga('send', 'event', 'Social', 'Facebook Like', {
				'dimension1': 'Like'
			});
		});

		//Facebook Unlikes
		FB.Event.subscribe('edge.remove', function(href, widget) {
			var currentPage = jQuery(document).attr('title');
			ga('send', {
				'hitType': 'social',
				'socialNetwork': 'Facebook',
				'socialAction': 'Unlike',
				'socialTarget': href,
				'page': currentPage
			});
			ga('send', 'event', 'Social', 'Facebook Unlike', {
				'dimension1': 'Unlike'
			});
		});

		//Facebook Send/Share
		FB.Event.subscribe('message.send', function(href, widget) {
			var currentPage = jQuery(document).attr('title');
			ga('send', {
				'hitType': 'social',
				'socialNetwork': 'Facebook',
				'socialAction': 'Send',
				'socialTarget': href,
				'page': currentPage
			});
			ga('send', 'event', 'Social', 'Facebook Share', {
				'dimension1': 'Share'
			});
		});

		//Facebook Comments
		FB.Event.subscribe('comment.create', function(href, widget) {
			var currentPage = jQuery(document).attr('title');
			ga('send', {
				'hitType': 'social',
				'socialNetwork': 'Facebook',
				'socialAction': 'Comment',
				'socialTarget': href,
				'page': currentPage
			});
			ga('send', 'event', 'Social', 'Facebook Comment', {
				'dimension1': 'Comment'
			});
		});
	};

	jQuery(document).on('click', '.facebook-connect', function(){
		facebookLoginLogout();
		return false;
	});

	//Load the SDK asynchronously
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/all.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
}

//Connect to Facebook without using Facebook Login button
function facebookLoginLogout() {
	if ( !FBstatus ) {
		FB.login(function(response) {
			if (response.authResponse) {
				checkFacebookStatus();
				ga('send', 'event', 'Social', 'Facebook Connect', FBuser.name);
			} else {
				if ( typeof Gumby != 'undefined' ) { Gumby.log('User did not accept permissions.'); }
				checkFacebookStatus();
			}
		}, {scope:'public_profile,email'});
	} else {
		FB.logout(function(response) {
			if ( typeof Gumby != 'undefined' ) { Gumby.log('User has logged out.'); }
			checkFacebookStatus();
			prefillFacebookFields();
		});
	}
	return false;
}

//Fetch Facebook user information
function checkFacebookStatus() {
	FB.getLoginStatus(function(response) {
		if ( response.status === 'connected' ) { //User is logged into Facebook and is connected to this app.
			FBstatus = true;
			FB.api('/me', function(response) {
				FBuser = response;
				if ( typeof Gumby != 'undefined' ) { Gumby.log(response.name + ' has connected with this app.'); }
				fbNameClass = response.name.replace(' ', '_');
				jQuery('body').removeClass('fb-disconnected').addClass('fb-connected fb-user-' + fbNameClass);
				prefillFacebookFields(response);
				jQuery('.facebook-connect-con a').text('Logout').removeClass('disconnected').addClass('connected');

				jQuery('#facebook-connect p strong').text('You have been connected to Facebook, ' + response.first_name + '.'); //@TODO "Example" 2: This is an example- remove this line.
				jQuery('.fbpicture').attr('src', 'https://graph.facebook.com/' + response.id + '/picture?width=100&height=100'); //@TODO "Example" 2: This is an example- remove this line.
			});

			jQuery('#facebook-connect p strong').text('You have been connected to Facebook...'); //@TODO "Example" 2: This is an example- remove this line.
		} else if (response.status === 'not_authorized') { //User is logged into Facebook, but has not connected to this app.
			if ( typeof Gumby != 'undefined' ) { Gumby.log('User is logged into Facebook, but has not connected to this app.'); }
			jQuery('body').removeClass('fb-connected').addClass('fb-disconnected');
			FBstatus = false;
			jQuery('.facebook-connect-con a').text('Connect with Facebook').removeClass('connected').addClass('disconnected');

			jQuery('#facebook-connect p strong').text('Please connect to this site by logging in below:'); //@TODO "Example" 2: This is an example- remove this line.
		} else { //User is not logged into Facebook.
			if ( typeof Gumby != 'undefined' ) { Gumby.log('User is not logged into Facebook.'); }
			jQuery('body').removeClass('fb-connected fb-disconnected');
			FBstatus = false;
			jQuery('.facebook-connect-con a').text('Connect with Facebook').removeClass('connected').addClass('disconnected');

			jQuery('#facebook-connect p strong').text('You are not logged into Facebook. Log in below:'); //@TODO "Example" 2: This is an example- remove this line.
		}
	});
}

//Fill or clear form inputs with Facebook data
function prefillFacebookFields(response) {
	if ( response ) {
		jQuery('.fb-form-name, .comment-form-author input, .cform7-name, input.name').each(function(){
			jQuery(this).val(response.first_name + ' ' + response.last_name).trigger('keyup');
		});
		jQuery('.fb-form-first-name, .cform7-first-name, input.first-name').each(function(){
			jQuery(this).val(response.first_name).trigger('keyup');
		});
		jQuery('.fb-form-last-name, .cform7-last-name, input.last-name').each(function(){
			jQuery(this).val(response.last_name).trigger('keyup');
		});
		jQuery('.fb-form-email, .comment-form-email input, .cform7-email, input[type="email"]').each(function(){
			jQuery(this).val(response.email).trigger('keyup');
		});
	} else {
		jQuery('.fb-form-name, .comment-form-author input, .cform7-name, .fb-form-email, .comment-form-email input, input[type="email"]').each(function(){
			jQuery(this).val('').trigger('keyup');
		});
	}
}

//Social sharing buttons
function socialSharing() {
    var loc = window.location;
    var title = jQuery(document).attr('title');
    var encloc = encodeURI(loc);
    var enctitle = encodeURI(title);
    jQuery('.fbshare').attr('href', 'http://www.facebook.com/sharer.php?u=' + encloc + '&t=' + enctitle).attr('target', '_blank');
    jQuery('.twshare').attr('href', 'https://twitter.com/intent/tweet?text=' + enctitle + '&url=' + encloc).attr('target', '_blank');
    jQuery('.gshare').attr('href', 'https://plus.google.com/share?url=' + encloc).attr('target', '_blank');
    jQuery('.lishare').attr('href', 'http://www.linkedin.com/shareArticle?mini=true&url=' + encloc + '&title=' + enctitle).attr('target', '_blank');
    jQuery('.emshare').attr('href', 'mailto:?subject=' + title + '&body=' + loc).attr('target', '_blank');
} //end socialSharing()


//Create an object of the viewport dimensions
function updateViewportDimensions() {
	var w=window, d=document, e=d.documentElement, g=d.getElementsByTagName('body')[0];

	if ( typeof viewport === 'undefined' ) {
		var viewportHistory = 0;
		//console.log('creating viewport History: ' + viewportHistory);
	} else {
		var viewportHistory = viewport.history+1;
		viewport.prevWidth = viewport.width; //Not pushing to the object...
		viewport.prevHeight = viewport.height; //Not pushing to the object...
		//console.log('increasing viewport History: ' + viewportHistory); //Triggering twice on window resize...
	}

	var x = w.innerWidth || e.clientWidth || g.clientWidth;
	var y = w.innerHeight || e.clientHeight || g.clientHeight;

	if ( viewportHistory == 0 ) {
		var viewportObject = {
			initialWidth: x,
			initialHeight: y,
			width: x,
			height: y,
			history: viewportHistory
		};
	} else {
		viewportObject = {
		    initialWidth: viewport.initialWidth,
			initialHeight: viewport.initialHeight,
		    width: x,
		    height: y,
		    history: viewportHistory
		};
	}

	return viewportObject;
}

//Main dropdown nav dynamic width controller
function dropdownWidthController() {
	jQuery('#primarynav .sub-menu').each(function(){
		var bigWidth = 100;
			if ( jQuery(this).children().width() > bigWidth ) {
				bigWidth = jQuery(this).children().width();
			}
		jQuery(this).css('width', bigWidth+15 + 'px');
	});
} //end dropdownWidthController()


//Sub-menu viewport overflow detector
function overflowDetector() {
    jQuery('#primarynav .menu > .menu-item').hover(function(){
    	var viewportWidth = jQuery(window).width();
    	var submenuLeft = jQuery(this).offset().left;
    	var submenuRight = submenuLeft+jQuery(this).children('.sub-menu').width();
    	if (submenuRight > viewportWidth) {
			jQuery(this).children('.sub-menu').css('left', 'auto').css('right', '0');
    	} else {
			jQuery(this).children('.sub-menu').css('left', '0').css('right', 'auto');
    	}
    }, function(){
	    	jQuery(this).children('.sub-menu').css('left', '-9999px').css('right', 'auto');
    });
} //end overflowDetector()


//Vertical subnav expanders
function subnavExpanders() {
    jQuery('.xoxo .menu li.menu-item:has(ul)').append('<a class="toplevelvert_expander plus" href="#"><i class="fa fa-caret-left"></i></a>');
    jQuery('.toplevelvert_expander').parent().children('.sub-menu').hide();
    jQuery(document).on('click', '.toplevelvert_expander', function(){
        jQuery(this).toggleClass('plus').parent().children('.sub-menu').slideToggle();
        return false;
    });
    //Automatically expand subnav to show current page
    jQuery('.current-menu-ancestor').children('.toplevelvert_expander').click();
    jQuery('.current-menu-item').children('.toplevelvert_expander').click();
} //end subnavExpanders()


//Show fixed bar when scrolling passed a particular element
function nebulaFixeder() {
	var fixedAfterSelector = '#logonavcon img'; //@TODO "Header" 3: Verify this selector is correct to trigger the fixed header.
	if ( jQuery(fixedAfterSelector).is('*') ) {
		jQuery(window).on('scroll resize', function() {
			if ( !jQuery('.mobilenavcon').is(':visible') && !jQuery('.nobar').is('*') ) {
				var fixedBarBottom = jQuery(fixedAfterSelector).position().top + jQuery(fixedAfterSelector).outerHeight();
		        var windowBottom = jQuery(window).scrollTop();

		        if( windowBottom > fixedBarBottom ){
		        	if ( !jQuery('.fixedbar').hasClass('active') ) {
			        	jQuery('.fixedbar').addClass('active');
					}
		        } else {
		        	if ( !jQuery('.fixedbar').hasClass('hidden') ) {
			        	jQuery('.fixedbar').removeClass('active');
		        	}
		        }
			}
		});
	}
} //end nebulaFixeder()


//Google Analytics Universal Analytics Event Trackers
function gaEventTracking(){

	//Example Event Tracker (Category and Action are required. If including a Value, it should be a rational number and not a string. Value could be an object of parameters like {'nonInteraction': 1, 'dimension1': 'Something', 'metric1': 82} Use deferred selectors.)
	//jQuery(document).on('mousedown', '.selector', function(e) {
	//  var intent = ( e.which >= 2 ) ? ' (Intent)' : '';
	//	ga('send', 'event', 'Category', 'Action', 'Label', Value, {'object_name_here': object_value_here}); //Object names include 'hitCallback', 'nonInteraction', and others
	//});

/*
	@TODO "Nebula" 0: Testing other ways to console log GA events. Goal is to not have to write out the cat/action/label twice each time. Can we listen for the ga('send', 'event') and spit out all parameters?
	//Callback test DELETE THIS
	jQuery(document).on('click', "h1", function(){
		console.log('triggering event');
		ga('send', 'event', 'Callback testing', 'this is the actions', 'this is the label', {'hitCallback': function(){
			console.log('test event with callback sent.');
		}});
		return false;
	});
*/


	//External links
	jQuery(document).on('mousedown', "a[rel*='external']", function(e){
		var intent = ( e.which >= 2 ) ? ' (Intent)' : '';
		var linkText = jQuery(this).text();
		var destinationURL = jQuery(this).attr('href');
		ga('send', 'event', 'External Link' + intent, linkText, destinationURL);
	});

	//PDF View/Download
	jQuery(document).on('mousedown', "a[href$='.pdf']", function(){
		var intent = ( e.which >= 2 ) ? ' (Intent)' : '';
		var linkText = jQuery(this).text();
		var fileName = jQuery(this).attr('href');
		fileName = fileName.substr(fileName.lastIndexOf("/")+1);
		if ( linkText == '' || linkText == 'Download') {
			ga('send', 'event', 'PDF View' + intent, 'File: ' + fileName);
		} else {
			ga('send', 'event', 'PDF View' + intent, 'Text: ' + linkText);
		}
	});

	//Contact Form Submissions
	jQuery(document).on('submit', '.wpcf7-form', function() {
		ga('send', 'event', 'Contact', 'Submit', 'Contact Form Submission');
	});

	//Generic Interal Search Tracking
	jQuery(document).on('submit', '.search', function(){
		var searchQuery = jQuery(this).find('input[name="s"]').val();
		ga('send', 'event', 'Internal Search', 'Submit', searchQuery);
	});

	//Mailto link tracking
	jQuery(document).on('mousedown', 'a[href^="mailto"]', function(){
		var intent = ( e.which >= 2 ) ? ' (Intent)' : '';
		var emailAddress = jQuery(this).attr('href').replace('mailto:', '');
		ga('send', 'event', 'Mailto' + intent, 'Email: ' + emailAddress);
	});

	//Telephone link tracking
	jQuery(document).on('mousedown', 'a[href^="tel"]', function(){
		var intent = ( e.which >= 2 ) ? ' (Intent)' : '';
		var phoneNumber = jQuery(this).attr('href');
		phoneNumber = phoneNumber.replace('tel:+', '');
		ga('send', 'event', 'Click-to-Call' + intent, 'Phone Number: ' + phoneNumber);
	});

	//SMS link tracking
	jQuery(document).on('mousedown', 'a[href^="sms"]', function(){
		var intent = ( e.which >= 2 ) ? ' (Intent)' : '';
		var phoneNumber = jQuery(this).attr('href');
		phoneNumber = phoneNumber.replace('sms:+', '');
		ga('send', 'event', 'Click-to-Call' + intent, 'SMS to: ' + phoneNumber);
	});

	//Word copy tracking
	var copyCount = 0;
	var copyOver = 0;
	jQuery(document).on('cut copy', function(){
		copyCount++;
		var words = [];
		var selection = window.getSelection() + '';
		words = selection.split(' ');
		wordsLength = words.length;

		//Track Email or Phone copies as contact intent.
		var emailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var phonePattern = /^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/;
		emailPhone = jQuery.trim(words.join(' '));
		if ( emailPattern.test(emailPhone) ) {
			ga('send', 'event', 'Contact (Intent)', 'Copied email: ' + emailPhone);
		} else if ( phonePattern.test(emailPhone) ) {
			ga('send', 'event', 'Click-to-Call (Intent)', 'Copied phone: ' + emailPhone);
		}

		if ( copyCount < 13 ) {
			if (words.length > 8) {
				words = words.slice(0, 8).join(' ');
				ga('send', 'event', 'Copied Text', words + '... [' + wordsLength + ' words]');
			} else {
				if ( selection == '' || selection == ' ' ) {
					ga('send', 'event', 'Copied Text', '[0 words]');
				} else {
					ga('send', 'event', 'Copied Text', selection);
				}
			}
		} else {
			if ( copyOver == 0 ) {
				ga('send', 'event', 'Copied Text', '[Copy limit reached]');
			}
			copyOver = 1;
		}
	});

	//AJAX Errors
	jQuery(document).ajaxError(function(e, request, settings) {
		ga('send', 'event', 'Error', 'AJAX Error', e.result + ' on: ' + settings.url, {'nonInteraction': 1});
		ga('send', 'exception', e.result, true);
	});


	//Capture Print Intent
	printed = 0;
	var afterPrint = function() {
		if ( printed == 0 ) {
			printed = 1;
			ga('send', 'event', 'Print (Intent)');
		}
	};
	if ( window.matchMedia ) {
		var mediaQueryList = window.matchMedia('print');
		if ( mediaQueryList.addListener ) {
			mediaQueryList.addListener(function(mql) {
				if ( !mql.matches ) {
					afterPrint();
				}
			});
		}
	}
	window.onafterprint = afterPrint;

} //End gaEventTracking()


//Google AdWords conversion tracking for AJAX
function conversionTracker(conversionpage) {
	if ( typeof conversionpage == 'undefined' ) {
		conversionpage = 'thanks.html';
	}

	var  iframe = document.createElement('iframe');
	iframe.style.width = '0px';
	iframe.style.height = '0px';
	document.body.appendChild(iframe);
	iframe.src = bloginfo['template_directory'] + '/includes/conversion/' + conversionpage;
};


function googlePlusCallback(jsonParam) {
	if ( jsonParam.state == 'on' ) {
		ga('send', 'event', 'Social', 'Google+ Like');
	} else if ( jsonParam.state == 'off' ) {
		ga('send', 'event', 'Social', 'Google+ Unlike');
	} else {
		ga('send', 'event', 'Social', 'Google+ [JSON Unavailable]');
	}
}

function mmenus() {
	if ( 'mmenu' in jQuery ) {
		jQuery("#mobilenav").mmenu({
		    //Options
		    offCanvas: {
			    zposition: 'back' //'back' (default), 'front', 'next'
		    },
		    searchfield: { //This is for searching through the menu itself (NOT for site search)
		    	add: true,
		    	search: true,
		    	placeholder: 'Search',
		    	noResults: 'No navigation items found.',
		    	showLinksOnly: false //"true" searches only <a> links, "false" includes spans in search results
		    },
		    counters: true, //Display count of sub-menus
		    classes: "mm-light mm-slide" //Theming and open effects
		}, {
			//Configuration
			classNames: {
				selected: "current-menu-item"
			}
		}).on('opening.mm', function(){ //When mmenu has started opening
			jQuery('a.mobilenavtrigger i').removeClass('fa-bars').addClass('fa-times');
		}).on('opened.mm', function(){ //After mmenu has finished opening
			history.replaceState(null, document.title, location);
			history.pushState(null, document.title, location);
		}).on('closing.mm', function(){ //When mmenu has started closing
			jQuery('a.mobilenavtrigger i').removeClass('fa-times').addClass('fa-bars');
		}).on('closed.mm', function(){ //After mmenu has finished closing
			//Functions after closed.
		});

		jQuery('.mm-search input').wrap('<form method="get" action="' + bloginfo['home_url'] + '"></form>').attr('name', 's');
		jQuery('.mm-search input').on('keyup', function(){
			if ( jQuery(this).val().length > 0 ) {
				jQuery('.clearsearch').removeClass('hidden');
			} else {
				jQuery('.clearsearch').addClass('hidden');
			}
		});
		jQuery('.mm-panel').append('<div class="clearsearch hidden"><strong class="doasitesearch">Press enter to search the site!</strong><br/><a href="#"><i class="fa fa-times-circle"></i>Reset Search</a></div>');
		jQuery(document).on('click', '.clearsearch a', function(){
			jQuery('.mm-search input').val('').keyup();
			jQuery('.clearsearch').addClass('hidden');
			return false;
		});

		//Close mmenu on back button click
		if (window.history && window.history.pushState) {
			window.addEventListener("popstate", function(e) {
				if ( jQuery('html.mm-opened').is('*') ) {
					jQuery(".mm-menu").trigger("close.mm");
					e.stopPropagation();
				}
			}, false);
		}

	}
} //end mmenus()

//Power Footer Width Distributor
function powerFooterWidthDist() {
	var powerFooterWidth = jQuery('#powerfooter').width();
	var topLevelFooterItems = 0;
	jQuery('#powerfooter ul.menu > li').each(function(){
		topLevelFooterItems = topLevelFooterItems+1;
	});
	var footerItemWidth = powerFooterWidth/topLevelFooterItems-8;
	if ( topLevelFooterItems == 0 ) {
		jQuery('.powerfootercon').addClass('hidden');
	} else {
		jQuery('#powerfooter ul.menu > li').css('width', footerItemWidth);
	}
} //end PowerFooterWidthDist


//Menu Search Replacement
function menuSearchReplacement(){
	jQuery('li.nebula-search').html('<form class="search" method="get" action="' + bloginfo['home_url'] + '/"><input type="search" class="input search" name="s" placeholder="Search" x-webkit-speech/></form>');
	jQuery('li.nebula-search input, input.nebula-search').on('focus', function(){
		jQuery(this).addClass('focus active');
	});
	jQuery('li.nebula-search input, input.nebula-search').on('blur', function(){
		if ( jQuery(this).val() == '' || jQuery(this).val().trim().length === 0 ) {
			jQuery(this).removeClass('focus active focusError').attr('placeholder', 'Search');

		} else {
			jQuery(this).removeClass('active');
		}
	});
}




//Page Visibility
function pageVisibility(){
	visFirstHidden = 0;
	visibilityChangeActions();
	jQuery(document).on('visibilitychange', function(){
		visibilityChangeActions();
	});

	function visibilityChangeActions(){
		if ( document.visibilityState == 'prerender' ) { //Page was prerendered
			var pageTitle = jQuery(document).attr('title');
			ga('send', 'event', 'Page Visibility', 'Prerendered', pageTitle, {'nonInteraction': 1});
			//@TODO "Nebula" 0: prevent autoplay of videos
		}

		if ( getPageVisibility() ) { //Page is hidden
			//@TODO "Nebula" 0: pause youtube
			//@TODO "Nebula" 0: pause vimeo
			visFirstHidden = 1;
			visTimerBefore = (new Date()).getTime();
			var pageTitle = jQuery(document).attr('title');
			//ga('send', 'event', 'Page Visibility', 'Hidden', pageTitle, {'nonInteraction': 1}); //@TODO: Page Visibility Hidden event tracking is off by default. Uncomment to enable.
		} else { //Page is visible
			//@TODO "Nebula" 0: resume autoplay of videos
			if ( visFirstHidden == 1 ) {
				var visTimerAfter = (new Date()).getTime();
				var visTimerResult = (visTimerAfter - visTimerBefore)/1000;
				var pageTitle = jQuery(document).attr('title');
				//ga('send', 'event', 'Page Visibility', 'Visible', pageTitle + ' (Hidden for: ' + visTimerResult + 's)', {'nonInteraction': 1}); //@TODO "Nebula" 0: Page Visibility Visible event tracking is off by default. Uncomment to enable.
			}
		}
	}

	function getPageVisibility(){
		if ( typeof document.hidden != "undefined" ) {
			return document.hidden;
		} else {
			return false;
		}
	}
}


//Allows only numerical input on specified inputs. Call this on keyUp? @TODO "Nebula" 0: Make the selector into oThis and pass that to the function from above.
//The nice thing about this is that it shows the number being taken away so it is more user-friendly than a validation option.
function onlyNumbers() {
	jQuery(".leftcolumn input[type='text']").each(function(){
		this.value = this.value.replace(/[^0-9\.]/g, '');
	});
}

function scrollTo() {
	jQuery(document).on('click', 'a[href*=#]:not([href=#])', function() {
		if ( location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname ) {
			var target = jQuery(this.hash);
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			if ( target.length ) {
				var headerHtOffset = jQuery('#topbarcon').height(); //Note: This selector should be the height of the fixed header, or a hard-coded offset.
				var nOffset = Math.floor(target.offset().top - headerHtOffset);
				jQuery('html, body').animate({
					scrollTop: nOffset
				}, 500);
				return false;
			}
		}
	});
}


//Create desktop notifications
function desktopNotification(title, message, clickCallback, closeCallback, showCallback, errorCallback) {
	if ( checkNotificationPermission() ) {
		//Set defaults
		var defaults = {
			dir: "auto", //Direction ["auto", "ltr", "rtl"] (optional)
			lang: "en-US", //Language (optional)
			body: "", //Body message (optional)
			tag: Math.floor(Math.random()*10000)+1, //Unique tag for notification. Prevents repeat notifications of the same tag. (optional)
			icon: bloginfo['template_directory'] + "/images/meta/og-thumb.png" //Thumbnail Icon (optional)
		}

		if ( typeof message === "undefined" ) {
			message = defaults;
			if ( typeof Gumby != 'undefined' ) { Gumby.warn('Warning: message is undefined, using defaults.'); }
		} else if ( typeof message === "string" ) {
			body = message;
			message = defaults;
			message.body = body;
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Note: message is a string, using defaults.'); }
		} else {
			if ( typeof message.dir === "undefined" ) {
				message.dir = defaults.dir;
			}
			if ( typeof message.lang === "undefined" ) {
				message.lang = defaults.lang;
			}
			if ( typeof message.body === "undefined" ) {
				message.body = defaults.lang;
				if ( typeof Gumby != 'undefined' ) { Gumby.warn('Warning: No message body.'); }
			}
			if ( typeof message.tag === "undefined" ) {
				message.tag = defaults.tag;
			}
			if ( typeof message.icon === "undefined" ) {
				message.icon = defaults.icon;
			}
		}

		instance = new Notification(title, message); //Trigger the notification

		if ( typeof clickCallback !== "undefined" ) {
			instance.onclick = function() {
				clickCallback();
			};
		}
		if ( typeof closeCallback !== "undefined" ) {
			instance.onclose = function() {
				closeCallback();
			};
		}
		if ( typeof showCallback !== "undefined" ) {
			instance.onshow = function() {
				showCallback();
			};
		}
		if ( typeof errorCallback !== "undefined" ) {
			instance.onerror = function() {
				errorCallback();
			};
		}
	}
	return false;
}

function checkNotificationPermission() {
	Notification = window.Notification || window.mozNotification || window.webkitNotification;
	if ( !(Notification) ) {
		if ( typeof Gumby != 'undefined' ) { Gumby.warn("This browser does not support desktop notifications."); }
		return false;
	} else if ( Notification.permission === "granted" ) {
		return true;
	} else if ( Notification.permission !== 'denied' ) {
		Notification.requestPermission(function (permission) {
			if( !('permission' in Notification) ) {
				Notification.permission = permission;
			}
			if (permission === "granted") {
				return true;
			}
		});
	}
	return false;
}

function nebulaVibrate(pattern) {
	if ( typeof pattern === 'undefined' ) {
		if ( typeof Gumby != 'undefined' ) { Gumby.warn('Vibration pattern was not provided. Using default.'); }
		pattern = [100, 200, 100, 100, 75, 25, 100, 200, 100, 500, 100, 200, 100, 500];
	} else if ( typeof pattern !== 'object' ) {
		if ( typeof Gumby != 'undefined' ) { Gumby.warn('Vibration pattern is not an object. Using default.'); }
		pattern = [100, 200, 100, 100, 75, 25, 100, 200, 100, 500, 100, 200, 100, 500];
	}
	if ( checkVibration() ) {
		navigator.vibrate(pattern);
	}
	return false;
}

function checkVibration() {
	if ( !jQuery('body').hasClass('mobile') ) {
		if ( typeof Gumby != 'undefined' ) { Gumby.warn("This is not a mobile device, so vibration may not work (even if it declares support)."); }
	}

	Vibration = navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate;
	if ( !(Vibration) ) {
		Gumby.warn("This browser does not support vibration.");
		return false;
	} else {
		return true;
	}
}


//Waits until event (generally resize) finishes before triggering. Call with waitForFinalEvent();
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) {
			uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId]) {
			clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	};
})(); //end waitForFinalEvent()


//Conditional JS Library Loading
//This could be done better I think (also, it runs too late in the stack).
function conditionalJSLoading() {

	//Only load Twitter if Twitter wrapper exists.
	if ( jQuery('#twittercon').is('*') ) {
		jQuery.getScript(bloginfo['template_directory'] + '/js/libs/twitter.js').done(function(){
			twitterFeed();
		}).fail(function(){
			jQuery('#twittercon').css('border', '1px solid red').addClass('hidden');
			ga('send', 'event', 'Error', 'JS Error', 'twitter.js could not be loaded.', {'nonInteraction': 1});
		});
	}

	//Only load bxslider library on a page that calls bxslider.
	if ( jQuery('.bxslider').is('*') ) {
		jQuery.getScript(bloginfo['template_directory'] + '/js/libs/jquery.bxslider.min.js').done(function(){
			bxSlider();
		}).fail(function(){
			ga('send', 'event', 'Error', 'JS Error', 'bxSlider could not be loaded.', {'nonInteraction': 1});
		});
		Modernizr.load(bloginfo['template_directory'] + '/css/jquery.bxslider.css');
	}

	//Only load dataTables library if dataTables table exists.
	if ( jQuery('.dataTables_wrapper').is('*') ) {
		jQuery.getScript(bloginfo['template_directory'] + '/js/libs/jquery.dataTables.min.js').done(function(){ //@TODO "Nebula" 0: Use CDN?
			dataTablesActions();
		}).fail(function(){
			ga('send', 'event', 'Error', 'JS Error', 'jquery.dataTables.min.js could not be loaded', {'nonInteraction': 1});
		});
		Modernizr.load(bloginfo['template_directory'] + '/css/jquery.dataTables.css');

		jQuery.getScript(bloginfo['template_directory'] + '/js/libs/jquery.highlight-4.closure.js').done(function(){
			//Do something
		}).fail(function(){
			ga('send', 'event', 'Error', 'JS Error', 'jquery.highlight-4.closure.js could not be loaded.', {'nonInteraction': 1});
		});
	}

	if ( jQuery('.flag').is('*') ) {
		Modernizr.load(bloginfo['template_directory'] + '/css/flags.css');
	}
} //end conditionalJSLoading()




function dataTablesActions(){
	jQuery(document).on('keyup', '.dataTables_wrapper .dataTables_filter input', function() { //@TODO "Nebula" 0: Something here is eating the first letter after a few have been typed... lol
	    console.log('keyup: ' + jQuery(this).val());
	    jQuery('.dataTables_wrapper').removeHighlight();
	    jQuery('.dataTables_wrapper').highlight(jQuery(this).val());
	});
}

//Twitter Feed integration
function twitterFeed() {
    if ( typeof JQTWEET !== 'undefined' ) {
        JQTWEET = JQTWEET || {};
        //JQTWEET.search = '#hashtag';
        JQTWEET.user = 'pinckneyhugo';
        JQTWEET.numTweets = 3;
        JQTWEET.template = '<div class="row tweetcon"><div class="four columns"><div class="twittericon">{AVA}</div></div><div class="twelve columns"><div class="twitteruser"><a href="{URL}" target="_blank">@{USER}</a></div><div class="twittertweet">{TEXT} <a class="twitterago" href="{URL}" target="_blank">{AGO}</a></div></div></div>',
        JQTWEET.appendTo = '#twitter_update_list';
        JQTWEET.loadTweets();

        console.log('tweets loaded.');
        console.debug(JQTWEET);
    }
} //end twitterFeed()

//Place all bxSlider events inside this function!
function bxSlider() {
	if ( typeof bxSlider !== 'undefined' ) {
		jQuery('.exampleslider').bxSlider({
			mode: 'horizontal', //'horizontal', 'vertical', 'fade'
			speed: 800,
			captions: false,
			auto: true,
			pause: 6000,
			autoHover: true,
			adaptiveHeight: true,
			useCSS: false,
			easing: 'easeInOutCubic',
			controls: false
		});

		jQuery('.heroslider').bxSlider({
			mode: 'fade',
			speed: 800,
			captions: false,
			pager: false,
			auto: false,
			pause: 10000,
			autoHover: true,
			adaptiveHeight: true,
			useCSS: true,
			controls: true
		});
	}
}

function vimeoControls() {
	if ( jQuery('.vimeoplayer').is('*') ) {
        jQuery.getScript(bloginfo['template_directory'] + '/js/libs/froogaloop.min.js').done(function(){
			createVimeoPlayers();
		}).fail(function(){
			if ( typeof Gumby != 'undefined' ) { Gumby.warn('froogaloop.js could not be loaded.'); }
		});
	}

	function createVimeoPlayers() {
		var player = new Array();
	    jQuery('iframe.vimeoplayer').each(function(i){
			var vimeoiframeClass = jQuery(this).attr('id');
			player[i] = $f(vimeoiframeClass);
			player[i].addEvent('ready', function() {
		    	if ( typeof Gumby != 'undefined' ) { Gumby.log('player is ready'); }
			    player[i].addEvent('play', onPlay);
			    player[i].addEvent('pause', onPause);
			    player[i].addEvent('seek', onSeek);
			    player[i].addEvent('finish', onFinish);
			    player[i].addEvent('playProgress', onPlayProgress);
			});
		});
	}

	function onPlay(id) {
	    var videoTitle = id.replace(/-/g, ' ');
	    ga('send', 'event', 'Videos', 'Play', videoTitle);
	}

	function onPause(id) {
	    var videoTitle = id.replace(/-/g, ' ');
	    ga('send', 'event', 'Videos', 'Pause', videoTitle);
	}

	function onSeek(data, id) {
	    var videoTitle = id.replace(/-/g, ' ');
	    ga('send', 'event', 'Videos', 'Seek', videoTitle + ' [to: ' + data.seconds + ']');
	}

	function onFinish(id) {
		var videoTitle = id.replace(/-/g, ' ');
		ga('send', 'event', 'Videos', 'Finished', videoTitle, {'nonInteraction': 1});
	}

	function onPlayProgress(data, id) {
		//if ( typeof Gumby != 'undefined' ) { Gumby.log(data.seconds + 's played'); }
	}
}

//Cookie Management
function createCookie(name, value, days) {
	if ( days ) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires=" + date.toGMTString();
	} else {
		var expires = "";
	}
	document.cookie = name + "=" + value + expires + "; path=/";
	if ( typeof Gumby != 'undefined' ) {
		Gumby.log('Created cookie: ' + name + ', with the value: ' + value + expires);
	}
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for ( var i=0; i<ca.length; i++ ) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) {
				if ( typeof Gumby != 'undefined' ) { Gumby.log('Cookie "' + name + '" exists.'); }
				return c.substring(nameEQ.length, c.length);
			}
		}
	}
	return null;
}
function eraseCookie(name) {
	createCookie(name, "", -1);
	if ( typeof Gumby != 'undefined' ) {
		Gumby.warn('Erased cookie: ' + name);
	}
}



/* ==========================================================================
   Google Maps API v3 Functions
   ========================================================================== */

//Interactive Functions of the Google Map
function mapActions() {
	originalWeatherText = jQuery('.mapweather').text();
	jQuery(document).on('click', '.mapweather', function(){
		if ( mapInfo['weather'] == 1 ) {
			mapInfo['weather'] = 0;
			jQuery('.mapweather').removeClass('active').addClass('inactive').text(originalWeatherText);
			jQuery('.mapweather-icon').removeClass('active').addClass('inactive');
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Disabling weather layer.'); }
		} else {
			mapInfo['weather'] = 1;
			jQuery('.mapweather').addClass('active').removeClass('inactive').text('Disable Weather');
			jQuery('.mapweather-icon').addClass('active').removeClass('inactive');
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Enabling weather layer.'); }
		}
		renderMap(mapInfo);
		return false;
	});

	originalTrafficText = jQuery('.maptraffic').text();
	jQuery(document).on('click', '.maptraffic', function(){
		if ( mapInfo['traffic'] == 1 ) {
			mapInfo['traffic'] = 0;
			jQuery('.maptraffic').removeClass('active').addClass('inactive').text(originalTrafficText);
			jQuery('.maptraffic-icon').removeClass('active').addClass('inactive');
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Disabling traffic layer.'); }
		} else {
			mapInfo['traffic'] = 1;
			jQuery('.maptraffic').addClass('active').removeClass('inactive').text('Disable Traffic');
			jQuery('.maptraffic-icon').addClass('active').removeClass('inactive');
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Enabling traffic layer.'); }
		}
		renderMap(mapInfo);
		return false;
	});

	jQuery(document).on('click', '.mapgeolocation', function(){
		if ( typeof mapInfo['detectLoc'] === 'undefined' || mapInfo['detectLoc'][0] == 0 ) {
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Enabling location detection.'); }
			jQuery('.mapgeolocation-icon').removeClass('inactive fa-location-arrow').addClass('fa-spinner fa-spin');
			jQuery('.mapgeolocation').removeClass('inactive').attr('title', 'Requesting location...').text('Detecting Location...');
			requestPosition();
		} else {
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Removing detected location.'); }
			jQuery('.mapgeolocation-icon').removeClass('fa-spinner fa-ban success error').addClass('inactive fa-location-arrow');
			jQuery(this).removeClass('active success failure').text('Detect Location').addClass('inactive').attr('title', 'Detect current location').css('color', '');
			mapInfo['detectLoc'] = new Array(0, 0);
			renderMap(mapInfo);
		}
		return false;
	});

	jQuery('.mapgeolocation').hover(function(){
		if ( jQuery(this).hasClass('active') ) {
			jQuery('.mapgeolocation-icon').removeClass('fa-location-arrow').addClass('fa-ban');
		}
	}, function(){
		if ( jQuery(this).hasClass('active') ) {
			jQuery('.mapgeolocation-icon').removeClass('fa-ban').addClass('fa-location-arrow');
		}
	});

	originalRefreshText = jQuery('.maprefresh').text();
	pleaseWait = 0;
	jQuery(document).on('click', '.maprefresh', function(){
		if ( !jQuery(this).hasClass('timeout') ) {
			pleaseWait = 0;
			if ( typeof Gumby != 'undefined' ) { Gumby.log('Refreshing the map.'); }
			renderMap(mapInfo);
			jQuery('.maprefresh').addClass('timeout', function(){
				jQuery('.maprefresh').text('Refreshing...');
				jQuery('.maprefresh-icon').removeClass('inactive').addClass('fa-spin');
			});
		} else {
			pleaseWait++;
			if ( pleaseWait < 10 ) {
				jQuery('.maprefresh').text('Please wait...');
			} else {
				jQuery('.maprefresh').text('Hold your horses!');
			}
		}
		return false;
	});

	//Event Listeners

	//Refresh listener
	jQuery(document).on('mapRendered', function(){
		setTimeout(function(){
			jQuery('.maprefresh').addClass('timeout').text('Refreshed!');
			jQuery('.maprefresh-icon').removeClass('fa-refresh fa-spin inactive').addClass('fa-check-circle success');
		}, 500);

		setTimeout(function(){ //Hide the refresh button to prevent spamming it
			jQuery('.maprefresh').removeClass('timeout').text(originalRefreshText);
			jQuery('.maprefresh-icon').removeClass('fa-check-circle success').addClass('fa-refresh inactive');
		}, 10000);
	});

	//Geolocation Success listener
	jQuery(document).on('geolocationSuccess', function(){
		jQuery('.mapgeolocation').text('Location Accuracy: ').append('<span>' + mapInfo['detectLoc']['accMiles'] + ' miles <small>(' + mapInfo['detectLoc']['accMeters'].toFixed(2) + ' meters)</small></span>').find('span').css('color', mapInfo['detectLoc']['accColor']);
		setTimeout(function(){
			jQuery('.mapgeolocation').addClass('active').attr('title', '');
			jQuery('.mapgeolocation-icon').removeClass('fa-spinner fa-spin inactive').addClass('fa-location-arrow');
		}, 500);
	});

	//Geolocation Error listener
	jQuery(document).on('geolocationError', function(){
		jQuery('.mapgeolocation').removeClass('success').text(geolocationErrorMessage);
		setTimeout(function(){
			jQuery('.mapgeolocation').attr('title', '');
			jQuery('.mapgeolocation-icon').removeClass('fa-spinner fa-spin').addClass('fa-location-arrow error');
		}, 500);
	});
} //End mapActions()

//Request Geolocation
function requestPosition() {
	if ( typeof Gumby != 'undefined' ) { Gumby.log('Requesting location... May need to be accepted.'); }
    var nav = null;
    if (nav == null) {
        nav = window.navigator;
    }
    var geoloc = nav.geolocation;
    if (geoloc != null) {
        geoloc.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy: true});
    }
}

//Geolocation Success
function successCallback(position) {
	jQuery('.mapgeolocation').removeClass('failure').addClass('success');

	mapInfo['detectLoc'] = [];
	mapInfo['detectLoc'][0] = position.coords.latitude;
	mapInfo['detectLoc'][1] = position.coords.longitude;
	mapInfo['detectLoc']['accMeters'] = position.coords.accuracy;
	mapInfo['detectLoc']['alt'] = position.coords.altitude;
	mapInfo['detectLoc']['speed'] = position.coords.speed;

	if ( ( mapInfo['detectLoc']['accMeters'] <= 25 ) ) {
		mapInfo['detectLoc']['accColor'] = '#00bb00';
	} else if ( mapInfo['detectLoc']['accMeters'] > 25 && mapInfo['detectLoc']['accMeters'] <= 50 ) {
		mapInfo['detectLoc']['accColor'] = '#46d100';
	} else if ( mapInfo['detectLoc']['accMeters'] > 51 && mapInfo['detectLoc']['accMeters'] <= 150 ) {
		mapInfo['detectLoc']['accColor'] = '#a4ed00';
	} else if ( mapInfo['detectLoc']['accMeters'] > 151 && mapInfo['detectLoc']['accMeters'] <= 400 ) {
		mapInfo['detectLoc']['accColor'] = '#f2ee00';
	} else if ( mapInfo['detectLoc']['accMeters'] > 401 && mapInfo['detectLoc']['accMeters'] <= 800 ) {
		mapInfo['detectLoc']['accColor'] = '#ffc600';
	} else if ( mapInfo['detectLoc']['accMeters'] > 801 && mapInfo['detectLoc']['accMeters'] <= 1500 ) {
		mapInfo['detectLoc']['accColor'] = '#ff6f00';
	} else if ( mapInfo['detectLoc']['accMeters'] > 1501 && mapInfo['detectLoc']['accMeters'] <= 3000 ) {
		mapInfo['detectLoc']['accColor'] = '#ff1900';
	} else if ( mapInfo['detectLoc']['accMeters'] > 3001 ) {
		mapInfo['detectLoc']['accColor'] = '#ff0000';
	} else {
		mapInfo['detectLoc']['accColor'] = '#ff0000';
	}
	renderMap(mapInfo);

	mapInfo['detectLoc']['accMiles'] = (mapInfo['detectLoc']['accMeters']*0.000621371).toFixed(2);

	if ( mapInfo['detectLoc']['accMeters'] > 400 ) {
		lowAccText = 'Your location accuracy is ' + mapInfo['detectLoc']['accMiles'] + ' miles (as shown by the colored radius).';
		if ( typeof Gumby != 'undefined' ) { Gumby.warn('Poor location accuracy: ' + mapInfo['detectLoc']['accMiles'] + ' miles (as shown by the colored radius).'); }
		//Some kind of notification here...
	}

	jQuery(document).trigger('geolocationSuccess');
	//A value in decimal degrees to an precision of 4 decimal places is precise to 11.132 meters at the equator. A value in decimal degrees to 5 decimal places is precise to 1.1132 meter at the equator.

	jQuery('body').addClass('geo-latlng-' + mapInfo['detectLoc'][0] + '_' + mapInfo['detectLoc'][1] + ' geo-acc-' + mapInfo['detectLoc']['accMeters']);

	ga('send', 'event', 'Geolocation', mapInfo['detectLoc'][0].toFixed(4) + ', ' + mapInfo['detectLoc'][1].toFixed(4), 'Accuracy: ' + mapInfo['detectLoc']['accMiles'] + ' meters'); //@TODO "Nebula" 0: Add in actual location detection (from either gearside.com/ip, or Nebula's environment detection example and move this GA reporting to that (with business names in ga action). Maybe consider the Actions to be something like: "LAT, LNG (Business Name, City, State)"
}

//Geolocation Error
function errorCallback(error) {
    geolocationErrorMessage = "";
    // Check for known errors
    switch (error.code) {
        case error.PERMISSION_DENIED:
            geolocationErrorMessage = 'Access to your location is turned off. Change your settings to report location data.';
            break;
        case error.POSITION_UNAVAILABLE:
            geolocationErrorMessage = "Data from location services is currently unavailable.";
            break;
        case error.TIMEOUT:
            geolocationErrorMessage = "Location could not be determined within a specified timeout period.";
            break;
        default:
        	geolocationErrorMessage = "An unknown error has occurred.";
            break;
    }
    if ( typeof Gumby != 'undefined' ) { Gumby.warn(geolocationErrorMessage); }
    jQuery(document).trigger('geolocationError');
    jQuery('body').addClass('geo-error');
    ga('send', 'event', 'Geolocation', 'Error', geolocationErrorMessage, {'nonInteraction': 1});
}

//Retreive Lat/Lng locations
function getAllLocations() {
	mapInfo['markers'] = [];
	jQuery('.latlngcon').each(function(i){
		var alat = jQuery(this).find('.lat').text();
		var alng = jQuery(this).find('.lng').text();
		if ( typeof Gumby != 'undefined' ) { Gumby.log(i + ': found location! lat: ' + alat + ', lng: ' + alng); }
		mapInfo['markers'][i] = [alat, alng];
	});
	renderMap(mapInfo);
}

//Render the Google Map
function renderMap(mapInfo) {
    if ( typeof Gumby != 'undefined' ) { Gumby.log('Rendering Google Map'); }

    if ( typeof google === 'undefined' ) {
    	if ( typeof Gumby != 'undefined' ) { Gumby.log('google is not defined. Likely the Google Maps script is not being seen.'); }
    	return false;
    } else {
    	var myOptions = {
			zoom: 11,
			scrollwheel: false,
			zoomControl: true,
			scaleControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
	    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	    var bounds = new google.maps.LatLngBounds();

		if ( typeof mapInfo['traffic'] !== 'undefined' ) {
			if ( mapInfo['traffic'] == 1 ) {
				if ( typeof Gumby != 'undefined' ) { Gumby.log('Traffic is enabled.'); }
				var trafficLayer = new google.maps.TrafficLayer();
				trafficLayer.setMap(map);
			}
		}

		//Map weather
		if ( typeof mapInfo['weather'] !== 'undefined' ) {
			if ( mapInfo['weather'] == 1 ) {
				if ( typeof Gumby != 'undefined' ) { Gumby.log('Weather is enabled.'); }
				var weatherLayer = new google.maps.weather.WeatherLayer({
					temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT
				});
				weatherLayer.setMap(map);

				var cloudLayer = new google.maps.weather.CloudLayer();
				cloudLayer.setMap(map);
			}
		}


	   	//Hard-Coded Custom Marker
		//http://mt.google.com/vt/icon?psize=27&font=fonts/Roboto-Bold.ttf&color=ff135C13&name=icons/spotlight/spotlight-waypoint-a.png&ax=43&ay=50&text=%E2%80%A2&scale=1
		var phg = new google.maps.LatLng('43.0536608', '-76.1656');
		bounds.extend(phg);
		marker = new google.maps.Marker({
	        position: phg,
	        icon: 'http://mt.google.com/vt/icon?psize=10&font=fonts/Roboto-Bold.ttf&color=ff135C13&name=icons/spotlight/spotlight-waypoint-a.png&ax=43&ay=50&text=PHG&scale=1',
	        clickable: false,
	        map: map
	    });


		//Dynamic Markers (passed from getAllLocations()
		if ( typeof mapInfo['markers'] !== 'undefined' ) {
			var marker, i;
		    for (i = 0; i < mapInfo['markers'].length; i++) {
		        var pos = new google.maps.LatLng(mapInfo['markers'][i][0], mapInfo['markers'][i][1]);
		        bounds.extend(pos);
		        marker = new google.maps.Marker({
		            position: pos,
		            //icon:'../../wp-content/themes/gearside2014/images/map-icon-marker.png', //@TODO "Nebula" 0: It would be cool if these were specific icons for each location. Pull from frontend w/ var?
		            clickable: false,
		            map: map
		        });
		        if ( typeof Gumby != 'undefined' ) { Gumby.log('Marker created for: ' + mapInfo['markers'][i][0] + ', ' + mapInfo['markers'][i][1]); }
		    }(marker, i);
	    }

		//Detected Location Marker
		if ( typeof mapInfo['detectLoc'] !== 'undefined' ) {
			if ( mapInfo['detectLoc'][0] != 0 ) { //Detected location is set
				var detectLoc = new google.maps.LatLng(mapInfo['detectLoc'][0], mapInfo['detectLoc'][1]);
				marker = new google.maps.Marker({
			        position: detectLoc,
			        icon: 'http://mt.google.com/vt/icon?psize=10&font=fonts/Roboto-Bold.ttf&color=ff135C13&name=icons/spotlight/spotlight-waypoint-a.png&ax=43&ay=50&text=%E2%80%A2&scale=1',
			        //animation: google.maps.Animation.DROP,
			        clickable: false,
			        map: map
			    });
			    var circle = new google.maps.Circle({
					strokeColor: mapInfo['detectLoc']['accColor'],
					strokeOpacity: 0.7,
					strokeWeight: 1,
					fillColor: mapInfo['detectLoc']['accColor'],
					fillOpacity: 0.15,
					map: map,
					radius: mapInfo['detectLoc']['accMeters']
				});
				circle.bindTo('center', marker, 'position');
				if ( typeof Gumby != 'undefined' ) { Gumby.log('Marker created for detected location: ' + mapInfo['detectLoc'][0] + ', ' + mapInfo['detectLoc'][1]); }

				//var detectbounds = new google.maps.LatLngBounds();
				bounds.extend(detectLoc);
				//map.fitBounds(detectbounds); //Use this instead of the one below to center on detected location only (ignoring other markers)
			}
		}

		map.fitBounds(bounds);
		google.maps.event.trigger(map, "resize");

		jQuery(document).trigger('mapRendered');
	}
}