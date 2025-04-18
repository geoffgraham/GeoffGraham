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
	<meta name="description" content="Web Design & Development Straight Outta Fort Collins, CO."/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#FD581C">
  <meta name="fediverse:creator" content="@geoff@front-end.social">
	<meta name="google-site-verification" content="efKVLT92Kr6XcuOj2WBHTOI3S1F9bdJws5bsEF8qbXI" />

	<link rel="icon" href="<?php echo get_template_directory_uri()?>/favicon.jpg"><!-- 32×32 -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri()?>/apple-touch-icon.png"><!-- 180×180 -->
	<link rel="manifest" href="<?php echo get_template_directory_uri()?>/site.webmanifest">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('h-card'); ?>>

		<header class="site-header">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'geoff-graham' ); ?></a>
			<div class="site-header__inner">
				<?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
				<div class="site-navigation">
					<?php get_template_part( 'template-parts/header/navigation', 'main' ); ?>
				</div>
			</div>
		</header>
		<div class="site-wrapper">