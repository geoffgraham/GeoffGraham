<div class="site-header__logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Home">
		<?php echo file_get_contents( get_template_directory_uri() . '/dist/img/logo.svg' ); ?>
	</a>
</div>

<div class="site-header__title">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</div>