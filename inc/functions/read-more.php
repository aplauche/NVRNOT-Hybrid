<?php 

namespace nvrnot;

/**
 * Change Read More from default [...]
 */
function custom_read_more_excerpt( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
 }
 add_filter( 'excerpt_more', __NAMESPACE__ . '\custom_read_more_excerpt', 999 );