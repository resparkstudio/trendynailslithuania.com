<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
?>

<div class="account-navigation-wrap w-full col-span-3 lg:col-span-4 md:col-span-5 sm:col-span-6">
	<div class="ml-12 md:ml-4">
		<header id="heading-section">
			<h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo wp_kses_post("Mano paskyra"); ?></h1>
		</header>
		<nav class="woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">
			<ul class="space-y-4">
				<?php foreach (wc_get_account_menu_items() as $endpoint => $label): ?>
					<?php
					$is_current = wc_is_current_account_menu_item($endpoint);
					?>
					<li class="<?php echo esc_attr(wc_get_account_menu_item_classes($endpoint)); ?>">
						<a class="link-hover <?php echo $is_current ? 'link-active' : ''; ?>"
							href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
							<?php echo esc_html($label); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</div>

<?php do_action('woocommerce_after_account_navigation'); ?>