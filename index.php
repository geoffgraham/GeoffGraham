<?php
/**
 * The main template file
 *
 * @package Geoff_Graham
 */

get_header();
?>

  <?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>

<?php get_footer(); ?>