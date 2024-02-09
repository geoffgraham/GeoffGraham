<article class="post">

	<?php
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
    <span class="post__date"><?php the_time( get_option( 'date_format' ) ); ?></span>
  </footer>

</article>