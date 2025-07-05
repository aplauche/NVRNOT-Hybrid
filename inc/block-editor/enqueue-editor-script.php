<?php
/**
 * Add a script to the editor to allow client side modifications and tweaks
 *
 * @package nvrnot
 */

 namespace nvrnot;
 
/**
 * Prevents editors from adding unregistered core blocks to content or pages.
 *
 * @return void
 */
function enqueue_editor_mods_script() {
	wp_enqueue_script(
		'custom_editor_mods',
		get_template_directory_uri() . '/build/__theme/js/editor.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-element', 'wp-primitives' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_editor_mods_script' );