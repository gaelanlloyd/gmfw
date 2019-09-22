<?php get_header(); ?>

<!-- GWL : THIS IS INDEX.PHP -->

<!-- START PAGE CONTENT -->

<div class="row"><div class="col-12">

<?php // --- START THE LOOP ---

	if ( have_posts() ) : while ( have_posts() ) : the_post();

		if ( has_post_thumbnail() ) { gmfw_write_featured_image(); }

		?><h1><?php echo the_title(); ?></h1><?php

		the_content();

	endwhile; else : ?>

		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

	<?php endif;

// --- END THE LOOP --- ?>

</div></div>

<!-- END PAGE CONTENT -->

<?php get_footer();