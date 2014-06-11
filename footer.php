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
				<?php date("Y"); ?> &copy; <a href="/"><strong>#</strong></a>, all rights reserved.<br/>
				<a href="https://www.google.com/maps/place/760+West+Genesee+Street+Syracuse+NY+13204" target="_blank">760 West Genesee Street, Syracuse, NY 13204</a>
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
		
		<script>
			//Capture Print Intent
			try { (function() {
					var afterPrint = function() {
						ga('send', 'event', 'Print (Intent)', document.location.pathname);
						Gumby.log('Sending GA event: ' + 'Print (Intent)', document.location.pathname);
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
		
	
		<script>
			//If jQuery has not been intialized, load it from Google's CDN 
			if (typeof jQuery === 'undefined') {
			    var script = document.createElement('script');
			    script.type = "text/javascript";
			    script.src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"; <?php //@TODO: Always verify this is the desired version of jQuery! ?>
			    document.getElementsByTagName('head')[0].appendChild(script);
			}
		</script>
		
				
		<script src="js/libs/jquery.mmenu.min.all.js"></script> <!-- @TODO: Have to make sure this one loads before main.js! Can it be deferred? -->
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" <?php echo $GLOBALS["async"]; ?>></script>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" <?php echo $GLOBALS["async"]; ?>></script> -->
		<!-- <script src="js/libs/supplementr.js" <?php echo $GLOBALS["async"]; ?>></script> -->
		<!--<script src="js/libs/cssbs.js" <?php echo $GLOBALS["async"]; ?>></script>-->
		<!-- <script src="js/libs/doubletaptogo.js" <?php echo $GLOBALS["defer"]; ?>></script> -->
		<script <?php echo $GLOBALS["gumby_debug"]; ?> src="js/libs/gumby.min.js" <?php echo $GLOBALS["defer"]; ?>></script>
		
		<!--[if lt IE 9]>
			<script src="js/libs/html5shiv.js" <?php echo $GLOBALS["defer"]; ?>></script>
			<script src="js/libs/respond.js" <?php echo $GLOBALS["defer"]; ?>></script>
		<![endif]-->
		
		<script src="js/main.js" <?php echo $GLOBALS["defer"]; ?>></script>
		
		<script>
			//Check for Youtube Videos
			if ( jQuery('.youtubeplayer').length ) {
				var players = {};
				var tag = document.createElement('script');
				tag.src = "http://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			}
	
			function onYouTubeIframeAPIReady(e) {
				jQuery('iframe.youtubeplayer').each(function(i){
					var iframeClass = jQuery(this).attr('id');
					players[iframeClass] = new YT.Player(iframeClass, {
						events: {
							'onReady': onPlayerReady,
							'onStateChange': onPlayerStateChange
						}
					});
				});
			}
	
			//Track Youtube Video Events
			var pauseFlag = false;
			function onPlayerReady(e) {
			   //Do nothing
			}
			function onPlayerStateChange(e) {
			    if (e.data == YT.PlayerState.PLAYING) {
			        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
			        ga('send', 'event', 'Videos', 'Play', videoTitle);
			        Gumby.log('Sending GA event: ' + 'Videos', 'Play', videoTitle);
			        pauseFlag = true;
			    }
			    if (e.data == YT.PlayerState.PAUSED && pauseFlag) {
			        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
			        ga('send', 'event', 'Videos', 'Pause', videoTitle);
			        Gumby.log('Sending GA event: ' + 'Videos', 'Pause', videoTitle);
			        pauseFlag = false;
			    }
			    if (e.data == YT.PlayerState.ENDED) {
			        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
			        ga('send', 'event', 'Videos', 'Finished', videoTitle);
			        Gumby.log('Sending GA event: ' + 'Videos', 'Finished', videoTitle);
			    }
			}
		</script>
		
		</div><!--/fullbodywrapper-->
	</body>
</html>
