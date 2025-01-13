<?php
/**
 * Checkout billing and shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="woocommerce-billing-fields text-deep-dark-gray">
	<div class="border-mid-gray border-b-[0.7px] pb-3 mb-5 lg:mb-5">
		<h3 class="heading-sm text-deep-dark-gray lg:text-[1rem] lg:leading-[1.25rem]">
			<?php esc_html_e('Pirkėjo duomenys', 'woocommerce'); ?>
		</h3>
	</div>

	<div class="woocommerce-billing-fields__field-wrapper space-y-4">
		<?php
		$billing_fields = $checkout->get_checkout_fields('billing');

		$custom_label_class = ['checkout-form-label'];
		$custom_input_class = ['checkout-form-input'];

		foreach ($billing_fields as $key => $field) {
			$field['label_class'] = isset($field['label_class'])
				? array_merge($field['label_class'], $custom_label_class)
				: $custom_label_class;

			$field['input_class'] = isset($field['input_class'])
				? array_merge($field['input_class'], $custom_input_class)
				: $custom_input_class;

			woocommerce_form_field($key, $field, $checkout->get_value($key));
		}
		?>
	</div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>

<div class="woocommerce-shipping-fields text-deep-dark-gray">
	<div class="woocommerce-shipping-fields__field-wrapper space-y-4">
		<?php
		$shipping_fields = $checkout->get_checkout_fields('shipping');

		foreach ($shipping_fields as $key => $field) {
			$field['label_class'] = isset($field['label_class'])
				? array_merge($field['label_class'], $custom_label_class)
				: $custom_label_class;

			$field['input_class'] = isset($field['input_class'])
				? array_merge($field['input_class'], $custom_input_class)
				: $custom_input_class;

			woocommerce_form_field($key, $field, $checkout->get_value($key));
		}
		?>
	</div>

	<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
</div>

<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()): ?>
	<div class="woocommerce-account-fields">
		<?php if (!$checkout->is_registration_required()): ?>
			<div class="flex">
				<p class="form-row form-row-wide create-account">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
							id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?>
							type="checkbox" name="createaccount" value="1" />
						<div class="text-black body-small-regular mb-3">
							<?php esc_html_e('Norite sukurti paskyrą?', 'woocommerce'); ?>
						</div>
					</label>
				</p>
			</div>
		<?php endif; ?>

		<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

		<?php if ($checkout->get_checkout_fields('account')): ?>
			<div
				class="create-account flex justify-between gap-x-2 lg:gap-x-4 max-1200px:flex-wrap lg:flex-nowrap max-360px:flex-wrap">
				<?php foreach ($checkout->get_checkout_fields('account') as $key => $field): ?>
					<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

		<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
	</div>
<?php endif; ?>