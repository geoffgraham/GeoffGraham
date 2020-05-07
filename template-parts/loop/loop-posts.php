
	<section class="posts">

		<?php // If "TIL" category, let's show it's title.
		if ( is_category( 'TIL' ) ) :
			echo '<h1>Today I Learned...</h1>';
		else:
			echo '<h1>Blog</h1>';
		endif; ?>

		<?php if ( have_posts() )
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/loop/category', 'all' );
			endwhile;
		?>
		<div class="posts__pagination">
			<?php echo paginate_links( 
					array( 
						'add_fragment' => '#top',
						'before_page_number'=> '<span class="hide" aria-hidden="true">',
						'after_page_number'=> '</span>',
						'next_text'    => 'Older Posts',
						'prev_text'    => 'Newer Posts'
					) 
				);
			?>
		</div>

	</section>
