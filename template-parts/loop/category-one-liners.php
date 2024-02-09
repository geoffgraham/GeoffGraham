<article class="post">

	<?php
    echo get_avatar( 'geoff@geoffgraham.me', 75 );
		the_title( '<div class="post__title">', '</div>' );
    the_content();
	?>

  <footer class="post__footer">
    <img src="
      <?php
        print get_avatar_url(get_current_user_id(),
        ['size' => '30']); 
      ?>"
    >
    <span class="post__date"><?php the_date( 'M d, Y' );?></span>
  </footer>

</article>