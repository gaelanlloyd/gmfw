<?php get_header(); ?>

<!-- GWL: THIS IS SINGLE.PHP -->

<div class="row"><div class="col-12">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header>

		<?php if ( has_post_thumbnail() ) { gmfw_write_featured_image(); } ?>

		<h1><?php echo gmfw_return_page_title(); ?></h1>

	</header>

	<section class="post_content clearfix" itemprop="articleBody">

		<p class="caps"><strong><?php the_date(); ?></strong></p>

		<?php the_content(); ?>

		<?php // wp_link_pages(); ?>

	</section> <!-- end article section -->

	<footer>

		<?php // the_tags('<p class="tags"><span class="tags-title">' . __("Tags","wpbootstrap") . ':</span> ', ' ', '</p>'); ?>

		<?php
		/*
		// only show edit button if user has permission to edit posts
		if( $user_level > 0 ) {
		?>
		<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","wpbootstrap"); ?></a>
		<?php }
		*/ ?>

	</footer>

</article>

<?php // comments_template('',true); ?>

<?php endwhile; ?>

<hr />

</div><!--/col-->
</div><!--/row-->

<div class="row">

<?php

	$linkNext = get_next_post_link( "%link");
	$linkPrev = get_previous_post_link( "%link");

	if ( $linkNext ) { ?>
		<div class="col-6">
			<div class="well">
				<p class="caps"><strong>Newer post</strong></p>
				<p><?php echo $linkNext; ?></p>
			</div>
		</div>
	<?php }

	if ( $linkPrev ) { ?>
		<div class="col-6">
				<div class="well">
				<p class="caps"><strong>Older post</strong></p>
					<p><?php echo $linkPrev; ?></p>
			</div>
		</div>
	<?php } ?>

<?php else : ?>

<article id="post-not-found">
	<?php gmfw_write_404_message(); ?>
</article>

<?php endif; ?>

</div></div>

<?php get_footer();