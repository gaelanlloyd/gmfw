
		<!--<hr id="hr-pagebottom" />-->

	</div><!--/container-->

	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-12 center">

					<img src="<?php echo get_template_directory_uri(); ?>/images/lloyd-150c.png" style="position: relative; top: -87px;">

				</div>
			</div>
		</div>
	</div>

	<?php

	// If you're logged in, don't write the Google Analytics code (to help exclude your own traffic)

	if ( current_user_can('edit_pages') ) {
		?><!-- Google Analytics - Skipping logging since you're signed in --><?php
	} else {
		include('ga.php');
	} ?>

<?php /* ----------------------------------------------------------------- */ ?>

<?php wp_footer(); // js scripts are inserted using this function ?>

</body>
</html>