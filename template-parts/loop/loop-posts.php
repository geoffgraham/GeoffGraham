
	<section class="posts">

	<?php // If "TIL" category, let's show a title.
	if ( is_category( 'TIL' ) ) :
	?>

		<h1>Today I Learned...</h1>

	<?php
	endif;
	
	// All categories, except TIL
	if ( have_posts() && ! is_category( 'TIL' ) ) : ?>

		<h1>Blog</h1>

		<?php while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/loop/category', 'all' );

		endwhile;
	
	// Only TIL
	else :

		while ( have_posts() ) : the_post(); ?>

		<?php		
		get_template_part( 'template-parts/loop/category', 'til' );

		endwhile;

	endif;
	?>

</section>
