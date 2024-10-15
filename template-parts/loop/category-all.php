<article class="post">

	<div class="post__date">
		<span><?php the_date( 'M d, Y' );?></span>
	</div>
	<?php 
		the_title( '<h2 class="post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	?>

</article>