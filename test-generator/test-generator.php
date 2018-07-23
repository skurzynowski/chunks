<?php

namespace ot_group_travel\service;


use function GuzzleHttp\Psr7\str;

class Test_Generator {

	/**
	 * Test_Generator constructor.
	 */
	public function __construct() {
		return;
		add_action( 'generate-tests', array( $this, 'generate_tests' ) );
	}

	/**
	 *
	 */
	public function generate_tests() {
		$name   = 'group-travel-list.php';
		$handle = fopen( OT_GRTR_DIR . "model/" . $name, "r" );

		$results             = array();
		$results['filename'] = $name;
		$add                 = false;
		$counter             = 0;

		if ( $handle ) {
			while ( ( $line = fgets( $handle ) ) !== false ) {
				// process the line read.
				if ( false !== strpos( $line, 'namespace' ) ) {
					$results['namespace'] = $line;
				}

				if ( false !== strpos( $line, '{' ) && false !== strpos( $line, 'class' ) ) {
					$matches = array();
					preg_match( '/class\ (\w+)/', $line, $matches );
					$results['classname'] = $matches[1];
				}

				if ( false !== strpos( $line, '/*' ) ) {
					$add = true;
				}

				if ( true === $add ) {
					if ( false !== strpos( $line, 'function' ) ) {
						$matches = array();
						preg_match( '/function\ (\w+)/', $line, $matches );
						$results['functions'][ $counter ]['functionname'] = $matches[1];
					} else {
						$results['functions'][ $counter ][] = $line;
					}
				}

				if ( false !== strpos( $line, 'function' ) ) {
					$add = false;
					$counter ++;
				}
			}

			fclose( $handle );
		} else {
			// error opening the file.
		}

		$results['namespace'] = str_replace( 'namespace', 'use', $results['namespace'] );
		$results['namespace'] = str_replace( ';', '\\' . $results['classname'] . ';', $results['namespace'] );

		//TODO create file
		$test_file['file_header']     = file_get_contents( OT_GRTR_DIR . 'service/template-tests/header-file.php' );
		$test_file['file_header']     = str_replace( 'namespacename', $results['namespace'], $test_file['file_header'] );
		$test_file['file_header']     = str_replace( 'classname', $results['classname'], $test_file['file_header'] );
		$test_file['set_up']          = file_get_contents( OT_GRTR_DIR . 'service/template-tests/set-up-function.php' );
		$test_file['set_up']          = str_replace( 'classname', $results['classname'], $test_file['set_up'] );
		$content                      = '';
		$test_file['single_function'] = file_get_contents( OT_GRTR_DIR . 'service/template-tests/single-function.php' );
		foreach ( $results['functions'] as $function ) {
			$content .= str_replace( 'functionName', $function['functionname'], $test_file['single_function'] );
		}
		$test_file['single_function'] = $content;

		file_put_contents( strtolower( OT_GRTR_DIR . 'service/test-' . $results['filename']  ), implode( '', $test_file ) . '}' );
	}
}