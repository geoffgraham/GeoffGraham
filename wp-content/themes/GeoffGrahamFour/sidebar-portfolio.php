<?php
/**
 * The Sidebar that displays portfolio items
 *
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
?>

<div class="portfolio">
  <section class="work">
    <div class="wrapper">
      <?php if ( is_front_page() ) { ?>
        <h4 class="ribbon-heading">My Recent Work</h4>';
      <?php } else { ?>
        <h4 class="ribbon-heading">More Work</h4>';
      <?php } ?>
      
    <?php
  		$args = array( 
  		  'post_type' => 'portfolio', 
  		  'posts_per_page' => 3, 
  		  'orderby' => 'rand', 
  		  'post__not_in' => $ids );
  		$loop = new WP_Query( $args );
  		while ( $loop->have_posts() ) : $loop->the_post();?>
      	<article>
      	  <a href="<?php echo get_permalink(); ?>">
    				<?php the_post_thumbnail('Portfolio'); ?>
    				<div class="description">
          		<h4><?php the_title(); ?></h4>
      				<?php $terms_as_text = get_the_term_list( $post->ID,'work'); if (!empty($terms_as_text)) echo '<p>', strip_tags($terms_as_text) ,'</p>'; ?>
    				</div><!-- description -->
  				</a>
        </article>
      <?php endwhile; ?>
    </div><!-- wrapper -->
  </section><!-- work -->
</div><!-- portfolio -->