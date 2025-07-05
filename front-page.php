<?php
/**
 * The template used to render your site’s front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 */


get_header(); ?>

		<main id="main" class="main">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();?>


					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content is-layout-constrained has-global-padding">
							<?php
							the_content();
							?>
						</div><!-- .entry-content -->

					</article><!-- #post-## -->
					

				<?php endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

		</main><!-- #main -->

<?php get_footer(); ?>
