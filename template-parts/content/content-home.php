<div class="home-intro">
	<div class="slanted-container">
		<h1 class="statement"><?php the_title() ?></h1>
	</div>
	<img class="home-headshot" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/headshot.svg' ); ?>">
</div>

<?php 
$args = array( 
	'order' => "ASC",
	'orderby' => 'date',
	'paged' => $paged,
	'post_type' => 'facts',
	'posts_per_page' => 3
);

$fact_query = new WP_Query( $args );

if ( $fact_query->have_posts() ) ?>

<div class="cards">
	<?php while ( $fact_query->have_posts() ) : $fact_query->the_post(); ?>
	<article class="card">
		<div class="card__content">
			<img class="card__image" src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>" alt="" />
			<h2 class="card__heading"><?php the_title() ?></h2>
		</div>
	</article>

	<?php
	endwhile;
	?>
</div>