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



			<!-- <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" <?php echo $GLOBALS["async"]; ?>></script> -->
			<!-- <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" <?php echo $GLOBALS["async"]; ?>></script> -->
			<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/2013.03.11/hoverintent.min.js" <?php echo $GLOBALS["defer"]; ?>></script> -->

			<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/4.3.2/js/umd/jquery.mmenu.umd.all.min.js"></script>
			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/doubletaptogo.js" <?php echo $GLOBALS["defer"]; ?>></script> -->

			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/supplementr.js" <?php echo $GLOBALS["async"]; ?>></script> -->
			<!-- <script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/cssbs.js" <?php echo $GLOBALS["async"]; ?>></script> --> <!-- @TODO: Check this is the updated css_browser_selector.js -->
			<script <?php echo $GLOBALS["gumby_debug"]; ?> src="//cdnjs.cloudflare.com/ajax/libs/gumby/2.6.0/js/libs/gumby.min.js" <?php echo $GLOBALS["defer"]; ?>></script> <?php //@TODO: Change this to gumby.min.js and fix the "Uncaught TypeError: undefined is not a function" ?>
			<script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/main.js" <?php echo $GLOBALS["defer"]; ?>></script>

			<?php if ( 1==2 ) : //If page that uses DataTables ?>
				<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.1/js/jquery.dataTables.min.js" <?php echo $GLOBALS["defer"]; ?>></script>
			<?php endif; ?>

			<?php if ( 1==2 ) : //If page that uses Twitter Feed ?>
				<script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/libs/twitter.js" <?php echo $GLOBALS["defer"]; ?>></script>
			<?php endif; ?>

			<?php if ( $GLOBALS["debug"] ) : ?>
				<script src="<?php echo $GLOBALS['bloginfo']['template_directory']; ?>/js/performance-timing.js" <?php echo $GLOBALS["async"]; ?>></script>
			<?php endif; ?>


			<script>
				//Pull query strings from URL
				function getQueryStrings() {
					queries = new Array();
				    var q = document.URL.split('?')[1];
				    if ( q != undefined ){
				        q = q.split('&');
				        for ( var i = 0; i < q.length; i++ ){
				            hash = q[i].split('=');
				            queries.push(hash[1]);
				            queries[hash[0]] = hash[1];
				        }
					}
				}

				//Search query strings for the passed parameter
				function GET(query) {
					if ( typeof query === 'undefined' ) {
						return queries;
					}

					if ( typeof queries[query] !== 'undefined' ) {
						return queries[query];
					} else if ( queries.hasOwnProperty(query) ) {
						return query;
					}
					return false;
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
				        pauseFlag = true;
				    }
				    if (e.data == YT.PlayerState.ENDED) {
				        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
				        ga('send', 'event', 'Videos', 'Finished', videoTitle, {'nonInteraction': 1});
				    } else if (e.data == YT.PlayerState.PAUSED && pauseFlag) {
				        var videoTitle = e['target']['a']['id'].replace(/-/g, ' ');
				        ga('send', 'event', 'Videos', 'Pause', videoTitle);
				        pauseFlag = false;
				    }
				}
			</script>

		</div><!--/fullbodywrapper-->
	</body>
</html>