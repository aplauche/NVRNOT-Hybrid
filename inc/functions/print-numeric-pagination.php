<?php
/**
 * Displays numeric pagination on archive pages.
 *
 * @package nvrnot
 */

 namespace nvrnot;

/**
 * Displays numeric pagination on archive pages.
 *
 *
 * @param array    $args  Array of params to customize output.
 * @param WP_Query $query The Query object; only passed if a custom WP_Query is used.
 */
function print_numeric_pagination( $args = [], $query = null ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Make the pagination work on custom query loops.
	$total_pages = isset( $query->max_num_pages ) ? $query->max_num_pages : 1;

	// Set defaults.
	$defaults = [
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'mid_size'  => 4,
		'total'     => $total_pages,
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	if ( null === paginate_links( $args ) ) {
		return;
	}
	?>

	<div class="is-layout-constrained has-global-padding">
		<nav class="pagination-container" aria-label="<?php esc_attr_e( 'numeric pagination', 'nvrnot' ); ?>">
			<?php echo paginate_links( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK. ?>
		</nav>
	</div>

	<?php
}
