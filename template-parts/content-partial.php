<?php 
	while ( have_posts() ) : the_post();
		
		get_template_part( 'template-parts/content', 'single' );

		// Previous/next post navigation.
		astra_number_pagination();
	endwhile;
?>