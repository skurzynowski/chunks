<?php

namespace test\amespace;

class Appsaloon_Endpoint_Factory {
//TODO add one more class to register enpoint
	/**
	 * Appsaloon_Endpoint constructor.
	 */
	//TODO make object from this to register every callback with all necessary data
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'add_endpoint' ) );
	}


	public function add_endpoint() {
		register_rest_route(
			'myplugin/v1',
			'/author/(?P<id>\d+)',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'my_awesome_func' ),
				'args'                => array(
					'id'   => array(
						'required'          => true,
						'validate_callback' => function ( $param, $request, $key ) {
							return is_numeric( $param );
						},
						'sanitize_callback' => 'absint'
					),
					'name' => array(
						'required'          => true,
						'validate_callback' => function ( $param, $request, $key ) {
							return is_string( $param );
						},
						'sanitize_callback'
						                    => function ( $param, $request, $key ) {
							return strip_tags( $param );
						},
					)
				),
				'permission_callback' => function () {
					return current_user_can( 'edit_others_posts' );
				}
			)
		);
	}

	public function add_script() {
		//add script
		//wp_enque_scripts
		//localize script
		//wp_localize_script

		//TODO add nonce for js in localize script
		wp_localize_script( 'wp-api', 'wpApiSettings', array(
			'root'  => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' )
		) );

		//TODO to add in js for validation
//		options.beforeSend = function(xhr) {
//			xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
//
//			if (beforeSend) {
//				return beforeSend.apply(this, arguments);
//			}
//		};
	}

	public function my_awesome_callback( WP_REST_Request $request ) {
		// You can access parameters via direct array access on the object:
//		$param = $request['some_param'];
//
//		// Or via the helper method:
//		$param = $request->get_param( 'some_param' );
//
//		// You can get the combined, merged set of parameters:
//		$parameters = $request->get_params();
//
//		// The individual sets of parameters are also available, if needed:
//		$parameters = $request->get_url_params();
//		$parameters = $request->get_query_params();
//		$parameters = $request->get_body_params();
//		$parameters = $request->get_json_params();
//		$parameters = $request->get_default_params();
//
//		// Uploads aren't merged in, but can be accessed separately:
//		$parameters = $request->get_file_params();
		return $request;
	}
}