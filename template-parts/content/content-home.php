<div class="home-intro">
	<div class="slanted-container">
		<h1 class="statement"><?php the_title() ?></h1>
	</div>
	<img class="home-headshot" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/headshot.svg' ); ?>">
</div>

<div class="cards">
	<?php
	if( have_rows( 'card' ) ):
		while( have_rows( 'card' ) ) : the_row();
			$image = get_sub_field( 'card_image' );
			$heading = get_sub_field( 'card_heading' );
	?>
	<article class="card">
		<div class="card__content">
			<img class="card__image" src="<?php echo esc_url( $image ); ?>" alt="" />
			<h2 class="card__heading"><?php echo $heading ?></h2>
		</div>
	</article>

	<?php
	endwhile;

	// No value.
	else :
			echo 'Sorry, nothing to see here.';
	endif;
?>