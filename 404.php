<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package nvrnot
 */

get_header(); ?>

	<main id="main">

		<section class="error-404 not-found is-layout-constrained">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( "Sorry, this page doesn't exist.", 'nvrnot' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">

				<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'nvrnot' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php get_footer(); ?>