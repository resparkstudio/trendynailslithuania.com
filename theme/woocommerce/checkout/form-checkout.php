<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */


if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);


if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

if (!is_user_logged_in()): ?>
	<p class="woocommerce-LoginLink body-normal-regular block ml-12 lg:ml-0">
		<?php esc_html_e("Esate registruotas vartotojas?", 'woocommerce'); ?> <a class="link-hover"
			href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=login'); ?>"><?php esc_html_e('Prisijunkite', 'woocommerce'); ?></a>
	</p>
<?php endif; ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout mt-7"
	action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<div class="checkout-columns grid grid-cols-12 gap-4">
		<!-- Left Column: Buyer Details -->
		<div class="checkout-column checkout-left col-span-4 ml-12 lg:ml-0 lg:col-span-12">

			<?php do_action('woocommerce_checkout_before_customer_details'); ?>

			<div id="customer_details">
				<div>
					<?php do_action('woocommerce_checkout_billing'); ?>
				</div>
				<div class="create-account-section">
					<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()): ?>
						<?php do_action('woocommerce_checkout_create_account'); ?>
					<?php endif; ?>
				</div>
			</div>

			<?php do_action('woocommerce_checkout_after_customer_details'); ?>
		</div>

		<!-- Middle Column: Shipping and Payment Methods -->
		<div class="checkout-column checkout-middle col-span-4 lg:ml-0 ml-6 lg:col-span-12">
			<div class="border-mid-gray border-b-[0.7px] pb-3 mb-7">
				<h3 class="heading-sm text-deep-dark-gray lg:text-[1rem] lg:leading-[1.25rem]">
					<?php esc_html_e('Pristatymas', '_tw'); ?>
				</h3>
			</div>
			<?php do_action('woocommerce_checkout_shipping'); ?>
			<div class="border-mid-gray border-b-[0.7px] pb-3 mb-7 mt-11 lg:mt-9">
				<h3 class="heading-sm text-deep-dark-gray lg:text-[1rem] lg:leading-[1.25rem]">
					<?php esc_html_e('Apmokėjimas', '_tw'); ?>
				</h3>
			</div>
			<div id="payment" class="woocommerce-checkout-payment">
				<?php if (WC()->cart->needs_payment()): ?>
					<?php wc_get_template('checkout/payment.php', ['checkout' => $checkout]); ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- Right Column: Order Summary -->
		<div class="checkout-column checkout-right col-span-4 pl-14 lg:pl-0 lg:col-span-12 lg:mt-9">
			<div class="bg-gray round-9">

				<h3 class="heading-sm text-deep-dark-gray body-normal-medium p-5">
					<?php esc_html_e('Užsakymo apžvalga', '_tw'); ?>
				</h3>
				<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action('woocommerce_checkout_order_review'); ?>
				</div>
			</div>

		</div>
	</div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>