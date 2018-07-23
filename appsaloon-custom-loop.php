<?php

/**
 * Class Appsaloon_Custom_Loop
 * This is custom query and custom loop functions that i find in pluralsight module.
 */
class Appsaloon_Custom_Loop {


	/**
	 * Appsaloon_Custom_Loop constructor.
	 */
	public function __construct() {
		add_action( 'pre_get_posts', array( $this, 'exclude_category' ) );
		add_action( 'pre_get_posts', array( $this, 'search_soccer_players' ) );
		add_action( 'pre_get_posts', array( $this, 'change_post_per_page' ) );
	}

	//exclude categories
	function exclude_category( $query ) {
		if ( $query->is_home() && $query->is_main_query() ) {
			$query->set( 'cat', '-1,-1347' );
		}
	}

	//get only posts in search that are custom post type :soccer_player
	function search_soccer_players( $query ) {
		if ( ! $query->is_admin() && $query->is_main_query() ) {
			if ( $query->is_search() ) {
				$query->set( 'post_type', 'soccer_player' );
			}
		}
	}

	function change_post_per_page( $query ) {
		if ( ! $query->is_admin() && $query->is_main_query() ) {
			if ( is_post_type_archive('soccer_players') ) {
				$query->set( 'post_per_page', 25 );
			}
		}
	}


}
