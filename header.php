<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<title><?php echo gmfw_return_page_title() . " | " . get_bloginfo('name'); ?></title>

	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head functions -->

</head>

<body <?php body_class(); ?>>

	<div class="container">

		<header>

			<div class="row row-header">

				<div class="col-3">

					<p class="mb0 mt0"><a href="/" class="color-body underline-no caps"><?php echo get_bloginfo('name'); ?></a></p>

				</div>

				<div class="col-9" id="navmenu">

					<nav>
						<?php wp_nav_menu( array('menu' => 'Main' )); ?>
					</nav>

				</div>

			</div><!--/row-->

		</header>


