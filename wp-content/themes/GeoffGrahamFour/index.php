<?php
/**
 * Template Name: Home
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<div class="home">
  <div class="hero">
    <!--<h1 aria-hidden="true" data-icon="&#xe007; &#xe005; &#xe006;"></h1>-->
    <h1>Geoff Graham</h1>
    <h2>web design and development</h2>
    <a href="/contact" role="link" class="btn-secondary" alt="Hire Geoff Graham">Hire Me</a>
  </div><!-- hero -->
  <section class="work">
    <div class="wrapper">
      <h4 class="ribbon-heading">My Recent Work</h4>
      
      <?php
  		if ( have_posts() )
  		the_post();
  		?>
  
  		<?php rewind_posts(); ?>
      
      <?php
  		// Query 3 Random Portfolio Posts
  		global $wp_query;
  		// get the correct page var
  		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  		// create the page argument
  		$args=  array('paged'=> $paged);
  		// merge the page argument array with the original query array
  		$args = array_merge( $wp_query->query, array( 'post_type' => 'portfolio', 'showposts' => 3, 'orderby' => 'rand' ) );
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
  
</div><!--  home -->

<script>
  $("h1").fitText(1.0, { minFontSize: '40px', maxFontSize: '75px' });
  $("h2").fitText(1.0, { minFontSize: '15px', maxFontSize: '45px' });
  $("h1").lettering();
</script>

<?php get_footer(); ?>
