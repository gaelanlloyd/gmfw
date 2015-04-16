
	<hr>

<?php /* PUT YOUR GOOGLE ANALYTICS CODE HERE ----------------------------- */ ?>

<!-- Google analytics -->

<?php
	// If you're logged in, don't write the Google Analytics code (to help exclude your own traffic)

	if ( current_user_can('edit_pages') ) {
	?>
		<!-- Google Anayltics - Skipping logging since you're signed in -->
	<?php
	} else {
	?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-10310091-1', 'auto');
		  ga('send', 'pageview');
		</script>
	<?php
	}
	?>

<?php /* ----------------------------------------------------------------- */ ?>

<?php wp_footer(); // js scripts are inserted using this function ?>

</body>
</html>