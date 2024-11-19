<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="woocommerce-shipping-fields">
	<?php if (true === WC()->cart->needs_shipping()): ?>
		<div class="shipping-methods">
			<form method="post" id="shipping-methods-form">
				<?php
				$packages = WC()->shipping->get_packages(); // Retrieve shipping packages
				foreach ($packages as $package_id => $package) {
					$available_methods = $package['rates']; // Get available shipping methods
					$chosen_method = isset(WC()->session->get('chosen_shipping_methods')[$package_id]) ? WC()->session->get('chosen_shipping_methods')[$package_id] : '';

					if (!empty($available_methods)) {
						foreach ($available_methods as $method_id => $method) {
							?>
							<div class="shipping-method">
								<input type="radio" name="shipping_method[<?php echo esc_attr($package_id); ?>]"
									id="shipping_method_<?php echo esc_attr($method_id); ?>" value="<?php echo esc_attr($method_id); ?>"
									<?php checked($chosen_method, $method_id); ?> />
								<label for="shipping_method_<?php echo esc_attr($method_id); ?>">
									<?php echo esc_html($method->get_label()); ?>
									(<?php echo wc_price($method->get_cost()); ?>)
								</label>
							</div>
							<?php
						}
					} else {
						echo '<p>' . esc_html__('No shipping methods available.', 'woocommerce') . '</p>';
					}
				}
				?>
				<button type="submit" name="save_shipping_methods"
					class="button"><?php esc_html_e('Save Shipping Method', 'woocommerce'); ?></button>
			</form>
		</div>
	<?php endif; ?>
</div>