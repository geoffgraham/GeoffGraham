<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Geoff_Graham
 */

?>

	</main>

	<footer class="site-footer">
		<div class="site-footer__cta">
			<p>Oh, you want to work with me? <a href="/contact">Let's talk.</a></p>
		</div>
		<div class="site-footer__nav">
			<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>
			<?php echo file_get_contents( get_template_directory_uri() . '/dist/img/logo-geoff.svg' ); ?>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
