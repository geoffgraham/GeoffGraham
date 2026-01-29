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
	<meta name="theme-color" content="#FD581C">
	<meta name="fediverse:creator" content="@geoff@front-end.social">
	<meta name="google-site-verification" content="efKVLT92Kr6XcuOj2WBHTOI3S1F9bdJws5bsEF8qbXI" />
	<?php wp_head(); ?>
</head>

<body <?php body_class('h-card'); ?>>

		<header class="site-header">
      <div class="site-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Home">
          <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
        </a>
      </div>

      <div class="site-navigation">
        <?php get_template_part( 'template-parts/header/navigation', 'main' ); ?>
      </div>
		</header>

    <div class="site-wrapper">
      <main id="content" class="main-content">