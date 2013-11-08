<?php
/**
 * Template Name: Contact
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<section class="contact">
  <div class="banner">
    <div class="wrapper">
      <h1><?php the_title(); ?></h1>
    </div><!-- wrapper -->
  </div><!-- banner -->
    <div class="wrapper">
      <div class="content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <hr>
        <?php echo do_shortcode('[contact-form-7 id="1326" title="Contact form 1"]'); ?>
      <?php endwhile; endif; ?>
      </div><!-- content -->
    </div><!-- wrapper -->
</section<!-- contact -->

<script>
  $("h1").fitText(1.0, { minFontSize: '65px', maxFontSize: '200px' });
  $("h1").lettering();
</script>

<?php get_footer(); ?>
