<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
    the_title( '<h1 class="entry-title">', '</h1>' );
    the_content();

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // End of the loop.


do_shortcode('[dafater-report-form]');

get_footer();
?>