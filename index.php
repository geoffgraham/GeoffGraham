<?php
/**
 * The main template file
 *
 * @package Geoff_Graham
 */

get_header();
?>
	<main class="main-content posts">

		<?php echo the_content(); ?>

	</main>
	
	<?php get_footer() ?>