<?php
defined('ABSPATH') || exit;
?>
<?php do_action('woocommerce_before_checkout_shipping_form'); ?>
<div class="woocommerce-shipping-fields">
	<?php if (true === WC()->cart->needs_shipping()): ?>
		<div class="shipping-methods space-y-4">
			<?php
			$packages = WC()->shipping->get_packages(); // Retrieve shipping packages
			foreach ($packages as $package_id => $package) {
				$available_methods = $package['rates']; // Get available shipping methods
				$chosen_method = isset(WC()->session->get('chosen_shipping_methods')[$package_id]) ? WC()->session->get('chosen_shipping_methods')[$package_id] : '';

				if (!empty($available_methods)) {
					foreach ($available_methods as $method_id => $method) {
						?>
						<div class="shipping-method flex flex-wrap gap-x-2 items-center text-black">
							<input class="custom-radio shrink-0" type="radio"
								name="shipping_method[<?php echo esc_attr($package_id); ?>]"
								id="shipping_method_<?php echo esc_attr($method_id); ?>" value="<?php echo esc_attr($method_id); ?>"
								<?php checked($chosen_method, $method_id); ?> />
							<label for="shipping_method_<?php echo esc_attr($method_id); ?>">
								<span
									class="body-small-normal text-black"><?php echo esc_html($method->get_label()); ?><?php echo wp_kses_post(":"); ?></span>
								<span class="body-small-semibold"><?php echo wc_price($method->get_cost()); ?></span>
							</label>
						</div>
						<?php
					}
				} else {
					echo '<p class = "body-normal-regular text-deep-dark-gray">' . esc_html__('Nėra galimų pristatymo būdų.', 'woocommerce') . '</p>';
				}
			}
			?>
		</div>
	<?php endif; ?>
</div>

<?php do_action('woocommerce_after_checkout_shipping_form'); ?>