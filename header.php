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
	<meta name="description" content="Web Design & Development Straight Outta Long Beach, CA."/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="rgb(253, 16, 0)">
	<meta name="google-site-verification" content="efKVLT92Kr6XcuOj2WBHTOI3S1F9bdJws5bsEF8qbXI" />

	<link rel="icon" href="<?php echo get_template_directory_uri()?>/favicon.ico"><!-- 32×32 -->
	<link rel="icon" href="<?php echo get_template_directory_uri()?>/favicon.svg" type="image/svg+xml">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri()?>/apple-touch-icon.png"><!-- 180×180 -->
	<link rel="manifest" href="<?php echo get_template_directory_uri()?>/site.webmanifest">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

		<?php if ( is_front_page() && ! is_404() ) {
			get_template_part( 'template-parts/content/content', 'home' );
		} ?>

		<?php if ( ! is_404() ) { ?>
		<span id="top"></span>
		<div class="site-wrapper">
			<div class="site-content">
		
				<header class="site-header">
					<div class="site-header__wrapper">
						<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'geoff-graham' ); ?></a>
						<?php get_template_part( 'template-parts/header/navigation', 'title' ); ?>
						<div class="site-navigation">
							<?php get_template_part( 'template-parts/header/navigation', 'main' ); ?>
							<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>
						</div>
					</div>
				</header>

		<?php } ?>
