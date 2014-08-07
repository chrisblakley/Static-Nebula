<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 */
?>

<ul class="xoxo">
	
	<li>
		<h3>Features</h3>
		<nav>
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
	</li>
	
	<li>
		<form class="search" method="get" action="<?php echo $GLOBALS['bloginfo']['home_url']; ?>/">
			<ul>
				<li class="append field">
				    <input class="xwide text input search" type="text" name="s" placeholder="Search" />
				    <input type="submit" class="medium primary btn submit" value="Go" />
			    </li>
			</ul>
		</form><!--/search-->
	</li>
	
	<li>
		<h3>Contact Us</h3>
		<?php nebula_facebook_link(); ?>
		<div class="row">
			<div class="sixteen columns">
				<ul id="cform7-container" class="cform-disabled">
					<div class="wpcf7" id="wpcf7-f384-o1" lang="en-US" dir="ltr">
						<div class="screen-reader-response"></div>
							<form class="wpcf7-form contact-form-backup">
								<ul>
									<li class="field">
										<span class="contact-form-heading">Name</span>
										<span class="wpcf7-form-control-wrap name">
											<input type="text" name="name" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required text input cform7-name fb-form-name" placeholder="Your Name*">
										</span>
									</li>
									<li class="field">
										<span class="contact-form-heading">Email</span>
										<span class="wpcf7-form-control-wrap email">
											<input type="email" name="email" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email email input cform7-email" placeholder="Email Address*">
										</span>
									</li>
									<li class="field">
										<span class="contact-form-heading">Message</span>
										<span class="wpcf7-form-control-wrap message">
											<textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required textarea input cform7-message" placeholder="Enter your message here.*"></textarea>
										</span>
									</li>
									<li class="fieldzzzz">
										<input id="contact-submit" type="submit" value="Send" class="wpcf7-form-control wpcf7-submit submit">
									</li>
								</ul>
							</form>
						</div>
					</ul>
			</div><!--/columns-->
		</div><!--/row-->
	</li>

</ul>