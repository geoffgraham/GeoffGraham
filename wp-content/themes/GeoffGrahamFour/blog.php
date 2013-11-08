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
      		<h2><a href="<?php the_permalink(); ?>" title="Continue <?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
