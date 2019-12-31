
<main class="home">
	<article class="home__content">
		<h1 id="logo" class="home__logo">
		<?php echo file_get_contents( get_template_directory_uri() . '/dist/img/logo.svg' ); ?>
		</h1>

		<?php
		$geoff_graham_description = get_bloginfo( 'description', 'display' );
		if ( $geoff_graham_description || is_customize_preview() ) : ?>
			<h2 id="content" class="home__title"><?php echo html_entity_decode( $geoff_graham_description ); ?></h2>

			<?php
			$post_id = 25;
			$queried_post = get_post($post_id);
			
			echo $queried_post->post_content;
			?>
		<?php endif; ?>

	</article>
</main>