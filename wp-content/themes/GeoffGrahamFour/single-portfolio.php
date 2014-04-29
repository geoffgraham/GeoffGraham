<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<section class="portfolio-post">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
    <section class="hero">
      <div class="wrapper">
        <div class="summary">
  		    <h1><?php the_title(); ?></h1>
  		    <div class="subhead">
  		      <?php echo get_post_meta($post->ID, "_subhead", true); ?>
  		    </div><!-- subhead -->
  		    <?php echo get_post_meta($post->ID, "_summary", true); ?>
  		    <?php if ( get_post_meta($post->ID, "_site", true) ) { ?>
  		      <p><a role="button" class="button-primary" href="http://<?php echo get_post_meta($post->ID, "_site", true); ?>" target="_blank" alt="<?php the_title(); ?>">Visit Site</a></p>
  		    <?php } // End check for site ?>
        </div><!-- summary -->
        <div class="main-img">
          <img src="<?php echo get_post_meta($post->ID, "_link", true); ?>">
        </div><!-- main-img -->
      </div><!-- wrapper -->
    </section><!-- hero -->
    <section class="article-body dark">
      <div class="wrapper">
        <div class="content">
    		  <?php the_content(); ?>
        </div><!-- content -->
      </div><!-- wrapper -->
    </section><!-- entry-content -->
  </article>
  <?php $ids[]= $post->ID; endwhile; endif; ?>
</section><!-- portfolio-post -->
  
<?php include ('sidebar-portfolio.php'); ?>

<?php get_footer(); ?>