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
		<h2>Comments</h2>
	<?php endif; ?>
	
	<ol class="comments__list">
		<?php wp_list_comments("callback=gg_comments"); ?>
	</ol>

	<?php the_comments_navigation();

	if ( ! comments_open() ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'geoff-graham' ); ?></p>
		<?php
	endif;

	$comments_args = array(
		'title_reply_before' => '<h2 class="comment-reply-title">',
		'title_reply_after' => '</h2>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Keep calm and comment on."></textarea></p>',
);
	comment_form($comments_args);
	?>

</section>
