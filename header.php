<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nvrnot
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<style>
		[x-cloak] {display: none;}
	</style>

	<?php
	wp_head();
	?>

</head>

<body <?php body_class( 'site-wrapper' ); ?>>

	<?php wp_body_open(); ?>

	<div class="wp-site-blocks">
		<header class="wp-block-template-part site-header is-layout-constrained has-global-padding">
			<div class="header__inner">
				<a class="header__logo" href="<?php echo home_url() ?>">NN</a>
				<nav>
					<?php \nvrnot\render_bootstrap_menu("main_menu") ?>
				</nav>
			</div>
		</header>


