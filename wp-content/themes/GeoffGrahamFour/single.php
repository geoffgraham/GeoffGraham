<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<div class="blog">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class('blog') ?> id="post-<?php the_ID(); ?>">
      <section class="banner">
        <div class="wrapper">
          <div class="title">
            <h1><?php the_title(); ?></h1>
          </div>
        </div><!-- wrapper -->
      </section><!-- banner -->
  		<section class="module">
  		  <div class="wrapper">
  		    <div class="content">
    				<?php the_content(); ?>
    				
    				<?php // Displays a button if this is a Link Post Format
							if(get_field('link_post_source')) {
								echo '<a class="button" role="link" href="'.get_field('link_post_source').'">Direct Link</a>';
							}
						?>
    				
  				  <p class="tags">
    				  <span aria-hidden="true" data-icon="&#xe003;"></span>
            	<?php // Get Post Tags
                $posttags = get_the_tags();
                if ($posttags) {
                foreach($posttags as $tag) {
                echo '<a href="';echo bloginfo(url);
                echo '/?tag=' . $tag->slug . '" class=" tagged ' . $tag->slug . '">' . $tag->name . '</a>';
                }
                }
              ?>
  				  </p>
  		    </div><!-- content -->
        </div><!-- wrapper -->
        <nav role="pagination">
          <?php previous_post(' %',
            '', 'yes'); ?>
          <?php next_post('% ',
            '', 'yes'); ?>
        </nav>
  		</section><!-- module -->
  		<section class="module dark">
  		  <div class="wrapper">
  		    <div class="content">
  		      <?php comments_template(); ?>  		      
  		    </div><!-- content -->
  		  </div><!-- wrapper -->
  		</section><!-- module dark -->
    </article>
  <?php endwhile; endif; ?>
</div><!-- blog -->

<?php get_footer(); ?>