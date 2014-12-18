<?php include_once('header.php'); ?>

<div class="row">

	<div class="eleven columns">
		<div id="bcrumbs">
			<nav class="breadcrumbs">
				<a href="<?php echo $GLOBALS['home_url']; ?>"><i class="fa fa-home"></i></a> <span class="arrow">›</span> <span class="current">404: Not Found</span>
			</nav>
		</div><!--/bcrumbs-->
		<article id="post-0" class="post error404 not-found" role="main">
			<h1>Not Found</h1>
			<p>The page you requested could not be found.</p>
			<?php //get_search_form(); echo '<script>document.getElementById(\'s\') && document.getElementById(\'s\').focus();</script>'.PHP_EOL; ?>
		</article>
	</div><!--/columns-->

	<div class="four columns push_one">
		<?php include_once('sidebar.php'); ?>
	</div><!--/columns-->

</div><!--/row-->

<script>
	if ( document.referrer.length ) {
		ga('send', 'event', '404 Not Found', 'Request: ' + document.URL, 'Referrer: ' + document.referrer);
	} else {
		ga('send', 'event', '404 Not Found', 'Request: ' + document.URL, 'No Referrer or Unknown');
	}
</script>

<?php include_once('footer.php'); ?>