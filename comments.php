<?php
/**
 * @package Geoff Graham
 */
if ( post_password_required() ) {
	return;
}
?>

<section class="comments">

	<?php
		if ( have_comments() ) :
	?>
	<h2 class="comments__title">Comments</h2>

	<ol class="comments__list">
		<?php wp_list_comments("callback=gg_comments"); ?>
	</ol>

	<?php the_comments_navigation();

	if ( ! comments_open() ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'geoff-graham' ); ?></p>
		<?php
	endif;

	endif;

	comment_form();
	?>

</section>
