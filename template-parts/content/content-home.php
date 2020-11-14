<div class="home-intro">
	<div class="slanted-container">
		<h1 class="statement"><?php the_title() ?></h1>
	</div>

	<div class="headshot">
		<img class="headshot-sunglasses" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/icon-sunglasses.svg' ); ?>">

		<img class="home-headshot" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/headshot.svg' ); ?>">
	</div>
</div>

<?php if ( is_front_page() && ! is_404() ) {
	get_template_part( 'template-parts/content/content', 'facts' );
} ?>