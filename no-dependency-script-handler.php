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
class No_Dependency_Script_Handler extends Register_Scripts_Service {

	/**
	 * Datepicker_Handler constructor.
	 *
	 * @param array $scripts array(
	 * 'dependencies' => array( string, string  )
	 * 'slug'         => slug to register
	 * 'script'       => url_to_file_on_server
	 * 'hook'         => hook to register script
	 * )
	 */
	public function __construct( array $scripts ) {
		parent::__construct( $scripts );
	}
}