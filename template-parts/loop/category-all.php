<article class="post">

	<div class="post__date"><?php the_date( 'M d, Y' );?></div>
	<?php 
		the_title( '<div class="post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></div>' );
	?>

</article>