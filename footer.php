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
			<div class="site-footer__nav" role="navigation" aria-label="Footer Links">
				<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>
			</div>
		</footer>

</div><!-- .site-wrapper -->

<?php get_template_part( 'template-parts/footer/footer', 'svg' ); ?>

<script type="speculationrules">
  {
    "prerender": [{
      "where": { "href_matches": "/*" },
      "eagerness": "moderate"
    }]
  }
</script>

<?php wp_footer(); ?>

</body>
</html>
