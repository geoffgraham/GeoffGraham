<?php
/**
 * Front page content
 *
 * @package Geoff_Graham
 */

get_header(); ?>

<main class="main-content">
	<article class="home__content">
		<div class="home__intro">
			<div class="home__logo">
				<?php echo file_get_contents( get_template_directory_uri() . '/dist/img/logo.svg' ); ?>
			</div>

			<?php
			$geoff_graham_description = get_bloginfo( 'description', 'display' );
			if ( $geoff_graham_description || is_customize_preview() ) : ?>
				<h1 class="home__title">
					<?php echo html_entity_decode( $geoff_graham_description ); ?>
				</h1>

				<?php
				$post_id = 25;
				$queried_post = get_post($post_id);
				?>
			</div>

			<figure class="home__image">
				<?php
					the_post_thumbnail( 'large' );
				?>
			</figure>

			<div class="home__body">	
				<?php echo $queried_post->post_content; ?>
			</div>
		<?php endif; ?>

	</article>

	<?php get_template_part( 'template-parts/content/content', 'clients' );  ?>

<?php 
	get_footer();
?>