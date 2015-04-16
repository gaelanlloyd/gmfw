<?php get_header(); ?>

<!-- GWL: THIS IS INDEX.PHP -->

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

		<header>

			<?php /*
			<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wpbs-featured' ); ?></a>
			*/ ?>

			<?php
			if ( has_post_thumbnail() ) {
				$featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				?>
				<p><img src="<?php echo $featured_image; ?>" class="full"></p>
				<?php
			}
			?>

			<h1><?php the_title(); ?></h1>

			<?php /*
			<p class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', '); ?>.</p>
			*/ ?>

			<?php /*
			<p>Posted on: <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></time></p>
			*/ ?>

		</header>

		<section class="post_content clearfix">
			<?php the_content( __("Read more &raquo;","wpbootstrap") ); ?>
		</section> <!-- end article section -->

		<?php /*
		<footer>
			<p class="tags"><?php the_tags('<span class="tags-title">' . __("Tags","wpbootstrap") . ':</span> ', ' ', ''); ?></p>
		</footer> <!-- end article footer -->
		*/ ?>

	</article>

	<?php endwhile; ?>

	<?php /*
	<nav class="wp-prev-next">
		<ul class="pager">
			<li class="previous"><?php next_posts_link('&laquo; Older Entries'); ?></li>
			<li class="next"><?php previous_posts_link('Newer Entries &raquo;'); ?></li>
		</ul>
	</nav>
	*/ ?>

	<?php else : ?>

	<article id="post-not-found">
	    <header>
	    	<h1>Not found</h1>
	    </header>
	    <section class="post_content">
	    	<p>Sorry, but that page couldn't be found.</p>
	    </section>
	    <footer>
	    </footer>
	</article>

	<?php endif; ?>


<?php get_footer(); ?>