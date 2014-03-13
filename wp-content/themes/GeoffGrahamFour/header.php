<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
?><!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->

	<?php if (is_search()) echo '<meta name="robots" content="noindex, nofollow" />'; ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<link rel="shortcut icon" href="http://localhost:8888/wp-content/themes/GeoffGrahamFour/lib/images/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/apple-touch-icon-57x757-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png" />
	

	<?php if (true == of_get_option('meta_author')) echo '<meta name="author" content="'.of_get_option("meta_author").'" />'; ?>
	
	<?php if (true == of_get_option('meta_google')) echo '<meta name="google-site-verification" content="'.of_get_option("meta_google").'" />'; ?>

	<meta name="Copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">

	<?php if (true == of_get_option('meta_viewport')) {
	echo '<meta name="viewport" content="'.of_get_option("meta_viewport").'" />';
	echo '<!--  Mobile Viewport Fix
	j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
	device-width : Occupy full width of the screen in its current orientation
	initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
	maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
	-->';
	} ?>
	
	<?php if (true == of_get_option('head_favicon')) {
	echo '<link rel="shortcut icon" href="'.of_get_option("head_favicon").'" />';
	echo '<!-- This is the traditional favicon.-->';
	} ?>

	<?php if (true == of_get_option('head_apple_touch_icon')) {
	echo '<link rel="apple-touch-icon" href="'.of_get_option("head_apple_touch_icon").'">';
	echo '<!-- The is the icon for iOS Web Clip.
		 - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4 retina display-->';
	} ?>

	<?php if (true == of_get_option('meta_app_win_name')) {
	echo '<!-- Windows 8 -->';
	echo '<meta name="application-name" content="'.of_get_option("meta_app_win_name").'" /> ';
	echo '<meta name="msapplication-TileColor" content="'.of_get_option("meta_app_win_color").'" /> ';
	echo '<meta name="msapplication-TileImage" content="'.of_get_option("meta_app_win_image").'" />';
	} ?>

	<?php if (true == of_get_option('meta_app_twt_card')) {
	echo '<!-- Twitter -->';
	echo '<meta name="twitter:card" content="'.of_get_option("meta_app_twt_card").'" />';
	echo '<meta name="twitter:site" content="'.of_get_option("meta_app_twt_site").'" />';
	echo '<meta name="twitter:title" content="'.of_get_option("meta_app_twt_title").'">';
	echo '<meta name="twitter:description" content="'.of_get_option("meta_app_twt_description").'" />';
	echo '<meta name="twitter:url" content="'.of_get_option("meta_app_twt_url").'" />';
	} ?>

	<?php if (true == of_get_option('meta_app_fb_title')) {
	echo '<!-- Facebook -->';
	echo '<meta property="og:title" content="'.of_get_option("meta_app_fb_title").'" />';
	echo '<meta property="og:description" content="'.of_get_option("meta_app_fb_description").'" />';
	echo '<meta property="og:url" content="'.of_get_option("meta_app_fb_url").'" />';
	echo '<meta property="og:image" content="'.of_get_option("meta_app_fb_image").'" />';
	} ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!-- Fonts -->
  <script type="text/javascript">
  (function() {
    var config = {
      kitId: 'rwm5lvr',
      scriptTimeout: 3000
    };
    var h=document.getElementsByTagName("html")[0];h.className+=" wf-loading";var t=setTimeout(function(){h.className=h.className.replace(/(\s|^)wf-loading(\s|$)/g," ");h.className+=" wf-inactive"},config.scriptTimeout);var tk=document.createElement("script"),d=false;tk.src='//use.typekit.net/'+config.kitId+'.js';tk.type="text/javascript";tk.async="true";tk.onload=tk.onreadystatechange=function(){var a=this.readyState;if(d||a&&a!="complete"&&a!="loaded")return;d=true;clearTimeout(t);try{Typekit.load(config)}catch(b){}};var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(tk,s)
  })();
  </script>

	<?php wp_head(); ?>

</head>

<body>

<header role="header" class="main" role="banner">
  <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
  <a href="#menu" class="menu-icon" aria-hidden="true" data-icon="&#xe009;"></a>
  <nav id="menu" class="primary" role="navigation">
    <?php wp_nav_menu( array('menu' => 'primary') ); ?>
  </nav><!-- primary -->
  <nav class="social" role="social">
    <ul>
      <li>
        <a alt="Follow Geoff Graham on Twitter" href="http://twitter.com/geoffreygraham" aria-hidden="true" data-icon="&#xe000;"></a>
      </li>
      <li>
        <a alt="See Geoff Graham on LinkedIn" href="http://www.linkedin.com/in/geoffreyjgraham" aria-hidden="true" data-icon="&#xe001;"></a>
      </li>
      <li>
        <a alt="Check out Geoff Graham on Codepen" href="https://codepen.io/geoffgraham" aria-hidden="true" data-icon="&#xe002;"></a>
      </li>
      <li>
        <a alt="Subscribe to Geoff Graham Blog RSS" href="<?php bloginfo('rss_url'); ?>" aria-hidden="true" data-icon="&#xe004;"></a>
      </li>
    </ul>
  </nav><!-- social -->
</header>

