<div class="home-intro">
	<div class="slanted-container">
		<h1 class="statement">Hi, I'm Geoff</h1>
	</div>
	<img class="home-headshot" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/headshot.svg' ); ?>">
</div>

<div class="callouts">
	<?php
	if( have_rows('callout') ):
		while( have_rows('callout') ) : the_row();
			$image = get_sub_field('callout_image');
			$heading = get_sub_field('callout_heading');
	?>
	<article class="callout">
		<div class="callout__content">
			<img class="callout__image" src="<?php echo esc_url( $image ); ?>" alt="" />
			<h3 class="callout__heading"><?php echo $heading ?></h3>
		</div>
	</article>

	<?php
	endwhile;

	// No value.
	else :
			echo 'Sorry, nothing to see here.';
	endif;
?>