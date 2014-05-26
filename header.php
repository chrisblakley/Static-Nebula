<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie ie6 lt-ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie ie9 lte-ie9 lt-ie10"><![endif]-->

<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
	<head>
		
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<meta charset="utf-8">

		<title><?php echo $title = 'PHG Static Nebula'; ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/gumby.css">
		<link rel="stylesheet" href="css/font-awesome.min.css"> <!-- @TODO: Remove if not using Font Awesome! -->
		<link rel="stylesheet" href="css/jquery.mmenu.all.css" />
		<link rel="stylesheet" href="style.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
		<meta name="author" content="/humans.txt">
		
		<!-- Facebook Metadata -->
		<meta property="fb:page_id" content="" />
		<meta property="og:image" content="" />
		<meta property="og:description" content=""/>
		<meta property="og:title" content="<?php echo $title; ?>"/>
		<meta property="og:image" content="/images/fb-thumb1.jpg"/> <!-- @TODO: Create at least one new Facebook Thumbnail: 200x200px -->
	    <meta property="og:image" content="/images/fb-thumb2.jpg"/>
		
		<!-- Google+ Metadata -->
		<meta itemprop="name" content="<?php echo $title; ?>">
		<meta itemprop="description" content="">
		<meta itemprop="image" content="">
		
		<!--Microsoft Windows 8 Tiles /-->
		<meta name="application-name" content="<?php echo $title; ?>"/>
		<meta name="msapplication-TileColor" content="#ffffff"/>
		<meta name="msapplication-square70x70logo" content="images/tiny.png"/><!--128x128-->
		<meta name="msapplication-square150x150logo" content="images/square.png"/><!--270x270-->
		<meta name="msapplication-wide310x150logo" content="images/wide.png"/><!--558x270-->
		<meta name="msapplication-square310x310logo" content="images/large.png"/><!--517x516-->

		<script type='text/javascript' src="js/libs/modernizr.custom.42059.js"></script>
	</head>
	<body>
		<div id="fullbodywrapper">
		
		<?php include('includes/functions.php'); ?>
		
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
