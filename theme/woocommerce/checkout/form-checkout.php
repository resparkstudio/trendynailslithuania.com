<?php
/**
 * Checkout Form Template Override
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

if (!is_user_logged_in()): ?>
	<p class="woocommerce-LoginLink body-normal-regular block">
		<?php esc_html_e("Esate registruotas vartotojas?", 'woocommerce'); ?> <a class="link-hover"
			href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=login'); ?>"><?php esc_html_e('Prisijunkite', 'woocommerce'); ?></a>
	</p>
<?php endif; ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout mt-7"
	action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<div class="checkout-columns grid grid-cols-12 gap-4">
		<!-- Left Column: Buyer Details -->
		<div class="checkout-column checkout-left col-span-4">

			<?php do_action('woocommerce_checkout_before_customer_details'); ?>

			<div id="customer_details">
				<div>
					<?php do_action('woocommerce_checkout_billing'); ?>
				</div>
				<div class="create-account-section">
					<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()): ?>
						<h4><?php esc_html_e('Create an Account', '_tw'); ?></h4>
						<?php do_action('woocommerce_checkout_create_account'); ?>
					<?php endif; ?>
				</div>
			</div>

			<?php do_action('woocommerce_checkout_after_customer_details'); ?>
		</div>

		<!-- Middle Column: Shipping and Payment Methods -->
		<div class="checkout-column checkout-middle col-span-4">
			<h3><?php esc_html_e('Shipping', '_tw'); ?></h3>
			<?php do_action('woocommerce_checkout_shipping'); ?>

			<h3><?php esc_html_e('Payment', '_tw'); ?></h3>
			<?php do_action('woocommerce_checkout_payment'); ?>
		</div>

		<!-- Right Column: Order Summary -->
		<div class="checkout-column checkout-right col-span-4">
			<h3><?php esc_html_e('Order Summary', '_tw'); ?></h3>
			<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action('woocommerce_checkout_order_review'); ?>
			</div>
		</div>
	</div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>