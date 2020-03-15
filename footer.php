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
				<p>Oh, you want to work with me? <span><a href="/contact">Let's talk.</a></span></p>
			</div>
			<div class="site-footer__nav" role="navigation" aria-label="Footer Links">
				<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>
				<a href="<?php echo home_url(); ?>" aria-label="Return Home"><?php echo file_get_contents( get_template_directory_uri() . '/dist/img/logo-geoff.svg' ); ?></a>
			</div>
		</footer>

	</div><!-- .site-content -->
</div><!-- .site-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
