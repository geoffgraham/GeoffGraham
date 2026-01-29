<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Geoff_Graham
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-single' ); ?>>
	<h1 class="post-title"><?php echo the_title(); ?></h1>
	<div class="post-body"><?php echo the_content(); ?>
</article>
