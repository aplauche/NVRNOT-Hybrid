<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */


?>

<article <?php post_class( 'post-container' ); ?>>

	<header class="entry-header is-layout-constrained has-global-padding">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'poem' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php echo get_field('author') ? 'By: ' . get_field('author') : '' ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content is-layout-constrained has-global-padding">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer is-layout-constrained has-global-padding">
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
