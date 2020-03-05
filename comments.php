<?php
/**
 * @package Geoff Graham
 */
if ( post_password_required() ) {
	return;
}
?>

<section class="comments">

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
		'title_reply'=>'Comments',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
);

comment_form($comments_args);
	?>

</section>
