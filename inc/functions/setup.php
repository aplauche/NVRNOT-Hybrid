<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package nvrnot
 */

 namespace nvrnot;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @author nvrnot
 */
function setup_theme() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'nvrnot', get_template_directory() . '/build/languages' );

	// adds default block styling - you can remove if you are doing something highly custom
	add_theme_support( 'wp-block-styles' );

	// Gutenberg support for full-width/wide alignment of supported blocks.
	add_theme_support( 'align-wide' );

	// Menus
	register_nav_menus(
		[
			'primary' => esc_html__( 'Primary Menu', 'nvrnot' ),
		]
	);

	// Remove core block patterns.
	remove_theme_support( 'core-block-patterns' );

	// Gutenberg editor styles support.
	add_theme_support( 'editor-styles' );

	// Add a custom stylesheet to editor
	add_editor_style( 'build/__theme/css/editor.css' );

	remove_action( 'wp_footer', 'the_block_template_skip_link' );

	// Add WooCommerce support.
	// add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\setup_theme' );

/**
* Make sure elements masked for GSAP and alpine are displayed if JS is not enabled for accessibility
*/
add_action('wp_head', function(){
  echo "<noscript><style>.gsap-mask{opacity: inherit; visibility: inherit;}</style></noscript>";
});



