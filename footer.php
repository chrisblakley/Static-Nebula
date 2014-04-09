<div class="container footerlinks">
	<div class="row powerfootercon">
		<div class="sixteen columns">
			<p>This is the power footer. Simply change the menu array and the CSS/JS does the rest.</p>
			<nav id="powerfooter">
				<ul>
					<li>Footer Item</li>
					<li>Footer Item</li>
					<li>Footer Item</li>
					<li>Footer Item</li>
				</ul>
			</nav>
		</div><!--/columns-->
	</div><!--/row-->
	<div class="row">
		<div class="ten columns copyright">
			<p>
				<?php date("Y"); ?> &copy; <a href="/"><strong><?php echo $title; ?></strong></a>, all rights reserved.<br/>
				<a href="https://www.google.com/maps/preview?saddr=My+Location&daddr=760+West+Genesee+Street+Syracuse+NY+13204">760 West Genesee Street, Syracuse, NY 13204</a>
			</p>
		</div><!--/columns-->
		<div class="five columns push_one">
			<form class="search" method="get" action="/">
				<ul>
					<li class="append field">
					    <input class="xwide text input search" type="text" name="s" placeholder="Search" />
					    <input type="submit" class="medium primary btn submit" value="Go" />
				    </li>
				</ul>
			</form><!--/search-->
		</div><!--/columns-->
	</div><!--/row-->
</div><!--/container-->

		<!--
<script>
		window.twttr = (function (d,s,id) {
		  var t, js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
		  js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
		  return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
		}(document, "script", "twitter-wjs"));
		
		twttr.ready(function (twttr) {
			twttr.events.bind('tweet', track_tweet);
			twttr.events.bind('follow', track_follow);
		});
		
		//Tweets
		function track_tweet( event ) {
		  if ( event ) {
		    var href = jQuery(location).attr('href');
		    var pageTitle = jQuery(document).attr('title');
		    ga('send', {
		      'hitType': 'social',
		      'socialNetwork': 'Twitter',
		      'socialAction': 'Tweet',
		      'socialTarget': href,
			  'page': pageTitle
			});
			ga('send', 'event', 'Social', 'Twitter Tweet', pageTitle);
		  }
		}
		
		//Follows
		function track_follow( event ) {
		  if ( event ) {
		    var href = jQuery(location).attr('href');
		    var pageTitle = jQuery(document).attr('title');
		    ga('send', {
		      'hitType': 'social',
		      'socialNetwork': 'Twitter',
		      'socialAction': 'Follow',
		      'socialTarget': href,
			  'page': pageTitle
		    });
		    ga('send', 'event', 'Social', 'Twitter Follow', pageTitle);
		  }
		}
		</script>
-->
		
		<script type="text/javascript">
			try {
				(function() {
					var afterPrint = function() {
						ga('send', 'event', 'Print Intent', document.location.pathname);
					};
					if (window.matchMedia) {
						var mediaQueryList = window.matchMedia('print');
						mediaQueryList.addListener(function(mql) {
							if (!mql.matches)
							afterPrint();
						});
					}
					window.onafterprint = afterPrint;
				}());
			} catch(e) {}
		</script>
		
		<script> //Universal Analytics
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-00000000-1', 'domainnamegoeshere.com');
		  ga('send', 'pageview');
		</script>
		
		<!-- Grab Google CDN's jQuery, fall back to local if offline -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.9.1.min.js"><\/script>')</script>
		
		<?php if ( array_key_exists('debug', $_GET) ) : ?>
		
			<script src="js/libs/jquery.mmenu.min.all.js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
			<script src="js/libs/supplementr.js"></script>
			<script src="js/libs/cssbs.js"></script>
			<script src="js/libs/gumby.js"></script>
				
				<script src="js/libs/respond.js"></script>
				
			<script src="js/libs/gumby.init.js"></script>
			<script src="js/libs/plugins.js"></script>		
			<script src="js/main.js"></script>
					
		<?php else : ?>
		
			<script src="js/libs/jquery.mmenu.min.all.js"></script>
			
			<script>
				//Asynchronously load javascript files
				jQuery.getScript("//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js");
				//jQuery.getScript("//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js");
				//jQuery.getScript("js/libs/supplementr.js");
				jQuery.getScript("js/libs/cssbs.js");
				jQuery.getScript("js/libs/gumby.js");
							
				if ( jQuery('html').hasClass('ie8') ) {
					jQuery.getScript("js/libs/respond.js");
				}
						
				jQuery.getScript("js/libs/gumby.init.js"); //@TODO: Comment out if not using Gumby UI Scripts
				//jQuery.getScript("js/libs/plugins.js");		
				jQuery.getScript("js/main.js");
			</script>
		
		<?php endif; ?>
		
		</div><!--/fullbodywrapper-->
	</body>
</html>
