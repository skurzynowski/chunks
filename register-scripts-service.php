<?php
/**
 * Created by PhpStorm.
 * User: sebastian
 * Date: 10/28/17
 * Time: 9:06 AM
 */

namespace ot_flights\services;

/**
 * This object is to register jquery datepicker
 *
 * Class Datepicker_Handler
 * @package ot_flights\model
 */
abstract class Register_Scripts_Service {
	/**
	 * Register_Scripts_Service constructor.
	 *
	 * @param array $script
	 */
	public function __construct( array $script ) {
		if ( ! empty( $script ) ) {
			$this->register_scripts( $script );
		}
	}

	/**
	 * @param array $scripts array(
	 * 'dependencies' => array( string, string  )
	 * 'slug'         => slug to register
	 * 'script'       => url_to_file_on_server
	 * 'hook'         => hook to register script
	 * )
	 */
	public function register_scripts( array $scripts ) {
			/**
			 * this values are filled by array exctratcion
			 */
			$slug = '';
			$script= '';
			$dependencies= '';
			$version = '';
			$load_in_footer = '';
			$localize = '';
		foreach ( $scripts as $script_arg ) {
			extract( $this->parse_arguments( $script_arg ) );
			if ( $this->script_exist( $script ) ) {
				/**
				 * add script with correct hook
				 */
				wp_enqueue_script( $slug, $script, $dependencies, $version, $load_in_footer );
				/**
				 * check if should localize
				 */
				if ( $this->should_localize( $localize ) ) {
					$this->localize_scripts( $slug, $localize );
				}
			}
		}
	}

	/**
	 * @param array $arguments
	 *
	 * @return array
	 * parse with defaults
	 * //TODO add containter to store all defaultes values in application
	 */
	public function parse_arguments( array $arguments ) {
		$defaults = array(
			'dependencies'   => array(),
			'slug'           => 'random-slug',
			'script'         => '',
			'hook'           => 'wp_enqueue_scripts',
			'load_in_footer' => false,
			'version'        => false,
			'localize'       => false
		);

		return wp_parse_args( $arguments, $defaults );
	}

	/**
	 * Return if script exist
	 *
	 * @param $script
	 *
	 * change URL path into DIRECTORY and check if file exists
	 *
	 * @return bool
	 */
	public function script_exist( $script ) {
		$exploaded_array = explode( '/', $script );
		$file_name       = $exploaded_array[ count( $exploaded_array ) - 1 ];
		$file_with_dir   = OT_FLIGHTS_DIR . 'assets/js/' . $file_name;

		return file_exists( $file_with_dir );
	}

	/**
	 * @param $localize_parameter
	 *
	 * @return bool
	 */
	public function should_localize( $localize_parameter ) {
		return ! empty( $localize_parameter );
	}

	/**
	 * @param string $slug
	 * @param array $localize_object
	 */
	public function localize_scripts( string $slug,  array $localize_object ) {
		wp_localize_script( $slug, 'localized_object',  $localize_object);
	}
}
