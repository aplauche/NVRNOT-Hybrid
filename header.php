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

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<style>
		[x-cloak] {
			display: none;
		}
	</style>

	<?php
	wp_head();
	?>

</head>

<body <?php body_class('site-wrapper'); ?>>

	<?php wp_body_open(); ?>

	<div class="wp-site-blocks">
		<header class="wp-block-template-part site-header is-layout-constrained has-global-padding ">
			<nav class="header__inner py-16 bg-white rounded-md px-16">
				<!-- Logo -->
				<a class="header__logo" href="<?php echo home_url() ?>">NVRNOT</a>

				<!-- Burger icon -->
				<div class="menu-toggle-container">
					<label for="menu-toggle" class="cursor-pointer lg:d-none">
						<svg style="width: 16px; height: 16px" fill="none" stroke="currentColor" stroke-width="2"
							viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
							<path d="M4 6h16M4 12h16M4 18h16"></path>
						</svg>
					</label>

					<!-- Hidden checkbox controls menu visibility -->
					<input type="checkbox" id="menu-toggle" class="visually-hidden" aria-label="Open Menu" />
				</div>

				<!-- Navigation -->
				<?php nvrnot\menuBuilderNoJs\render_menu("primary") ?>
			</nav>
		</header>