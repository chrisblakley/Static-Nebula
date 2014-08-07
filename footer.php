<?php
/**
 * Theme Footer
 */
?>
			<hr class="zero" style="margin-top: 30px;"/>
			
			<div class="footer">
							
					<div class="container footerlinks">
						<div class="row powerfootercon">
							<div class="sixteen columns">
								<nav id="powerfooter">
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
					
					<div class="container copyright">
						<div class="row">
							<div class="eleven columns ">
								<p>
									<?php echo date("Y"); ?> &copy; <a href="<?php echo $GLOBALS['bloginfo']['home_url']; ?>"><strong><?php echo $GLOBALS['bloginfo']['name']; ?></strong></a>, all rights reserved.<br/>
									<a href="https://www.google.com/maps/place/<?php echo $GLOBALS['info']['enc_address']; ?>" target="_blank"><?php echo $GLOBALS['info']['full_address']; ?></a>
								</p>
							</div><!--/columns-->
							<div class="four columns push_one">
								<form class="search align-right" method="get" action="<?php echo $GLOBALS['bloginfo']['home_url']; ?>/">
									<input class="nebula-search open input search" type="search" name="s" placeholder="Search" x-webkit-speech/>
								</form>
							</div><!--/columns-->
						</div><!--/row-->
					</div><!--/container-->
			
			</div><!--/footer-->
			
			
			
			<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" <?php echo $GLOBALS["async"]; ?>></script>
			<!-- <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" <?php echo $GLOBALS["async"]; ?>></script> -->
			<!-- @TODO: hoverIntent -->
			
			<script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/jquery.mmenu.min.all.js"></script>
			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/doubletaptogo.js" <?php echo $GLOBALS["defer"]; ?>></script> -->
			
			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/supplementr.js" <?php echo $GLOBALS["async"]; ?>></script> -->
			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/cssbs.js" <?php echo $GLOBALS["async"]; ?>></script> --> <!-- @TODO: Check this is the updated css_browser_selector.js -->
			<script <?php echo $GLOBALS["gumby_debug"]; ?> src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/gumby.js" <?php echo $GLOBALS["defer"]; ?>></script>
			<script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/main.js" <?php echo $GLOBALS["defer"]; ?>></script>
			
			<?php if ( 1==2 ) : //If page that uses DataTables ?>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
			<?php endif; ?>
			
			<?php if ( 1==2 ) : //If page that uses Twitter Feed ?>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
			<?php endif; ?>
			
			<?php if ( $GLOBALS["debug"] ) : ?>
				<script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/performance-timing.js" <?php echo $GLOBALS["async"]; ?>></script>
			<?php endif; ?>
			
						
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
				
			<script type="text/javascript">
				//Load the SDK asynchronously
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_GB/all.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			
			
			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/froogaloop.min.js" <?php echo $GLOBALS["defer"]; ?>></script> --><!-- @TODO: Only call this script if vimeoplayer exists! -->
	        <script>
	            if ( jQuery('.vimeoplayer').length ) {
	                var player = new Array();
	                jQuery('iframe.vimeoplayer').each(function(i){
						var vimeoiframeClass = jQuery(this).attr('id');
						player[i] = $f(vimeoiframeClass);
						player[i].addEvent('ready', function() {
					    	Gumby.log('player is ready');
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
				    Gumby.log('Sending GA event: ' + 'Videos', 'Play', videoTitle);
				}
				
				function onPause(id) {
				    var videoTitle = id.replace(/-/g, ' ');
				    ga('send', 'event', 'Videos', 'Pause', videoTitle);
				    Gumby.log('Sending GA event: ' + 'Videos', 'Pause', videoTitle);
				}
				
				function onSeek(data, id) {
				    var videoTitle = id.replace(/-/g, ' ');
				    ga('send', 'event', 'Videos', 'Seek', videoTitle);
				    Gumby.log('Sending GA event: ' + 'Videos', 'Seek', videoTitle + ' [to: ' + data.seconds + ']');
				}
				
				function onFinish(id) {
					var videoTitle = id.replace(/-/g, ' ');
					ga('send', 'event', 'Videos', 'Finished', videoTitle);
					Gumby.log('Sending GA event: ' + 'Videos', 'Finished', videoTitle);
				}
				
				function onPlayProgress(data, id) {
					//Gumby.log(data.seconds + 's played');
				}
	        </script>
		
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
						var youtubeiframeClass = jQuery(this).attr('id');
						players[youtubeiframeClass] = new YT.Player(youtubeiframeClass, {
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
				    if (e.data == YT.PlayerState.ENDED) {
				        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
				        ga('send', 'event', 'Videos', 'Finished', videoTitle);
				        Gumby.log('Sending GA event: ' + 'Videos', 'Finished', videoTitle);
				    } else if (e.data == YT.PlayerState.PAUSED && pauseFlag) {
				        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
				        ga('send', 'event', 'Videos', 'Pause', videoTitle);
				        Gumby.log('Sending GA event: ' + 'Videos', 'Pause', videoTitle);
				        pauseFlag = false;
				    }
				}
			</script>
		
		</div><!--/fullbodywrapper-->
	</body>
</html>