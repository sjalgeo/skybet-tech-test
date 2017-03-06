<?php

/**
 * Class SB_Test_Autoloader
 */
class SB_Test_Autoloader {
	/**
	 * Determines the server path for the plugin's 'includes'
	 * folder based the location of the current file.
	 *
	 * @return string
	 */
	private function determine_file_path() {
		$folder = realpath( __FILE__ );
		$folder = str_replace( 'autoload.php', 'includes', $folder );
		return $folder;
	}

	/**
	 * Determines the path and filename of the required
	 * class based on its Name and Namespace.
	 *
	 * @param string $class_name    Class path referenced by Namespace.
	 * @return string               The name of the class file.
	 */
	private function determine_class_name( $class_name ) {
		$class_name = str_replace( 'SBTechTest', '', $class_name );
		$class_name = str_replace( '_', '-', $class_name );
		$class_name = strtolower( $class_name );
		return $class_name . '.php';
	}

	/**
	 * Ensures the path to be required does not use anny double slashes.
	 * Replaces any form of slashes with the system directory separator.
	 *
	 * @param string $path      Current file path.
	 * @return string
	 */
	private function validate_path( $path ) {
		return str_replace( array( '\\', '//' ), DIRECTORY_SEPARATOR, $path );
	}

	public function determine_file_path_from_namespaced_class( $class_name ) {
		$full_path = $this->determine_file_path() . DIRECTORY_SEPARATOR . $this->determine_class_name( $class_name );
		return $this->validate_path( $full_path );
	}

	/**
	 * Locates and autoloads the
	 * class files related to this project.
	 *
	 * @param string $class_name    The passed Class Name including Namespace.
	 */
	public function autoload_function( $class_name ) {
		if ( false === strpos( $class_name, 'SBTechTest' ) ) {
			return;
		}

		$full_path = $this->determine_file_path_from_namespaced_class( $class_name );

		if ( file_exists( $full_path ) ) {
			require_once( $full_path );
		} else {
			var_dump( 'Failed: ' . $full_path );
		}
	}
}

spl_autoload_register( array( new SB_Test_Autoloader(), 'autoload_function' ) );