<?php
/**
 * The main template file
 *
 * @package Geoff_Graham
 */

get_header();
?>
	<main class="main-content posts">

		<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>

	</main>
	
	<?php get_footer() ?>