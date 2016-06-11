<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title><?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?></title>

	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head functions -->

	<style type="text/css">
		/* To encourage you to write as little CSS as possible, there's no separate CSS file */

		/* @import url(https://fonts.googleapis.com/css?family=Rubik:300,500); */
		@import url(https://fonts.googleapis.com/css?family=Roboto:300,500);

		body { margin: 1em auto; max-width: 650px; line-height: 1.6em; font-size: 16px; color: #444; padding: 0 10px; }
		hr { clear: both; border-color: #E0E0E0; color: #E0E0E0; margin: 2em 0; }
		nav ul { padding-left: 0; }
		nav li { list-style-type: none; float: left; margin-right: 1em; }
		img.full { width: 100%; }
		h1, h2, h3 { line-height: 1.2em; }
		h1, h2 { font-weight: normal; }
		h2, h3 { margin-top: 2em; }
		h1 { font-size: 25px; }
		h2 { font-size: 22px; }
		h3 { font-size: 18px; }
		li { margin-bottom: 1em; }
		pre { border: 2px dashed #CCCCCC; padding: 1em; font-family: 'Courier New', monospace; font-size: 14px; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word; }
		.mt0 { margin-top: 0; }
		.mb0 { margin-bottom: 0; }
		.page ul.blank { padding-left: 0; list-style-type: none; }
		table { border-collapse: collapse; }
		th, td { padding: 0.5em 1em; padding: 0.5em 1em; border: 1px solid #E0E0E0; vertical-align: top; text-align: left; }
		table.twocol { width: 100%; }
		table.twocol td { width: 50%; border: 0; padding-top: 0; padding-bottom: 0; }
		table.twocol td.left { padding-left: 0; }
		table.twocol td.right { padding-right: 0; }
		dt { font-weight: bold; }
		dt, dd { margin-bottom: 1em; }
		body.archive article { margin-bottom: 2em; border-bottom: 1px solid #CCCCCC; }
		body.archive article:last-of-type { border-bottom: 0; }
		.floatLeft { float: left; margin-right: 1em; margin-bottom: 1em; }
		.floatRight { float: right; margin-left: 1em; margin-bottom: 1em; }
		.clearFloat { clear: both; }

		/* Optional Google font section
		   Remove this next section and the import above if you don't want fancy font support */

		h1, h2, h3, h4, h5, p, li, body { font-family: 'Roboto', sans-serif; font-weight: 300; }
		h1 { font-size: 32px; font-weight: 300; }
		h1, h2, h3, h4, h5 { text-transform: uppercase; }
		b, strong, dt, th { font-weight: 500; }

		/* link colors from http://clrs.cc/ */

		a { text-decoration: none; color: #0074D9; }
		a:visited { color: #AAAAAA; }
		a:hover { text-decoration: underline; }

	</style>

</head>

<body <?php body_class(); ?>>
	<header>

		<nav>
			<?php wp_nav_menu( array('menu' => 'Main' )); ?>
		</nav>

		<hr>

	</header>

