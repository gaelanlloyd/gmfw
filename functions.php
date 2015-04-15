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

?>