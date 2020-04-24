<article class="post-single">

	<?php the_title( '<h2 class="post-single__title">', '</h2>' ); ?>
	<div class="post-single__date">
		<?php 
			echo the_date('F j, Y');
			$j_date = get_the_date('j');
			$j_modified_date = get_the_modified_time('j');
			if ($j_modified_date >= $j_date + 1) { 
				echo "<span>Updated: " . get_the_modified_time('n/d/Y') . "</span>";
			}
		?>
	</div>
	<div class="post-single__body">
		<?php echo the_content(); ?>
	</div>

</article>