<div id="card-post-container-<?php the_ID(); ?>" class="listing-card-container card-post-container">
	<a href="<?php the_permalink(); ?>">
		<div id="card-post-<?php the_ID(); ?>" class="listing-card card-post translation-preload">
			<h2><?php the_title(); ?></h2>
			<div id="card-post-summary-<?php the_ID(); ?>" class="card-post-summary">
				<?php the_excerpt(); ?>
			</div>
			<div class="card-post-more"><p class="card-post-more-content">>>></p></div>
		</div>
	</a>
</div>