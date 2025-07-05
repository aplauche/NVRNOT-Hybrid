<?php
/**
 * Register custom block category(ies).
 *
 * @package nvrnot
 */

 namespace nvrnot;
/**
 * Register_nvrnot_category
 *
 * @param array $categories block categories.
 * @return array $categories block categories.
 * @author nvrnot
 */
function register_nvrnot_category( $categories ) {
	$custom_block_category = [
		'slug'  => __( 'custom', 'nvrnot' ),
		'title' => __( 'Bespoke Blocks', 'nvrnot' ),
	];

	$categories_sorted    = [];
	$categories_sorted[0] = $custom_block_category;

	foreach ( $categories as $category ) {
		$categories_sorted[] = $category;
	}

	return $categories_sorted;
}

add_filter( 'block_categories_all', __NAMESPACE__ . '\register_nvrnot_category', 10, 1 );
