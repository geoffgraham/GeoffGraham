<?php
/**
 * The Sidebar that displays client recommendations that toot my horn and stuff
 *
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
?>

<section class="module">
  <div class="wrapper">
    <div class="content">
    <h3>Some Kind Words</h3>
      <?php
  		$args = array( 
  		  'post_type' => 'testimony', 
  		  'posts_per_page' => 3, 
  		  'orderby' => 'rand', 
  		  'post__not_in' => $ids );
  		$loop = new WP_Query( $args );
  		while ( $loop->have_posts() ) : $loop->the_post();?>
  		<article class="quote-wrapper">
        <div class="quote-bubble">
          <div class="tri-right btm-left">
          <div class="tri-right right-top">
          <div class="quote-text">
            <?php the_content(); ?>
          </div><!-- quote-text -->
          </div><!-- tri-right btm-left -->
          </div><!-- tri-right right-top -->
        </div><!-- quote-bubble -->
        <div class="citation">
        <?php the_post_thumbnail('post-thumbnail', array( 'align'	=> "left")); ?>
        <p>
          <a href="<?php echo get_post_meta($post->ID, "_link", true); ?>" target="_blank"><?php the_title(); ?></a><br />
          <?php $terms_as_text = get_the_term_list( $post->ID,'clients'); if (!empty($terms_as_text)) echo '<span>', strip_tags($terms_as_text), '</span>'; ?>
        </p>
        </div><!-- citation -->
  		</article><!-- quote-wrapper -->
      <?php endwhile; ?>
    </div><!-- content -->
  </div><!-- wrapper -->
</section><!-- module -->