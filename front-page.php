<?php cacao_css("home"); ?>
<?php cacao_css("post-list"); ?>
<?php cacao_set_html_title(); ?>
<?php get_header(); ?>
	<div id="card-title-container" class="card-notice cacao-blur-background">
		<div id="card-title" class="<?php if (cacao_is_home_title_vertical()) echo "vertical" ?>">
			<div id="card-title-content"><?php cacao_the_home_title(); ?></div>
		</div>
	</div>
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
