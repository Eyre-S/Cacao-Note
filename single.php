<?php cacao_css("site-title"); ?>
<?php cacao_css("singular"); ?>
<?php cacao_css("comments"); ?>
<?php cacao_set_html_title(get_the_title()); ?>
<?php get_header(); ?>
	<?php cacao_the_site_title_card(); ?>
	<?php cacao_the_content_tag(); ?>
	<div id="singular-title-container" class="card-notice-border" style="background-image: url(<?=cacao_get_post_feature_image()?>)">
		<div id="singular-title-content" class="card-notice non-border cacao-blur-background<?= cacao_has_post_feature_image()?" with-feature-image":"" ?>">
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
