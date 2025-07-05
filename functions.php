<?php

namespace nvrnot;

// Define a global path and url.
define( 'nvrnot\ROOT_PATH', trailingslashit( get_template_directory() ) );
define( 'nvrnot\ROOT_URL', trailingslashit( get_template_directory_uri() ) );


 /**
 * Get all the include files for the theme.
 *
 * @author nvrnot
 */
function include_inc_files() {
	$files = [
		'inc/functions/', // Custom functions and general setup
		'inc/block-editor/', // Customize blocks and block editor behavior.
		'inc/post-types/', // Initialize custom post types and taxonomies
	];

	foreach ( $files as $include ) {
		$include = trailingslashit( get_template_directory() ) . $include;

		// Allows inclusion of individual files or all .php files in a directory.
		if ( is_dir( $include ) ) {
			foreach ( glob( $include . '*.php' ) as $file ) {
				require $file;
			}
		} else {
			require $include;
		}
	}
}

include_inc_files();