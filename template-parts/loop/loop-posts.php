<?php if ( is_main_query() && have_posts() ) : ?>
	<section class="posts">

		<?php // If "TIL" category, let's show its title.
		if ( is_category( 'TIL' ) ) :
			echo '<h1>Today I Learned...</h1>';
		else:
			echo '<h1>Blog</h1>';
		endif; ?>
		
		<?php // The posts
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/loop/category', 'all' );
			endwhile;
		?>
		
		<div class="posts__pagination">
			<?php echo paginate_links( 
					array( 
						'before_page_number'=> '<span class="hide" aria-hidden="true">',
						'after_page_number'=> '</span>',
						'next_text'    => 'Older Posts',
						'prev_text'    => 'Newer Posts'
					) 
				);
			?>
		</div>

	</section>
<?php endif; ?>