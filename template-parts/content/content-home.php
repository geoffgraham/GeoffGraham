<div class="home-intro">
	<div class="slanted-container">
		<h1 class="statement"><?php the_title() ?></h1>
	</div>
	<img class="home-headshot" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/headshot.svg' ); ?>">
</div>

<?php if ( is_front_page() && ! is_404() ) {
	get_template_part( 'template-parts/content/content', 'facts' );
} ?>