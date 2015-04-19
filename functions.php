<?php

// ----------------------------------------------------------------------------
// Allow pages and posts to have featured images
// ----------------------------------------------------------------------------
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

// ----------------------------------------------------------------------------
// Register menu
// ----------------------------------------------------------------------------
add_action( 'after_setup_theme', 'register_gmfw_menu' );

function register_gmfw_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'gmfw-main-menu' ) );
}

// ----------------------------------------------------------------------------
// gmfw_view_blog - s/c to list all blog entries in a ul/li
// ----------------------------------------------------------------------------
function gmfw_view_blog( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'limit' => 5,
		), $atts));

	$return_string = ''; // init so that further lines can use .= notation consistently

	// if no limit is specified, default to 5 (5+1 = 6)
	if ( empty($limit) ) {
		// limit is 1-n
		$limit = 6;
	}

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
	  			'terms' => 'blog'
	  		)
	  )
	);

	$my_query = null;
	$my_query = new WP_Query($args);

	$i = 0;

	if( $my_query->have_posts() ) {

		$return_string .= '<!-- query limit = ' . $limit . ' -->';
		$return_string .= '<ul>';

	  while ($my_query->have_posts()) : $my_query->the_post();

			/*
			// get a custom field from the current post
			$postMeta = get_post_custom_values("wpcf-upload-ad");
			$promoGraphic = $postMeta[0];
			*/
			$postDate = get_the_date("Y-m-d");

			$postPermalink = get_the_permalink();
			$postTitle = get_the_title();
			$postID = get_the_ID();

			/* DEBUG */
			/*
			$return_string .= "<pre>";
			$return_string .= "Permalink = [" . $postPermalink . "]<br>";
			$return_string .= "Title = [" . $postTitle . "]<br>";
			$return_string .= "ID = [" . $postID ."]<br>";
			$return_string .= "</pre>";
			*/

			$return_string .= '<li>';
			$return_string .= '<a href="' . $postPermalink . '">' . $postTitle . '</a> (' . $postDate . ')';
			$return_string .= '</li>';

			$i++;

	  endwhile;

		$return_string .= '</ul>';

	} else {

		$return_string .= '<p>No posts found.</p>';

	}

	wp_reset_postdata();  // Restore global post data stomped by the_post().

	return $return_string;

}

add_shortcode('gmfw_view_blog','gmfw_view_blog');

// ----------------------------------------------------------------------------
// Set archives to show X posts per page
// ----------------------------------------------------------------------------
/*
function post_count_archive( $query ) {
    if( !is_admin() && $query->is_main_query() && is_archive() ) {
        $query->set( 'posts_per_page', '4' );
    }
}
add_action( 'pre_get_posts', 'post_count_archives' );
*/


// ----------------------------------------------------------------------------
// Category archive pagination fix
// Fixes 404 when custom permalink string is: /%category%/%postname%/
// Adapted from: https://wordpress.org/plugins/category-pagination-fix/faq/
// ----------------------------------------------------------------------------

function remove_page_from_query_string($query_string)
{
    if (@$query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        list($delim, $page_index) = explode('/', $query_string['page']);
        $query_string['paged'] = $page_index;
    }
    return $query_string;
}
add_filter('request', 'remove_page_from_query_string');

// following are code adapted from Custom Post Type Category Pagination Fix by jdantzer
function fix_category_pagination($qs){
	if(isset($qs['category_name']) && isset($qs['paged'])){
		$qs['post_type'] = get_post_types($args = array(
			'public'   => true,
			'_builtin' => false
		));
		array_push($qs['post_type'],'post');
	}
	return $qs;
}
add_filter('request', 'fix_category_pagination');

// ----------------------------------------------------------------------------

?>