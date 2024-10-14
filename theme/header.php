<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _tw
 */

?><!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="page">
		<a href="#content" class="sr-only"><?php esc_html_e('Skip to content', '_tw'); ?></a>

		<header class="site-header">
			<div class="header-inner">
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'header-menu',
						'menu_id' => 'primary-menu',
					));
					?>
				</nav>

				<div class="site-logo">
					<?php
					the_custom_logo();
					?>
				</div>

				<div class="header-icons">
					<a href="#" class="search-icon">
						<?php get_product_search_form(); ?>
					</a>

					<a href="<?php echo esc_url(home_url('/favorites')); ?>" class="favorites-icon">
						<i class="fas fa-heart"></i>
					</a>

					<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"
						class="account-icon">
						<i class="fas fa-user"></i>
					</a>

					<a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon">
						<i class="fas fa-shopping-bag"></i>
						<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					</a>
				</div>
			</div>
		</header>
		<div id="content">