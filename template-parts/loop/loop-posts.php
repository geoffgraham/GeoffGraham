
	<section class="posts">

		<?php // If "TIL" category, let's show a title.
		if ( is_category( 'TIL' ) ):
			echo '<h1>Today I Learned...</h1>';
		else:
			echo '<h1>Blog</h1>';
		endif; ?>

		<?php if ( have_posts() )
			while ( have_posts() ) : the_post();

			if ( is_category( 'TIL' ) ) :
				get_template_part( 'template-parts/loop/category', 'til' );
			else :
				get_template_part( 'template-parts/loop/category', 'all' );
			endif;

			endwhile;
		?>

	</section>
