		<div id="cacao-foot" class="card-notice">
			<?php cacao_the_copyright(); ?>
			<?php if (cacao_is_display_footer_statement()) cacao_the_footer_statement(); ?>
			<?php if (cacao_is_footer_null()) echo '<p id="footer-placeholder" class="small-margin">　</p>'; ?>
		</div>
		<?php wp_footer() ?>
	</body>
</html>
