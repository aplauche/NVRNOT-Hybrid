<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header is-layout-constrained has-global-padding">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content is-layout-constrained has-global-padding">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer is-layout-constrained has-global-padding">
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-## -->
