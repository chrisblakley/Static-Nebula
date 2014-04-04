jQuery.noConflict();

jQuery(document).ready(function() {	

	if ( Object.hasOwnProperty.call(window, "ActiveXObject") && !window.ActiveXObject ) {
		jQuery('html').addClass('ie ie11');
	}

	jQuery("#mobilenav").mmenu({
	    //Options
	    searchfield: { //This is for searching through the menu itself (NOT for site search)
	    	add: true,
	    	search: true,
	    	placeholder: 'Search',
	    	noResults: 'No navigation items found.',
	    	showLinksOnly: false //"true" searches only <a> links, "false" includes spans in search results
	    },
	    counters: true, //Display count of sub-menus
	    classes: "mm-light"
	}, {
		//Configuration
	});
	
	jQuery("#mobilecontact").mmenu({
		//Options
	    position: 'right',
	    classes: "mm-light",
	    header: {
			add: true,
			update: true, //Change the header text when navigating to sub-menus
			title: 'Contact Us'
		}
	}, {
		//Configuration
	});
	
	jQuery('.mm-search input').wrap('<form method="get" action="/"></form>').attr('name', 's');
	jQuery('.mm-search input').on('keyup', function(){
		if ( jQuery(this).val().length > 0 ) {
			jQuery('.clearsearch').removeClass('hidden');
		} else {
			jQuery('.clearsearch').addClass('hidden');
		}
	});
	jQuery('.mm-panel').append('<div class="clearsearch hidden"><strong class="doasitesearch">Press enter to search the site!</strong><br/><a href="#"><i class="icon-cancel-circled"></i>Reset Search</a></div>');
	jQuery('.clearsearch a').on('click', function(){
		jQuery('.mm-search input').val('').keyup();
		jQuery('.clearsearch').addClass('hidden');
		return false;
	});

	//Init Custom Functions
	PowerFooterWidthDist();
	SearchValidator();
	
	//Zebra-striper, First/Last Child, Hover
	jQuery('li:even, tr:even').addClass('even');
	jQuery('li:odd, tr:odd').addClass('odd');
	jQuery('ul:first-child, li:first-child, tr:first-child').addClass('first-child');
	jQuery('li:last-child, tr:last-child').addClass('last-child');
	jQuery('.column:first-child, .columns:first-child').addClass('first-child');
	jQuery('a:hover, li:hover, tr:hover').addClass('hover');
		
	//Social sharing buttons
    var loc = window.location;
    var title = jQuery(document).attr('title');
    var encloc = encodeURI(loc);
    var enctitle = encodeURI(title);
    jQuery('.fbshare').attr('href', 'http://www.facebook.com/sharer.php?u=' + encloc + '&t=' + enctitle).attr('target', '_blank');
    jQuery('.twshare').attr('href', 'https://twitter.com/intent/tweet?text=' + enctitle + '&url=' + encloc).attr('target', '_blank');
    jQuery('.lishare').attr('href', 'http://www.linkedin.com/shareArticle?mini=true&url=' + encloc + '&title=' + enctitle).attr('target', '_blank');
    jQuery('.gshare').attr('href', 'https://plus.google.com/share?url=' + encloc).attr('target', '_blank');
    jQuery('.emshare').attr('href', 'mailto:?subject=' + title + '&body=' + loc).attr('target', '_blank');
    
	//Main dropdown nav dynamic width controller
	jQuery('#mainnav .sub-menu').each(function(){
		var bigWidth = 100;
			if ( jQuery(this).children().width() > bigWidth ) {
				bigWidth = jQuery(this).children().width();
			}
		jQuery(this).css('width', bigWidth+15 + 'px');
	});
    
    //Sub-menu viewport overflow detector
    jQuery('#mainnav .menu > .menu-item').hover(function(){
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
    
    //Vertical subnav expanders
    jQuery('.xoxo .menu li.menu-item:has(ul)').append('<a class="toplevelvert_expander plus" href="#"><i class="icon-left-dir"></i></a>');
    jQuery('.toplevelvert_expander').parent().children('.sub-menu').hide();
    jQuery('.toplevelvert_expander').click(function(){
        jQuery(this).toggleClass('plus').parent().children('.sub-menu').slideToggle();
        return false;
    });
    //Automatically expand subnav to show current page
    jQuery('.current-menu-ancestor').children('.toplevelvert_expander').click();
    jQuery('.current-menu-item').children('.toplevelvert_expander').click();

	
	//Window Resize (Waits for window to finish resizing before triggering.
	jQuery(window).resize(function() {
		waitForFinalEvent(function(){
		
	    	//Window resize functions here.
	    	PowerFooterWidthDist();
	    	
		}, 500, "global window resize"); //String is a unique string that waitForFinalEvent looks for. It can be anything as long as it doesn't conflict with another one being used.
	});
	
	//Show fixed bar when scrolling passed the header	
	jQuery(window).on('scroll resize', function() {
		if ( !jQuery('.mobilenavcon').is(':visible') && !jQuery('.nobar').length ) {
			var fixedBarBottom = jQuery('#logonavcon img').position().top + jQuery('#logonavcon img').outerHeight();
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
	
	/*
//Gumby Modals event trigger
	jQuery.on('gumby.trigger', function(){
		//Modal event trigger functions here.
	})
*/
	
	/*==========================
	 
	 Google Analytics Universal Analytics Event Trackers
	 
	 ===========================*/
	
	//Example Event Tracker (Category and Action are required. If including a Value, it should be a rational number and not a string.)
	//jQuery('.selector').on('click', function() {
	//	ga('send', 'event', 'Category', 'Action', 'Label', Value;
	//});
	
	//Searches
	jQuery('.search').on('submit', function(){
		var searchQuery = jQuery(this).find('input[name="s"]').val();
		ga('send', 'event', 'Internal Search', 'Submit', searchQuery);
	});


}); //End Document Ready

jQuery(window).on('load', function() {

	//Animation and other window load items here.
	jQuery('.unhideonload').removeClass('hidden');

	
	/*==========================
	
	 Conditional JS Library Loading
	 
	 ===========================*/
		
	//Only load Twitter if Twitter wrapper exists.
	if ( jQuery('#twittercon').length ) {
		jQuery.getScript('js/libs/twitter.js').done(function(){
			twitterFeed();
		}).fail(function(){
			console.log('twitter.js could not be loaded.');
			jQuery('#twittercon').css('border', '1px solid red').addClass('hidden');
		});
	}
	//Only load dataTables library if dataTables table exists.
	if ( jQuery('.dataTables_wrapper').length ) {
		jQuery.getScript('js/libs/jquery.dataTables.min.js').done(function(){
		}).fail(function(){
			console.log('jquery.dataTables.min.js could not be loaded.');
		});
		Modernizr.load('css/jquery.dataTables.css');
	}
	
	//Load Gumby UI scripts as needed
	//THIS IS STILL IN THE TESTING PHASE!
		//WE NEED TO DETERMINE: Does this work? Is it easier than uncommenting <script> calls in the footer? Is it slower than using links?
	if ( jQuery('.tab-nav').length ) {
		jQuery.getScript('js/libs/ui/gumby.tabs.js').done(function(){
			//Success
		}).fail(function(){
			console.log('gumby.tabs.js could not be loaded.');
		});
	}
	
	
}); //End Window Load


/*==========================
 
 Functions
 
 ===========================*/

//Power Footer Width Distributor
function PowerFooterWidthDist() {
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
} //End PowerFooterWidthDist

//Search Validator
function SearchValidator() {
	jQuery('.lt-ie9 form.search .btn.submit').val('Search');
	jQuery('.input.search').each(function(){
		if ( jQuery(this).val() == '' || jQuery(this).val().trim().length === 0 ) {
			jQuery(this).parent().children('.btn.submit').addClass('disallowed');		
		} else {
			jQuery(this).parent().children('.btn.submit').removeClass('disallowed').val('Search');
			jQuery(this).parent().find('.input.search').removeClass('focusError');
		}
	});
	jQuery('.input.search').bind('focus blur change keyup paste cut',function(e){
		if ( jQuery(this).val() == '' || jQuery(this).val().trim().length === 0 ) {
			jQuery(this).parent().children('.btn.submit').addClass('disallowed');
			jQuery(this).parent().find('.btn.submit').val('Go');
		} else {
			jQuery(this).parent().children('.btn.submit').removeClass('disallowed');
			jQuery(this).parent().find('.input.search').removeClass('focusError').prop('title', '').attr('placeholder', 'Search');
			jQuery(this).parent().find('.btn.submit').prop('title', '').removeClass('notallowed').val('Search');
		}
		if(e.type == 'paste'){
			jQuery(this).parent().children('.btn.submit').removeClass('disallowed');
			jQuery(this).parent().find('.input.search').prop('title', '').attr('placeholder', 'Search').removeClass('focusError');
			jQuery(this).parent().find('.btn.submit').prop('title', '').removeClass('notallowed').val('Search');
		}
	})
	jQuery('form.search').submit(function(){
		if ( jQuery(this).find('.input.search').val() == '' || jQuery(this).find('.input.search').val().trim().length === 0 ) {
			jQuery(this).parent().find('.input.search').prop('title', 'Enter a valid search term.').attr('placeholder', 'Enter a valid search term').addClass('focusError').focus().attr('value', '');
			jQuery(this).parent().find('.btn.submit').prop('title', 'Enter a valid search term.').addClass('notallowed');
			return false;
		} else {
			return true;
		}
	});
} //End searchValidator


//Allows only numerical input on specified inputs. Call this on keyUp? @TODO: Make the selector into oThis and pass that to the function from above.
//The nice thing about this is that it shows the number being taken away so it is more user-friendly than a validation option.
function onlyNumbers() {
	jQuery(".leftcolumn input[type='text']").each(function(){
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
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
})();

//Twitter Feed integration
function twitterFeed(){
    if(jQuery('.twitter-feed').length){
        JQTWEET = JQTWEET || {};
        //JQTWEET.search = '#hashtag';
        JQTWEET.user = 'pinckneyhugo';
        JQTWEET.numTweets = 3;
        JQTWEET.template = '<div class="row tweetcon"><div class="four columns"><div class="twittericon">{AVA}</div></div><div class="twelve columns"><div class="twitteruser"><a href="{URL}" target="_blank">@{USER}</a></div><div class="twittertweet">{TEXT} <a class="twitterago" href="{URL}" target="_blank">{AGO}</a></div></div></div>',
        JQTWEET.appendTo = '#twitter_update_list';
        JQTWEET.loadTweets();
    }
}