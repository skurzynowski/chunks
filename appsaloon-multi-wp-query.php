<?php

/**
 * Class Appsaloon_Custom_Loop
 * This is custom query and custom loop functions that i find in pluralsight module.
 */
class Appsaloon_Multi_Wp_Query {

	function use_reset_postdata( $my_query ) {
		if ( $my_query->have_posts() ): while ( $my_query->have_posts() ):
			$my_query->the_post();
			// do the post stuff
		endwhile;
			wp_reset_postdata();
		else:
			_e( 'Sorry no post found', 'test-domain' );
		endif;
	}

	function use_reset_query( $my_query ) {
		if ( $my_query->have_posts() ): while ( $my_query->have_posts() ):
			$my_query->the_post();
			// do the post stuff
		endwhile;
		else:
			_e( 'Sorry no post found', 'test-domain' );
		endif;
		wp_reset_query();
	}

	function use_rewind_loop( $my_query ) {
		while ( have_posts() ):
			the_post();
			// do the post stuff
		endwhile;

		rewind_posts();
		while ( have_posts() ):
			the_post();
			// do the post stuff
		endwhile;
	}
}
