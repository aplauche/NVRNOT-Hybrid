<?php
/**
 * Registers custom block pattern categories.
 *
 * @package nvrnot
 */

 namespace nvrnot;
/**
 * Registers custom block pattern categories.
 */
function register_custom_block_pattern_categories() {

	register_block_pattern_category(
		'content',
		array(
			'label'       => __( 'Content', 'nvrnot' ),
			'description' => __( 'A collection of content patterns', 'nvrnot' ),
		)
	);
	register_block_pattern_category(
		'hero',
		array(
			'label'       => __( 'Hero', 'nvrnot' ),
			'description' => __( 'A collection of hero patterns', 'nvrnot' ),
		)
	);
	register_block_pattern_category(
		'page',
		array(
			'label'       => __( 'Pages', 'nvrnot' ),
			'description' => __( 'A collection of page patterns', 'nvrnot' ),
		)
	);
	register_block_pattern_category(
		'template',
		array(
			'label'       => __( 'Templates', 'nvrnot' ),
			'description' => __( 'A collection of template patterns', 'nvrnot' ),
		)
	);

	// Remove default patterns.
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'init', __NAMESPACE__ . '\register_custom_block_pattern_categories', 9 );
