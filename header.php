<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title><?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?></title>

	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->

	<style type="text/css">
		/* To encourage you to write as little CSS as possible, there's no separate CSS file */
		body { margin: 1em auto; max-width: 650px; line-height: 1.6em; font-size: 18px; color: #444; padding: 0 10px; }
		hr { clear: both; border-color: #E0E0E0; color: #E0E0E0; }
		nav ul { padding-left: 0; }
		nav li { list-style-type: none; float: left; margin-right: 1em; }
		img.full { width: 100%; }
		h1, h2, h3 { line-height: 1.2em; }
		h1, h2 { font-weight: normal; }
		h2, h3 { margin-top: 2em; }
		h1 { font-size: 25px; }
		h2 { font-size: 22px; }
		h3 { font-size: 18px; }
		li { margin-bottom: 0.5em; }
		pre { border: 2px dashed #CCCCCC; padding: 1em; }
		.mt0 { margin-top: 1em; }
	</style>

</head>

<body <?php body_class(); ?>>
	<header>

		<nav>
			<?php wp_nav_menu( array('menu' => 'Main' )); ?>
		</nav>

		<hr>

	</header>

