<?php cacao_css("site-title"); ?>
<?php cacao_css("post-list"); ?>
<?php cacao_set_html_title(); ?>
<?php get_header(); ?>
	<?php cacao_the_site_title_card(); ?>
	<?php cacao_the_content_tag(); ?>
	<div id="post-list-container-main" class="post-list-container">
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php if (CacaoPostType::is_post()) : ?>
				<?php cacao_the_listing_card_post(); ?>
			<?php elseif (CacaoPostType::is_note()) : ?>
				<?php cacao_the_listing_card_note(); ?>
			<?php else : ?>
				<?php cacao_the_listing_card_unknown(); ?>
			<?php endif ?>
		<?php endwhile ?>
	</div>
<?php get_footer(); ?>
