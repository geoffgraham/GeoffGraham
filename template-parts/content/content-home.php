
<article class="slide-panel">
	<div class="slide-panel__wrapper">
		<div class="slide-panel__image">
			<?php echo file_get_contents( get_template_directory_uri() . '/dist/img/logo.svg' ); ?>
		</div>
		<div class="slide-panel__heading">
			<?php
			$geoff_graham_description = get_bloginfo( 'description', 'display' );
			if ( $geoff_graham_description || is_customize_preview() ) : ?>
				<h1 class="home__title">
					<?php echo html_entity_decode( $geoff_graham_description ); ?>
				</h1>
		</div>
		<div class="slide-panel__content">
			<?php
				endif;
			?>
		</div>
		<?php get_template_part( 'template-parts/content/content', 'clients' ); ?>
	</div>
</article>