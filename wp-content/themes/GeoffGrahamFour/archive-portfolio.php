<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<div class="archive">
  <section class="banner">
    <div class="wrapper">
      <h1>My Work</h1>
    </div><!-- wrapper -->
  </section><!-- banner -->  
  <section class="work">
    <div class="wrapper">
      <?php
  		if ( have_posts() )
  		the_post();
  		?>
  
  		<?php rewind_posts(); ?>
      
      <?php
  		// Query 9 Most Recent Portfolio Posts
  		global $wp_query;
  		// get the correct page var
  		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  		// create the page argument
  		$args=  array('paged'=> $paged);
  		// merge the page argument array with the original query array
  		$args = array_merge( $wp_query->query, array( 'post_type' => 'portfolio', 'showposts' => 9) );
  		// Re-run the query with the new arguments
  		query_posts( $args );
  		// The Loop
  		while ( have_posts() ) : the_post(); ?>
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
</div><!-- archive -->

<?php get_footer(); ?>
