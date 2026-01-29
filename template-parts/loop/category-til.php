<article class="post">
	<div class="post-date">
		<time><?php the_date( 'M d, Y' );?></time>
	</div>
	<?php 
		the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style=
    "view-transition-name: post-' . get_the_id() . '">', '</a></h2>' );
	?>
</article>