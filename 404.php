<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Geoff_Graham
 */

get_header();
?>
	<div class="galaxy"></div>
	<main id="main" class="site-main">
			<header class="page-header">
				<h1 class="page-title">
					<span>🌎</span>
					<?php esc_html_e( 'Lost in Space', 'geoff-graham' ); ?>
				</h1>
			</header><!-- .page-header -->

			<a class="button--secondary" href="<?php echo get_home_url() ?>">Beam Me Up</a>
	</main><!-- #main -->

<?php
get_footer();
