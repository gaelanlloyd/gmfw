<?php

// ----------------------------------------------------------------------------
// gmfw_view_blog - s/c to list all blog entries in a ul/li
// ----------------------------------------------------------------------------

function gmfw_write_post_list_row( $atts ) {

	extract(shortcode_atts(array(
		'limit' => 5,
		'category' => 'blog',
		'title' => 'Blog',
		'showhr' => TRUE,
	), $atts));

	ob_start();

	?>

	<div class="row">

		<div class="col-4">
			<h2 class="mt0"><?php echo $title; ?></h2>
		</div>

		<div class="col-8">

			<?php

			echo gmfw_write_post_list( array(
				'limit' => $limit,
				'category' => $category
				)
			);

			?>

		</div>

	</div>

	<?php if ( $showhr ) { ?>

		<div class="row">

			<div class="col-12">
				<hr class="mt0 mb0" />
			</div>

		</div>

	<?php }

	return ob_get_clean();

}

add_shortcode('gmfw_write_post_list_row','gmfw_write_post_list_row');

function gmfw_write_post_list( $atts ) {

	extract(shortcode_atts(array(
		'limit' => 6,
		'category' => 'blog',
	), $atts));

	ob_start();

	$args = array(
	  'post_type' => 'post',
	  'post_status' => 'publish',
	  'orderby' => 'date',
	  'order' => 'desc',
	  'posts_per_page' => $limit, // -1 for all, 1-n for n posts
	  'tax_query' => array(
	  		array(
	  			'taxonomy' => 'category',
	  			'field' => 'slug',
	  			'terms' => $category
	  		)
	  )
	);

	$my_query = null;
	$my_query = new WP_Query($args);

	$i = 0;

	if ( $my_query->have_posts() ) {

		?>
		<!-- query limit = ' . $limit . ' -->
		<?php

	  	while ($my_query->have_posts()) : $my_query->the_post();

			$postDate = get_the_date("Y-m-d");

			$postPermalink = get_the_permalink();
			$postTitle = get_the_title();
			$postID = get_the_ID();
			$postExcerpt = get_the_excerpt();

			?>
			<div class="add-mb-2em">
				<h3 class="mt0 mb0"><a href="<?php echo $postPermalink; ?>"><?php echo $postTitle; ?></a></h3>
				<?php /* <p class="mt0"><?php echo $postDate; ?></p> */ ?>
				<p class="mt-halfem mb0"><?php echo $postExcerpt; ?></p>
			</div>
			<?php

			$i++;

	  endwhile;

	} else {

		?><p class="mt0">No posts found.</p><?php

	}

	wp_reset_postdata();  // Restore global post data stomped by the_post().

	return ob_get_clean();

}

add_shortcode('gmfw_write_post_list','gmfw_write_post_list');
