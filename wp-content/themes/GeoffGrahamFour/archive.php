<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>
 
 <section class="archive module">
  <div class="wrapper">
    <div class="content">

  		<?php if (have_posts()) : ?>
  
   			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  
  			<?php /* If this is a category archive */ if (is_category()) { ?>
  				<h2><?php _e('Archive for the','geoffgraham'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category','geoffgraham'); ?></h2>
  
  			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
  				<?php _e('<span aria-hidden="true" data-icon="&#xe003;"></span>&nbsp;','geoffgraham'); ?> <?php single_tag_title(); ?>
  
  			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
  				<h2><?php _e('Archive for','geoffgraham'); ?> <?php the_time('F jS, Y'); ?></h2>
  
  			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
  				<h2><?php _e('Archive for','geoffgraham'); ?> <?php the_time('F, Y'); ?></h2>
  
  			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
  				<h2 class="pagetitle"><?php _e('Archive for','geoffgraham'); ?> <?php the_time('Y'); ?></h2>
  
  			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
  				<h2 class="pagetitle"><?php _e('Author Archive','geoffgraham'); ?></h2>
  
  			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
  				<h2 class="pagetitle"><?php _e('Blog Archives','geoffgraham'); ?></h2>
  			
  			<?php } ?>
  
  			<?php while (have_posts()) : the_post(); ?>
  			
        <article>
      		<h2><a href="<?php the_permalink(); ?>" title="Contnue <?php the_title(); ?>"><?php the_title(); ?></a></h2>
      		<?php the_excerpt(); ?>
        </article>
      
      <?php endwhile; ?>
  	
    </div><!-- content -->
  </div><!-- wrapper -->
		<?php if ($paged > 1) { ?>
  
      <nav role="pagination">
    		<?php next_posts_link('<span aria-hidden="true" data-icon="&#xe00a;"></span> Older'); ?>
    		<?php previous_posts_link('Newer <span aria-hidden="true" data-icon="&#xe00b;"></span>'); ?>
      </nav>
    
    <?php } else { ?>
    
    	<nav role="pagination">
    		<?php next_posts_link('<span aria-hidden="true" data-icon="&#xe00a;"></span> Older'); ?>
      </nav>
    
    <?php } ?>
  		
    <?php else : ?>
    	<h2><?php _e('Nothing Found','geoffgraham'); ?></h2>

  <?php endif; ?>
  
</section><!-- module -->
  	
<section class="module dark">
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
