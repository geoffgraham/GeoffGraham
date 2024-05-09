<?php if ( is_main_query() && have_posts() ) : ?>
		<?php // If "TIL" category, let's show its title.
		if ( is_category( 'TIL' ) ) :
			echo '<h1>Today I Learned...</h1>';
    // If "One Liners" category, let's show its title.
    elseif ( is_category( 'one-liners' ) ) :
      echo '<h1>One Liners</h1>';
      elseif ( is_category( 'links' ) ) :
        echo '<h1>Links</h1>';
		else:
			echo '<h1>Blog</h1>';
		endif; ?>
		
  <section class="posts">
		<?php // The posts
			while ( have_posts() ) : the_post();
        if ( is_category( 'one-liners' ) ) :
          get_template_part( 'template-parts/loop/category', 'one-liners' );
        else: 
          get_template_part( 'template-parts/loop/category', 'all' );
        endif;
			endwhile;
		?>
  </section>
		
  <footer class="posts__pagination">
    <?php echo paginate_links( 
        array( 
          'before_page_number'=> '<span class="visually-hidden" aria-hidden="true">',
          'after_page_number'=> '</span>',
          'next_text'    => 'Older Posts',
          'prev_text'    => 'Newer Posts'
        ) 
      );
    ?>
  </footer>
<?php endif; ?>