<article class="post one-liner">

	<?php
		the_title( '<div class="post-title">', '</div>' );
    the_content();
	?>

  <footer class="post-footer">
    <img src="
      <?php
        print get_avatar_url( get_current_user_id(),
        ['size' => '30'] ); 
      ?>"
    >
    <time class="post-date">
      <?php the_time( get_option( 'date_format' ) ) ?> 
      at 
      <a href="<?php the_permalink() ?>">
        <?php the_time( 'g:i a' ); ?>
      </a>
    </time>
  </footer>

</article>