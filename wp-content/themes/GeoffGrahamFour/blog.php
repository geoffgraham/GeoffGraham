<?php
/**
 * Template Name: Blog
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<section class="archive module">
  <div class="wrapper">
    <div class="content">
      <?php 
      $temp = $wp_query; $wp_query= null;
      $wp_query = new WP_Query(); $wp_query->query('showposts=5' . '&paged='.$paged);
      while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
          
        <article>
      		<h2>
	      		<a href="<?php the_permalink(); ?>" title="Continue <?php the_title(); ?>">
		      		<?php
		      			if ( has_post_format( 'link' ) ) { ?>
		      				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32" style="fill:#666;">
										<path d="M13.757 19.868c-0.416 0-0.832-0.159-1.149-0.476-2.973-2.973-2.973-7.81 0-10.783l6-6c1.44-1.44 3.355-2.233 5.392-2.233s3.951 0.793 5.392 2.233c2.973 2.973 2.973 7.81 0 10.783l-2.743 2.743c-0.635 0.635-1.663 0.635-2.298 0s-0.635-1.663 0-2.298l2.743-2.743c1.706-1.706 1.706-4.481 0-6.187-0.826-0.826-1.925-1.281-3.094-1.281s-2.267 0.455-3.094 1.281l-6 6c-1.706 1.706-1.706 4.481 0 6.187 0.635 0.635 0.635 1.663 0 2.298-0.317 0.317-0.733 0.476-1.149 0.476z"></path>
										<path d="M8 31.625c-2.037 0-3.952-0.793-5.392-2.233-2.973-2.973-2.973-7.81 0-10.783l2.743-2.743c0.635-0.635 1.664-0.635 2.298 0s0.635 1.663 0 2.298l-2.743 2.743c-1.706 1.706-1.706 4.481 0 6.187 0.826 0.826 1.925 1.281 3.094 1.281s2.267-0.455 3.094-1.281l6-6c1.706-1.706 1.706-4.481 0-6.187-0.635-0.635-0.635-1.663 0-2.298s1.663-0.635 2.298 0c2.973 2.973 2.973 7.81 0 10.783l-6 6c-1.44 1.44-3.355 2.233-5.392 2.233z"></path>
									</svg>
							<?php } ?>
		      		<?php the_title(); ?>
		      	</a>
		      </h2>
      		<?php the_excerpt(); ?>
        </article>
      
      <?php endwhile; ?>
        
        <?php get_sidebar(); ?>
    </div><!-- content -->
  </div><!-- wrapper -->
  
  <?php // Get Pagination 
    if ($paged > 1) { ?>
      
      <nav role="pagination">
    		<?php next_posts_link('<span aria-hidden="true" data-icon="&#xe00a;"></span> Older'); ?>
    		<?php previous_posts_link('Newer <span aria-hidden="true" data-icon="&#xe00b;"></span>'); ?>
      </nav>
    
    <?php } else { ?>
    
    	<nav role="pagination">
    		<?php next_posts_link('<span aria-hidden="true" data-icon="&#xe00a;"></span> Older'); ?>
      </nav>
  <?php } ?>

  <?php wp_reset_postdata(); ?>
  
</section><!-- module -->

<section class="dark">
  <div class="wrapper">
    <div class="content">
    	<h4 class="ribbon-heading">Browse Tags</h4>
    	  <ul class="columns">
        	<? // Get all tags ?>
        	<? $tags = get_tags();
            if ($tags) {
              foreach ($tags as $tag) {
                echo '<li><a class="tagged" href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name.'</a></li>';
              }
            }
          ?>
    	  </ul>
    </div><!-- content -->
  </div><!-- wrapper -->
</section><!-- module dark -->

<?php get_footer(); ?>
