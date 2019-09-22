<?php

include('shortcodes.php');

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
// gmfw_list_tweets - Lists tweets in a simple text-only format.
// Requires the [oAuth Twitter Feed for Developers] plugin
// ----------------------------------------------------------------------------

function gmfw_list_tweets( $atts ) {

	extract(shortcode_atts(array(
		'limit' => 5,
		), $atts));

	$screenname = 'gaelanlloyd';
	$options = '';

	$return_string = ''; // init so that further lines can use .= notation consistently

	$tweets = getTweets($screenname, $limit, $options);

	// Example code adapted from https://github.com/stormuk/storm-twitter-for-wordpress/wiki/Example-code-to-layout-tweets

	if(is_array($tweets)) {

		$return_string .= '<ul class="blank">';

		foreach($tweets as $tweet) {

		    if($tweet['text']) {
		        $the_tweet = $tweet['text'];

		        //
		        // NOTE:
		        // I've decided to comment out the majority of this functionality
		        // as I just want a plain text list of tweets where the entire
		        // tweet text links to the tweet page.
		        //

		        /*
		        Twitter Developer Display Requirements
		        https://dev.twitter.com/terms/display-requirements

		        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
		          i. User_mentions must link to the mentioned user's profile.
		         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
		        iii. Links in Tweet text must be displayed using the display_url
		             field in the URL entities API response, and link to the original t.co url field.
		        */

		        // i. User_mentions must link to the mentioned user's profile.
		        /*
		        if(is_array($tweet['entities']['user_mentions'])) {
		            foreach($tweet['entities']['user_mentions'] as $key => $user_mention) {
		                $the_tweet = preg_replace(
		                    '/@'.$user_mention['screen_name'].'/i',
		                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
		                    $the_tweet);
		            }
		        }
		        */

		        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
		        /*
		        if(is_array($tweet['entities']['hashtags'])) {
		            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
		                $the_tweet = preg_replace(
		                    '/#'.$hashtag['text'].'/i',
		                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
		                    $the_tweet);
		            }
		        }
		        */

		        // iii. Links in Tweet text must be displayed using the display_url
		        //      field in the URL entities API response, and link to the original t.co url field.
		        /*
		        if(is_array($tweet['entities']['urls'])) {
		            foreach($tweet['entities']['urls'] as $key => $link) {
		                $the_tweet = preg_replace(
		                    '`'.$link['url'].'`',
		                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
		                    $the_tweet);
		            }
		        }
		        */

		        $return_string .= '<li><a href="https://twitter.com/' . $screenname . '/status/'.$tweet['id_str'].'" target="_blank">' . $the_tweet . '</a></li>';

		        // 3. Tweet Actions
		        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
		        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
		        // get the sprite or images from twitter's developers resource and update your stylesheet
		        /*
		        echo '
		        <div class="twitter_intents">
		            <p><a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a></p>
		            <p><a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a></p>
		            <p><a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a></p>
		        </div>';
				*/

		        // 4. Tweet Timestamp
		        //    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
		        // 5. Tweet Permalink
		        //    The Tweet timestamp must always be linked to the Tweet permalink.
		        /*
		        echo '
		        <p class="timestamp">
		            <a href="https://twitter.com/' . $screenname . '/status/'.$tweet['id_str'].'" target="_blank">
		                '.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
		            </a>
		        </p>';// -8 GMT for Pacific Standard Time
		        */

		    } else {

		    	$return_string .= '<li>No tweets found.</li>';

		    }

		}

	$return_string .= '</ul>';

	}

	return $return_string;

}

add_shortcode('gmfw_list_tweets','gmfw_list_tweets');


// ----------------------------------------------------------------------------
// Category archive pagination fix
// Fixes 404 when custom permalink string is: /%category%/%postname%/
// Adapted from: https://wordpress.org/plugins/category-pagination-fix/faq/
// ----------------------------------------------------------------------------

function remove_page_from_query_string($query_string) {
    if (@$query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        list($delim, $page_index) = explode('/', $query_string['page']);
        $query_string['paged'] = $page_index;
    }
    return $query_string;
}
add_filter('request', 'remove_page_from_query_string');

// following are code adapted from Custom Post Type Category Pagination Fix by jdantzer
function fix_category_pagination($qs) {
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

// --- Disable unused WP features ----------------------------------------------

// --- Disable adjacent post prefetch

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

// --- Disable wp-embed.min.js

function wsh_deregister_wp_scripts() {
  wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_footer', 'wsh_deregister_wp_scripts' );

// --- Disable wp-emoji-release.min.js

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// --- Remove <link rel='shortlink'>
// which causes tons of useless pages to be followed during a wget operation

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// --- Remove <meta name="generator">

remove_action('wp_head', 'wp_generator');

// --- Remove Gutenberg block styles

function gmfw_disable_gutenberg_block() {
    wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_print_styles', 'gmfw_disable_gutenberg_block', 100 );

// --- Include GMFW style

function gmfw_enqueue_style() {
    wp_enqueue_style( 'gmfw-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'gmfw_enqueue_style' );


// --- Return H1 / Page SEO title ----------------------------------------------

function gmfw_return_page_title() {

	if ( is_category() ) {
		$title = single_cat_title( NULL, FALSE );
	} elseif ( is_tag() ) {
		$title = "Posts tagged: " . single_tag_title();
	} elseif ( is_author() ) {
		$title = "Posts by: " . get_the_author_meta('display_name');
	} elseif ( is_day() ) {
		$title = "Daily archives: " . get_the_time('l, F j, Y');
	} elseif ( is_month() ) {
	    $title = "Monthly archives: " . get_the_time('F Y');
	} elseif ( is_year() ) {
	    $title = "Yearly archives: " . get_the_time('Y');
	} else {
		$title = get_the_title();
	}

	return $title;

}

// --- Return featured image ---------------------------------------------------

function gmfw_write_featured_image() {

	// - Featured images should be 900 px wide
	// - Height can vary, 250px looks nice

	?><img src="<?php the_post_thumbnail_url(); ?>" class="width-full add-mb-2em"><?php

}


// --- Write 404 message -------------------------------------------------------

function gmfw_write_404_message() {

	?>
	<h1>404</h1>
	<p>Sorry, this page cannot be found.</p>
	<?php
}

