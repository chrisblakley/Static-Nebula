<?php include('includes/functions.php'); ?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie ie6 lt-ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class=" <?php echo (array_key_exists('debug', $_GET)) ? 'debug' : ''; ?> <?php //mobile_classes(); ?> no-js "><!--<![endif]-->
	<head>
		
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<meta charset="utf-8">

		<title><?php echo $title = 'PHG Static Nebula'; ?></title>
		
		<meta name="description" content="#" />
		<meta name="keywords" content="#" /><!-- @TODO: Add keywords here. -->
		<meta name="author" content="humans.txt" />
		
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/gumby.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" /> <!-- @TODO: Remove if not using Font Awesome! -->
		<link rel="stylesheet" href="css/jquery.mmenu.all.css" /> <!-- @TODO: Remove if not using mmenu! -->
		<link rel="stylesheet" href="style.css" />
                		
		<link rel="icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png"> <!-- @TODO: Create an apple touch icon 129x129px. -->
		
		<?php global $social; ?>
		
		<!-- Open Graph Metadata -->
		<?php //Check that all Open Graph data is working: https://developers.facebook.com/tools/debug ?>
		<meta property="og:title" content="<?php echo $title; ?>" />
		<meta property="og:url" content="#" />
		<meta property="og:description" content="#" />
		<meta property="og:image" content="images/og-temp.png" /> <!-- @TODO: Create at least one new thumbnail. Minimum Size: 560x560px with a 246px tall safezone in the center. -->
		<meta property="og:image" content="images/og-thumb1.jpg" />
    	<meta property="og:image" content="images/og-thumb2.jpg" />
		<meta property="og:email" content="#" />
		<meta property="og:phone_number" content="" /> <!-- Ex: "+1-315-478-6700" --> <!-- Important: Enter this value as it will be default across the site! @TODO: Make a php variable with this val. -->
		<meta property="og:fax_number" content="" /> <!-- Ex: "+1-315-478-6700" -->
		<meta property="og:latitude" content="" />
		<meta property="og:longitude" content="" />
		<meta property="og:street-address" content="" />
		<meta property="og:locality" content="" /> <!-- City -->
		<meta property="og:region" content="" /> <!-- State -->
		<meta property="og:postal-code" content="" />
		<meta property="og:country-name" content="" /> <!-- USA -->

		<!-- Facebook Metadata -->
		<?php $social['facebook_url'] = 'https://www.facebook.com/PinckneyHugo'; //@TODO: Enter the URL of the Facebook page here. ?>
		<?php $social['facebook_app_id'] = ''; //@TODO: Enter the Facebook App ID here. How to get an App ID: http://smashballoon.com/custom-facebook-feed/access-token/ (Good idea to save the Access Token too!)?>
		<meta property="fb:page_id" content="" /><!-- @TODO: Remove this line if not related to a FB Page. -->
		<meta property="fb:admins" content="" /><!-- @TODO: Comma separated IDs of FB admins. Ex: "1234,2345,3456" -->

		<!-- Google+ Metadata -->
		<?php $social['google_plus_url'] = ''; //@TODO: Enter the URL of the Google+ page here. ?>
		<meta itemprop="name" content="<?php echo $title; ?>" />
		<meta itemprop="description" content="#" />
		<meta itemprop="image" content="images/fb-thumb1.jpg" />

		<!-- Other Social Metadata -->
		<?php $social['twitter_url'] = 'https://twitter.com/pinckneyhugo'; //@TODO: Enter the URL of the Twitter page here. ?>
		<?php $social['linkedin_url'] = ''; //@TODO: Enter the URL of the LinkedIn page here. ?>
		<?php $social['youtube_url'] = ''; //@TODO: Enter the URL of the Youtube page here. ?>

		<!--Microsoft Windows 8 Tiles /-->
		<meta name="application-name" content="<?php echo $title; ?>" />
		<meta name="msapplication-notification" content="frequency=720;polling-uri=http://domain.com/rssfeedlinkhere">
		<meta name="msapplication-TileColor" content="#ffffff" />
		<meta name="msapplication-square70x70logo" content="images/tiny.png" /><!-- 70x70px -->
		<meta name="msapplication-square150x150logo" content="images/square.png" /><!-- 150x150px -->
		<meta name="msapplication-wide310x150logo" content="images/wide.png" /><!-- 310x150px -->
		<meta name="msapplication-square310x310logo" content="images/large.png" /><!-- 310x310px -->

		<script type='text/javascript' src="js/libs/modernizr.custom.42059.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
		
		<!-- Grab Google CDN's jQuery, fall back to local if offline -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.10.1.min.js"><\/script>')</script>
		
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
		
		<script>
			bloginfo = [];
			bloginfo['name'] = "#";
			bloginfo['template_directory'] = "#";
			bloginfo['stylesheet_url'] = "#";
			bloginfo['home_url'] = "#";
			bloginfo['admin_email'] = "#";
			
			social = [];
			social['facebook_url'] = "<?php echo $social['facebook_url']; ?>";
			social['twitter_url'] = "<?php echo $social['twitter_url']; ?>";
			social['google_plus_url'] = "<?php echo $social['google_plus_url']; ?>";
			social['linkedin_url'] = "<?php echo $social['linkedin_url']; ?>";
			social['youtube_url'] = "<?php echo $social['youtube_url']; ?>";
		</script>
		
		<script> //Universal Analytics
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-00000000-1', 'domainnamegoeshere.com'); <?php //@TODO: Don't forget to update the Google Analytics ID in the functions.php file too! ?>
			ga('send', 'pageview');
		</script>

	</head>
	<body>
		<div id="fullbodywrapper">
		
		<?php //Facebook App ID: ###############, Access Token: ######################## ?>
		<div id="fb-root"></div>
		<script type="text/javascript">
			window.fbAsyncInit = function() {
		    //Initialize the Facebook JavaScript SDK
		    FB.init({
		      appId      : '###############', //@TODO: Replace with client's FB App ID!
		      channelUrl : 'includes/channel.html',
		      status     : true,
		      xfbml      : true
		    });
		    							
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
				ga('send', 'event', 'Social', 'Facebook Like', currentPage);
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
				ga('send', 'event', 'Social', 'Facebook Unlike', currentPage);
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
				ga('send', 'event', 'Social', 'Facebook Share', currentPage);
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
				ga('send', 'event', 'Social', 'Facebook Comment', currentPage);
			});
				
		  };
		 
		  //Load the SDK asynchronously
		  (function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/all.js";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
				
		<div id="topbarcon">
			<div class="container mobilenavcon">
				<div class="row">
					<div class="sixteen columns clearfix">
						
						<a class="alignleft" href="#mobilenav"><i class="icon-menu"></i></a>
						<nav id="mobilenav" class="unhideonload hidden">
							<ul class="menu">
							<li class="menu-item">
								<a href="#">First Link Here</a>
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#">First Submenu Link</a>
									</li>
									<li class="menu-item">
										<a href="#">This is a really long name for a subnav link</a>
									</li>
									<li class="menu-item">
										<a href="#">Another submenu</a>
										<ul class="sub-menu">
											<li class="menu-item">
												<a href="#">Join Our Mission</a>
											</li>
											<li class="menu-item">
												<a href="#">This is a really long name for a subnav link</a>
											</li>
										</ul>
									</li>
									<li class="menu-item">
										<a href="#">Third Submenu</a>
									</li>
								</ul>
							</li>
							<li class="menu-item">
								<a href="#">Second Top Level</a>
							</li>
							<li class="menu-item">
								<a href="#">Third Top</a>
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#">Another another sub</a>
									</li>
									<li class="menu-item">
										<a href="#">Aaaand one more</a>
									</li>
								</ul>
							</li>
						</ul>
						</nav><!--/mobilenav-->
						
						
						<a class="alignright" href="#mobilecontact"><i class="icon-users"></i></a>
						<nav id="mobilecontact" class="unhideonload hidden">
							<ul>
					    		<li>
					    			<a href="#"><i class="icon-phone"></i> (315) 123-4567</a>
					    		</li>
					    		<li>
					    			<a href="#"><i class="icon-phone"></i> (800) 456-7890</a>
					    		</li>
					    		<li>
					    			<a href="#"><i class="icon-mail"></i> info@testing.com</a>
					    		</li>
					    		<li>
					    			<a class="directions" href="https://www.google.com/maps/preview?saddr=My+Location&daddr=760+West+Genesee+Street+Syracuse+NY+13204" target="_blank"><i class="icon-direction"></i> Directions <br/><div><small>760 West Genesee Street<br/>Syracuse, NY 13204</small></div></a>
					    		</li>
					    	</ul>
						</nav><!--/mobilecontact-->
						
					</div><!--/columns-->
				</div><!--/row-->
			</div><!--/container-->
		</div><!--/topbarcon-->

		<div class="container topnavcon">
			<div class="row">
				<div class="sixteen columns">
					<nav id="topnav">
	        			<ul class="menu">
							<li class="menu-item">
								<a href="#">First Link Here</a>
							</li>
							<li class="menu-item">
								<a href="#">Second Top Level</a>
							</li>
							<li class="menu-item">
								<a href="#">Third Top</a>
							</li>
						</ul>
	        		</nav>
				</div><!--/columns-->
			</div><!--/row-->
		</div><!--/container-->
		
		
		
		<div id="logonavcon" class="container">
			<div class="row">
				<div class="six columns">
					<?php //@TODO: Logo should have at least two versions: logo.svg and logo.png - Save them out in the images directory then update the paths (and alt text) below. Important: Do not delete the /phg/ directory from the server. We use our logo in the WP Admin, so it needs to remain. ?>
					<a class="logocon" href="/"><img src="images/logo.svg" onerror="this.onerror=null; this.src='images/logo.png'" alt="Pinckney Hugo Group"/></a>
				</div><!--/columns-->
				<div class="ten columns">
					<nav id="mainnav" class="clearfix">
	        			<ul class="menu">
							<li class="menu-item">
								<a href="#">First Link Here</a>
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#">First Submenu Link</a>
									</li>
									<li class="menu-item">
										<a href="#">This is a really long name for a subnav link</a>
									</li>
									<li class="menu-item">
										<a href="#">Another submenu</a>
										<ul class="sub-menu">
											<li class="menu-item">
												<a href="#">Join Our Mission</a>
											</li>
											<li class="menu-item">
												<a href="#">This is a really long name for a subnav link</a>
											</li>
										</ul>
									</li>
									<li class="menu-item">
										<a href="#">Third Submenu</a>
									</li>
								</ul>
							</li>
							<li class="menu-item">
								<a href="#">Second Top Level</a>
							</li>
							<li class="menu-item">
								<a href="#">Third Top</a>
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#">Another another sub</a>
									</li>
									<li class="menu-item">
										<a href="#">Aaaand one more</a>
									</li>
								</ul>
							</li>
						</ul>
	        		</nav>
	        	</div><!--/columns-->
			</div><!--/row-->
		</div><!--/container-->
		
		<div class="container fixedbar" style="position: fixed; top: 0; left: 0; z-index: 9999;">
			<div class="row">
				<div class="three columns">
					<a href="/"><i class="icon-home"></i><?php echo $title; ?></a>
				</div>
			</div>
		</div>
