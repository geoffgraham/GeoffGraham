<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Geoff_Graham
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="site-header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'geoff-graham' ); ?></a>
		<?php get_template_part( 'template-parts/header/navigation', 'title' ); ?>
		<div class="site-navigation">
			<?php get_template_part( 'template-parts/header/navigation', 'main' ); ?>
			<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>
		</div>
	</header>
