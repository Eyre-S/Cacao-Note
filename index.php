<?php cacao_set_html_title(__("Missing Page Template", CACAO_DOMAIN)); ?>
<?php get_header(); ?>
<div id="404-container" class="full-height-container relative">
	<div id="404" class="card-notice card-center">
		<p></p>
		<h2 class="margin-off"><?php _e("VVARN!", CACAO_DOMAIN); ?></h2>
		<h1 class="margin-off"><?php _e("Here Is the Default Page!", CACAO_DOMAIN); ?></h1>
		<p><?php _e("It looks like you have entered a non-existent location.", CACAO_DOMAIN); ?></p>
		<p><?php _e("This is mostly caused by a theme error. You can check for updates or try to give feedback to the author.", CACAO_DOMAIN); ?></p>
	</div>
</div>
<?php get_footer(); ?>
