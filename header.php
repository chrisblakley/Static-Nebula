<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie ie6 lt-ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class=" <?php echo ($GLOBALS["debug"]) ? 'debug' : ' '; ?> <?php mobile_classes(); ?> no-js "><!--<![endif]-->
	<head>
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<meta charset="utf-8">

		<title><?php echo $pageTitle = 'Home' . ' - ' . $GLOBALS['bloginfo']['name']; ?></title>

		<meta name="description" content="<?php echo $GLOBALS['meta']['description'] = 'Web Development Template'; ?>" />
		<meta name="keywords" content="<?php echo $GLOBALS['meta']['keywords'] = '#'; ?>" />
		<meta name="author" content="humans.txt" />

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

		<link rel="profile" href="http://gmpg.org/xfn/11" />

		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,700" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css" />
		<link rel="stylesheet" href="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/css/gumby.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/4.3.2/css/jquery.mmenu.all.min.css" /> <!-- @TODO: Remove if not using mmenu! -->
		<link rel="stylesheet" href="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/style.css" />

		<link rel="icon" href="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/favicon.ico">
		<link rel="apple-touch-icon" href="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/apple-touch-icon.png"> <!-- @TODO: Create an apple touch icon 129x129px. -->

		<!-- Open Graph Metadata -->
		<?php //Check that all Open Graph data is working: https://developers.facebook.com/tools/debug ?>
		<meta property="og:type" content="business.business" />
		<meta property="og:title" content="<?php echo $GLOBALS['bloginfo']['name']; ?>" />
		<meta property="og:url" content="<?php echo $GLOBALS['bloginfo']['permalink']; ?>" />
		<meta property="og:description" content="<?php echo $GLOBALS['meta']['description']; ?>" />
		<!-- @TODO: Create at least one OG Thumbnail. Minimum Size: 560x560px with a 246px tall safezone in the center. Use og-temp.png as a template (Use PNG to avoid compression artifacts!). -->
		<meta property="og:image" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/og-thumb.png" />
    		<meta property="og:image" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/og-thumb2.png" />
		<meta property="business:contact_data:website" content="<?php echo $GLOBALS['bloginfo']['home_url']; ?>" />
		<meta property="business:contact_data:email" content="<?php echo $GLOBALS['bloginfo']['admin_email']; ?>" />
		<meta property="business:contact_data:phone_number" content="+<?php echo $GLOBALS['info']['phone'] = '1-315-478-6700'; ?>" /> <!-- Ex: "1-315-478-6700" -->
		<meta property="business:contact_data:fax_number" content="+<?php echo $GLOBALS['info']['fax'] = '1-315-426-1392'; ?>" /> <!-- Ex: "1-315-478-6700" -->
		<meta property="business:contact_data:street_address" content="<?php echo $GLOBALS['info']['street_address'] = '760 West Genesee Street'; ?>" />
		<meta property="business:contact_data:locality" content="<?php echo $GLOBALS['info']['locality'] = 'Syracuse'; ?>" /> <!-- City -->
		<meta property="business:contact_data:region" content="<?php echo $GLOBALS['info']['region'] = 'NY'; ?>" /> <!-- State -->
		<meta property="business:contact_data:postal_code" content="<?php echo $GLOBALS['info']['postal_code'] = '13204'; ?>" />
		<meta property="business:contact_data:country_name" content="<?php echo $GLOBALS['info']['country'] = 'USA'; ?>" /> <!-- USA -->
		<meta property="place:location:latitude" content="<?php echo $GLOBALS['info']['latitude'] = ''; ?>" />
		<meta property="place:location:longitude" content="<?php echo $GLOBALS['info']['longitude'] = ''; ?>" />
		<?php
			$GLOBALS['info']['full_address'] = $GLOBALS['info']['street_address'] . ', ' . $GLOBALS['info']['locality'] . ', ' . $GLOBALS['info']['region'] . ' ' . $GLOBALS['info']['postal_code'];
			$GLOBALS['info']['enc_address'] = str_replace(array(' ', ','), array('+', ''), $GLOBALS['info']['full_address']);
		?>

		<?php //Business hours of operation. Times should be in the format "5:30 pm" or "17:30". ?>
		<meta property="business:hours:day" content="sunday" />
		<meta property="business:hours:start" content="11:00 am" />
		<meta property="business:hours:end" content="6:00 pm" />

		<meta property="business:hours:day" content="monday" />
		<meta property="business:hours:start" content="10:00 am" />
		<meta property="business:hours:end" content="9:30 pm" />

		<meta property="business:hours:day" content="tuesday" />
		<meta property="business:hours:start" content="10:00 am" />
		<meta property="business:hours:end" content="9:30 pm" />

		<meta property="business:hours:day" content="wednesday" />
		<meta property="business:hours:start" content="10:00 am" />
		<meta property="business:hours:end" content="9:30 pm" />

		<meta property="business:hours:day" content="thursday" />
		<meta property="business:hours:start" content="10:00 am" />
		<meta property="business:hours:end" content="9:30 pm" />

		<meta property="business:hours:day" content="friday" />
		<meta property="business:hours:start" content="10:00 am" />
		<meta property="business:hours:end" content="9:30 pm" />

		<meta property="business:hours:day" content="saturday" />
		<meta property="business:hours:start" content="10:00 am" />
		<meta property="business:hours:end" content="9:30 pm" />


		<!-- Facebook Metadata -->
		<?php $GLOBALS['social']['facebook_url'] = 'https://www.facebook.com/PinckneyHugo'; //@TODO: Enter the URL of the Facebook page here. ?>
		<?php $GLOBALS['social']['facebook_app_id'] = '0000000000000'; //@TODO: Enter Facebook App ID. Instructions: http://smashballoon.com/custom-facebook-feed/access-token/ ?>
		<?php $GLOBALS['social']['facebook_access_token'] = '00000000000000|00000000000000000000000000'; //@TODO: Enter Facebook Access Token. This only stored in PHP for reference. Do NOT share or store in browser-facing code. ?>
		<meta property="fb:page_id" content="" /><!-- @TODO: Remove this line if not related to a FB Page. -->
		<meta property="fb:admins" content="" /><!-- @TODO: Comma separated IDs of FB admins. Ex: "1234,2345,3456" -->

		<!-- Google+ Metadata -->
		<?php $GLOBALS['social']['google_plus_url'] = ''; //@TODO: Enter the URL of the Google+ page here. ?>
		<meta itemprop="name" content="<?php echo $GLOBALS['bloginfo']['name']; ?>" />
		<meta itemprop="description" content="<?php echo $GLOBALS['meta']['description']; ?>" />
		<meta itemprop="image" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/og-thumb1.png" />

		<!-- Other Social Metadata -->
		<?php $GLOBALS['social']['twitter_url'] = 'https://twitter.com/pinckneyhugo'; //@TODO: Enter the URL of the Twitter page here. ?>
		<?php $GLOBALS['social']['linkedin_url'] = ''; //@TODO: Enter the URL of the LinkedIn page here. ?>
		<?php $GLOBALS['social']['youtube_url'] = ''; //@TODO: Enter the URL of the Youtube page here. ?>
		<?php $GLOBALS['social']['instagram_url'] = ''; //@TODO: Enter the URL of the Instagram page here. ?>

		<!--Microsoft Windows 8 Tiles /-->
		<meta name="application-name" content="<?php echo $GLOBALS['bloginfo']['name']; ?>" />
		<meta name="msapplication-TileColor" content="#ffffff" />
		<meta name="msapplication-square70x70logo" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/tiny.png" /><!-- 70x70px -->
		<meta name="msapplication-square150x150logo" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/square.png" /><!-- 150x150px -->
		<meta name="msapplication-wide310x150logo" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/wide.png" /><!-- 310x150px -->
		<meta name="msapplication-square310x310logo" content="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/large.png" /><!-- 310x310px -->

		<script>
			clientinfo = [];
			clientinfo["remote_addr"] = "<?php $_SERVER['REMOTE_ADDR']; ?>";

			bloginfo = [];
			bloginfo["name"] = "<?php echo $GLOBALS['bloginfo']['name']; ?>";
			bloginfo["template_directory"] = "<?php echo $GLOBALS['bloginfo']['template_directory']; ?>";
			bloginfo["stylesheet_url"] = "<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/style.css";
			bloginfo["home_url"] = "<?php echo $GLOBALS['bloginfo']['home_url']; ?>";
			bloginfo["admin_email"] = "<?php echo $GLOBALS['bloginfo']['admin_email']; ?>";

			social = [];
			social['facebook_url'] = "<?php echo $GLOBALS['social']['facebook_url']; ?>";
			social['facebook_app_id'] = "<?php echo $GLOBALS['social']['facebook_app_id']; ?>";
			social['twitter_url'] = "<?php echo $GLOBALS['social']['twitter_url']; ?>";
			social['google_plus_url'] = "<?php echo $GLOBALS['social']['google_plus_url']; ?>";
			social['linkedin_url'] = "<?php echo $GLOBALS['social']['linkedin_url']; ?>";
			social['youtube_url'] = "<?php echo $GLOBALS['social']['youtube_url']; ?>";
			social['instagram_url'] = "<?php echo $GLOBALS['social']['instagram_url']; ?>";
		</script>

		<!-- Grab Google CDN's jQuery, fall back to local if offline -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.10.1.min.js"><\/script>')</script>

		<script type='text/javascript' src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/modernizr.custom.64172.js"></script>
		<?php //<script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js"></script> ?>

		<?php if ( 1==2 ) : //If page that uses Google Maps ?>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
		<?php endif; ?>

		<!--[if lt IE 9]>
			<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script> //Universal Analytics
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo $GLOBALS['ga']; ?>', 'auto'); <?php //@TODO: Change Tracking ID in functions.php! ?>
			ga('send', 'pageview');
		</script>

		<script type="text/javascript">
			window.addEventListener('error', function(e) {
				if ( e.lineno != 0 ) {
					ga('send', 'event', 'Error', 'JavaScript Error', e.message + ' in: ' + e.filename + ' on line ' + e.lineno);
					ga('send', 'exception', e.message, false);
				}
			});
		</script>
	</head>

	<body>
		<div id="fullbodywrapper">

		<div id="fb-root"></div>

		<noscript>
			<iframe class="hidden" src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/includes/no-js.php?h=<?php echo $GLOBALS['bloginfo']['home_url']; ?>&p=<?php echo $GLOBALS['bloginfo']['permalink']; ?>&t=<?php echo $pageTitle; ?>" width="0" height="0" style="display:none;position:absolute;"></iframe>
		</noscript>

		<div id="topbarcon">
			<div class="row mobilenavcon">
				<div class="sixteen columns clearfix">

					<a class="alignleft" href="#mobilenav"><i class="icon-menu"></i></a>
					<nav id="mobilenav">
						<ul class="menu">
							<li class="menu-item">
								<a href="#">Lorem Ipsum</a>
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#">Cras Quis Nunc</a>
									</li>
									<li class="menu-item">
										<a href="#">Feugiat Sit</a>
									</li>
								</ul>
							</li>
							<li class="menu-item">
								<a href="#">Scelerisque</a>
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#">Eget Tincidunt </a>
									</li>
									<li class="menu-item">
										<a href="#">Donec Nec</a>
									</li>
									<li class="menu-item">
										<a href="#">Semper Lorem Ut</a>
									</li>
									<li class="menu-item">
										<a href="#">Posuere Orci</a>
									</li>
									<li class="menu-item">
										<a href="#">Commodo</a>
									</li>
								</ul>
							</li>
							<li class="icon menu-item">
								<a target="_blank" href="https://github.com/chrisblakley/Static-Nebula/archive/master.zip">Download</a>
							</li>
						</ul>
					</nav><!--/mobilenav-->

					<a class="alignright" href="#mobilecontact"><i class="icon-users"></i></a>
					<nav id="mobilecontact" class="unhideonload hidden">
						<ul>
				    		<li>
				    			<a href="tel:<?php echo nebula_phone_format($GLOBALS['info']['phone'], 'tel'); ?>"><i class="icon-phone"></i> <?php echo nebula_phone_format($GLOBALS['info']['phone'], 'human'); ?></a>
				    		</li>
				    		<li>
				    			<a href="mailto:<?php echo $GLOBALS['bloginfo']['admin_email']; ?>" target="_blank"><i class="icon-mail"></i> <?php echo $GLOBALS['bloginfo']['admin_email']; ?></a>
				    		</li>
				    		<li>
				    			<a class="directions" href="https://www.google.com/maps/dir/Current+Location/<?php echo $GLOBALS['info']['enc_address']; ?>" target="_blank"><i class="icon-direction"></i> Directions<br/><div><small><?php echo $GLOBALS['info']['full_address']; //@TODO: Add address here (x2). ?></small></div></a>
				    		</li>
				    	</ul>
					</nav><!--/mobilecontact-->

				</div><!--/columns-->
			</div><!--/row-->
		</div><!--/topbarcon-->

		<div class="row topnavcon">
			<div class="sixteen columns">
				<nav id="topnav">
        			<ul class="menu">
        				<li class="w3tc menu-item">
        					<a target="_blank" href="http://developers.google.com/speed/pagespeed/insights/?url=http://gearside.com/nebula/Static-Nebula-master/">PageSpeed</a>
							<ul class="sub-menu">
								<li class="menu-item">
									<a target="_blank" href="http://tools.pingdom.com/fpt/#!/cdSLLn/http://gearside.com/nebula/Static-Nebula-master/">Pingdom</a>
								</li>
								<li class="menu-item">
									<a target="_blank" href="http://gtmetrix.com/">GTmetrix</a>
								</li>
								<li class="menu-item">
									<a target="_blank" href="http://www.webpagetest.org/">WebPageTest</a>
								</li>
							</ul>
						</li>
						<li class="menu-item">
							<a target="_blank" href="https://github.com/chrisblakley/Static-Nebula">GitHub</a>
						</li>
						<li class="menu-item">
							<a target="_blank" href="https://github.com/chrisblakley/Static-Nebula/commits/master">Changelog</a>
						</li>
						<li class="menu-item">
							<a target="_blank" href="https://github.com/chrisblakley/Static-Nebula/issues?direction=desc&amp;page=1&amp;sort=updated&amp;state=open">Issues</a>
						</li>
						<li class="menu-item">
							<a target="_blank" href="http://gearside.com/nebula/">Wordpress Nebula</a>
						</li>
						<li class="nebula-search menu-item">
							<form class="search" method="get" action="http://gearside.com/nebula/">
								<input type="search" class="input search" name="s" placeholder="Search" x-webkit-speech="x-webkit-speech">
							</form>
						</li>
					</ul>
				</nav>
			</div><!--/columns-->
		</div><!--/row-->

		<div id="logonavcon" class="row">
			<div class="six columns">
				<?php
					//@TODO: Logo should have at least two versions: logo.svg and logo.png - Save them out in the images directory then update the paths below.
					//Important: Do not delete the /phg/ directory from the server; we use our logo in the WP Admin!
				?>
				<a class="logocon" href="<?php echo $GLOBALS['bloginfo']['home_url']; ?>">
					<img src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/logo.svg" onerror="this.onerror=null; this.src='<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/images/logo.png'" alt="<?php echo $GLOBALS['bloginfo']['name']; ?>"/>
				</a>
			</div><!--/columns-->
			<div class="ten columns">
				<nav id="primarynav" class="clearfix">
					<ul class="menu">
						<li class="menu-item">
							<a href="page.php">Page Template</a>
							<ul class="sub-menu">
								<li class="menu-item">
									<a href="tpl-fullwidth.php">Full Width</a>
								</li>
								<li class="menu-item">
									<a href="#">Feugiat Sit</a>
								</li>
							</ul>
						</li>
						<li class="menu-item">
							<a href="#">Scelerisque</a>
							<ul class="sub-menu">
								<li class="menu-item">
									<a href="#">Eget Tincidunt </a>
								</li>
								<li class="menu-item">
									<a href="#">Donec Nec</a>
								</li>
								<li class="menu-item">
									<a href="#">Semper Lorem Ut</a>
								</li>
								<li class="menu-item">
									<a href="#">Posuere Orci</a>
								</li>
								<li class="menu-item">
									<a href="#">Commodo</a>
								</li>
							</ul>
						</li>
						<li class="icon menu-item">
							<a target="_blank" href="https://github.com/chrisblakley/Static-Nebula/archive/master.zip">Download</a>
						</li>
					</ul>
				</nav>
        	</div><!--/columns-->
		</div><!--/row-->

		<div class="container fixedbar" style="position: fixed; top: 0; left: 0; z-index: 9999;">
			<div class="row">
				<div class="four columns">
					<a href="<?php echo $GLOBALS['bloginfo']['home_url']; ?>"><i class="icon-home"></i> <?php echo $GLOBALS['bloginfo']['name']; ?></a>
				</div><!--/columns-->
				<div class="twelve columns">
					<nav id="fixednav">
						<ul class="menu">
						<li class="menu-item">
							<a href="#">Lorem Ipsum</a>
							<ul class="sub-menu">
								<li class="menu-item">
									<a href="#">Cras Quis Nunc</a>
								</li>
								<li class="menu-item">
									<a href="#">Feugiat Sit</a>
								</li>
							</ul>
						</li>
						<li class="menu-item">
							<a href="#">Scelerisque</a>
							<ul class="sub-menu">
								<li class="menu-item">
									<a href="#">Eget Tincidunt </a>
								</li>
								<li class="menu-item">
									<a href="#">Donec Nec</a>
								</li>
								<li class="menu-item">
									<a href="#">Semper Lorem Ut</a>
								</li>
								<li class="menu-item">
									<a href="#">Posuere Orci</a>
								</li>
								<li class="menu-item">
									<a href="#">Commodo</a>
								</li>
							</ul>
						</li>
						<li class="icon menu-item">
							<a target="_blank" href="https://github.com/chrisblakley/Static-Nebula/archive/master.zip">Download</a>
						</li>
					</ul>
	        		</nav>
				</div><!--/columns-->
			</div><!--/row-->
		</div><!--/container-->
