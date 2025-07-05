<?php
/**
 * Enqueue scripts and styles.
 *
 * @package nvrnot
 */

 namespace nvrnot;

/**
 * Enqueue scripts and styles.
 *
 * @author nvrnot
 */
function scripts() {
	$asset_file_path = \nvrnot\ROOT_URL . '/build/__theme/js/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '0.1.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	// Register styles & scripts.
	wp_enqueue_style( 'nvrnot-styles', \nvrnot\ROOT_URL . '/build/__theme/css/main.css', [], $asset_file['version'] );
	
	// Primary script with 
	wp_enqueue_script( 'nvrnot-scripts', \nvrnot\ROOT_URL . '/build/__theme/js/index.js', $asset_file['dependencies'], $asset_file['version'], true );
	

	// TODO: update nonce
	// Add admin-ajax and nonce support
	wp_localize_script('nvrnot-scripts', 'filterAjax', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('favorite_nonce'),
	]);

	// Add admin-ajax and nonce support
	wp_localize_script('nvrnot-scripts', 'favoriteAjax', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('favorite_nonce'),
	]);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' );
