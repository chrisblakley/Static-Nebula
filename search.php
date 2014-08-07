<?php include_once('header.php'); ?>

<div class="row">
	<div class="sixteen columns">
		<div id="bcrumbs">
			<nav class="breadcrumbs">
				<a href="<?php echo $GLOBALS['home_url']; ?>"><i class="fa fa-home"></i></a> <span class="arrow">›</span> <span class="current">Search Results</span>
			</nav>
		</div><!--/bcrumbs-->
		<hr/>
	</div><!--/columns-->
</div><!--/row-->

<div class="row">
	
	<div class="eleven columns">
		<article>
			<h1 class="entry-title">Search Results</h1>
			<div class="entry-content">
				Google site search results here
				<script>
				  (function() {
				    var cx = '008731614294031891538:qht5irlshyk';
				    var gcse = document.createElement('script');
				    gcse.type = 'text/javascript';
				    gcse.async = true;
				    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
				        '//www.google.com/cse/cse.js?cx=' + cx;
				    var s = document.getElementsByTagName('script')[0];
				    s.parentNode.insertBefore(gcse, s);
				  })();
				</script>
				<gcse:search></gcse:search>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div><!--/columns-->
	
	<div class="four columns push_one">
		<?php include_once('sidebar.php'); ?>
	</div><!--/columns-->
	
</div><!--/row-->

<?php include_once('footer.php'); ?>