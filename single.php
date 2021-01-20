<?php cacao_css("site-title"); ?>
<?php cacao_css("singular"); ?>
<?php cacao_css("comments"); ?>
<?php cacao_set_html_title(get_the_title()); ?>
<?php get_header(); ?>
	<?php cacao_the_site_title_card(); ?>
	<?php cacao_the_content_tag(); ?>
	<div id="singular-title-container">
		<div id="singular-title-content" class="card-notice cacao-blur-background">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<div id="singular-content-container">
		<?php cacao_the_content(); ?>
	</div>
	<div id="singular-comments-container">
		<?php cacao_the_comments(); ?>
	</div>
<?php get_footer(); ?>
