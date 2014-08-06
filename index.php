<?php include_once('header.php'); ?>

<div id="heroslidercon">
	<div class="nebulashadow inner-top bulging"></div>
	<div class="valign row" style="height: 100%;">
		<div>
			<h3><?php echo $GLOBALS['bloginfo']['name']; ?></h3>
			<h4><?php echo $GLOBALS['meta']['description']; ?></h4>
		</div>
	</div>
	<div class="nebulashadow inner-bottom bulging"></div>
</div><!--/heroslidercon-->

<div class="row">
	<div class="eleven columns">
		<article>
			<h1 class="entry-title">Static Nebula</h1>
			<div class="entry-content">
				The Static Nebula is a springboard web template for developers. Inspired by the HTML5 Boilerplate, this theme creates the framework for development. Like other developer startup templates, it has custom functionality built-in (like styles, and JS/PHP functions), but unlike other themes the Static Nebula is not meant for the end-user.

				Developers will find all source code not obfuscated, so everything may be customized and altered to fit the needs of the project. Additional comments have been added to help explain what is happening; not only is this framework great for speedy development, but it is also useful for learning advanced techniques.
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div><!--/columns-->
	<div class="four columns push_one">
		<?php include('sidebar.php'); ?>
	</div><!--/columns-->
</div><!--/row-->

<?php include_once('footer.php'); ?>