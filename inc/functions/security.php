<?php

/**
 * Security functions.
 *
 * Enable or disable certain functionality to harden WordPress.
 *
 * @package nvrnot
 */

 namespace nvrnot;
/**
 * Remove generator meta tags.
 *
 * @author nvrnot
 * @see https://developer.wordpress.org/reference/functions/the_generator/
 */
add_filter('the_generator', '__return_false');

/**
 * Disable XML RPC.
 *
 * @author nvrnot
 * @see https://developer.wordpress.org/reference/hooks/xmlrpc_enabled/
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Change REST-API header from "null" to "*".
 *
 * @author nvrnot
 * @see https://w3c.github.io/webappsec-cors-for-developers/#avoid-returning-access-control-allow-origin-null
 */
function cors_control()
{
  header('Access-Control-Allow-Origin: *');
}
add_action('rest_api_init', __NAMESPACE__ . '\cors_control');
