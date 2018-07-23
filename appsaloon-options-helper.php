<?php

namespace wp_gdpr\lib;

final class Gdpr_Options_Helper {
	public static function add_option( $name, $value ) {
		update_option( $name, $value );
	}

	public static function switch_option( $name ) {
		$value = get_option( $name, null );
		if ( empty( get_option( $value ) || 0 === $value ) ) {
			update_option( $name, 1 );
		} else {
			update_option( $name, 0 );
		}
	}

	/**
	 * @param $name
	 *
	 * @return bool
	 * Checks if function is switched on.
	 */
	public static function is_option_on( $name ) {
		$value = get_option( $name, null );
		if ( empty( get_option( $value ) || 0 === $value ) ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * @param $name
	 *
	 * @return bool
	 * Checks if function is switched off.
	 */
	public static function is_option_off( $name ) {
		$value = get_option( $name, null );
		if ( empty( get_option( $value ) || 0 === $value ) ) {
			return true;
		} else {
			return false;
		}
	}
}
