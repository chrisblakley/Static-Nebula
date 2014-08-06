<?php include_once('header.php'); ?>

<div class="row">
	<div class="sixteen columns">
		<?php the_breadcrumb(); ?>
		<hr/>
	</div><!--/columns-->
</div><!--/row-->

<div class="row">
	
	<div class="eleven columns">
			<article>
				<h1 class="entry-title">Page Title</h1>
				<div class="entry-content">
					Page template content
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
			
	</div><!--/columns-->
	
	<div class="four columns push_one">
		<?php include_once('sidebar.php'); ?>
	</div><!--/columns-->
	
</div><!--/row-->

<?php include_once('footer.php'); ?>