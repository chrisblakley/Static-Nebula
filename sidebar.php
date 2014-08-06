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
				<p>Contact Form Here (with PHP Mail and AJAX)</p>
			</div><!--/columns-->
		</div><!--/row-->
	</li>

</ul>