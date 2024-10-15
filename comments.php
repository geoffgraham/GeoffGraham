<?php
/**
 * @package Geoff Graham
 */
if ( post_password_required() ) {
	return;
}
?>

<section class="comments">
	<?php if ( have_comments() ) : ?>
		<details>
    <summary>  
      <h2><?php echo get_comments_number(); ?> Comments</h2>
    </summary>
	<?php endif; ?>
	
	<ol class="comments__list">
		<?php wp_list_comments("callback=gg_comments"); ?>
	</ol>

	<?php the_comments_navigation(); ?>

  <?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'geoff-graham' ); ?></p>
  <?php endif; ?>

	<?php 
  $comments_args = array(
		'title_reply_before' => '<h2 class="comment-reply-title">',
		'title_reply_after' => '</h2>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Your Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Keep calm and comment on."></textarea></p>',
    'class_submit' => 'button'
  );
	comment_form($comments_args);
	?>
  </details>

</section>
