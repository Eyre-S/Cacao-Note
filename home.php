<?php cacao_css("home"); ?>
<?php cacao_css("post-list"); ?>
<?php get_header(); ?>
	<div id="card-title-container" class="card-notice cacao-blur-background-container">
		<div id="card-title" class="cacao-blur-background">
			<p>Hello Wrodl!</p>
		</div>
	</div>
	<div id="post-list-container-main" class="post-list-container">
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php if (CacaoPostType::is_post()) : ?>
				<?php get_template_part("templates/listing-card-post"); ?>
			<?php elseif (CacaoPostType::is_note()) : ?>
				<?php get_template_part("templates/listing-card-note"); ?>
			<?php else : ?>
				<?php get_template_part("templates/listing-card-unknown"); ?>
			<?php endif ?>
		<?php endwhile ?>
	</div>
<?php get_footer(); ?>
