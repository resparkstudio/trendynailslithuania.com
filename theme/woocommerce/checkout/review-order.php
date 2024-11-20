<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="cart-summary">

	<div class="bg-white px-5 lg:px-4">
		<?php wc_get_template('checkout/checkout-product-list.php'); ?>
	</div>
	<div class="px-5 lg:px-4 mt-7 mb-8 lg:mt-5">
		<?php wc_get_template('checkout/cart-summary-details.php'); ?>
	</div>

	<div class="discount-code w-full px-5 lg:px-4">
		<label class="inline-block mb-4"
			for="discount-code"><?php echo wp_kses_post("Įveskite nuolaidos kodą:") ?></label>
		<div class="discount-input-wrapper mb-5 flex justify-between relative">
			<input class="checkout-form-input" type="text" id="discount-code" name="discount-code" />
			<button type="button" class="apply-discount-button absolute inset-y-0 right-4"
				style="background: none; border: none; cursor: pointer; padding: 0;">
				<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80735 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
						fill="#201F1F" />
				</svg>
			</button>
		</div>
	</div>


	<div class="terms w-full px-5 lg:px-4 mb-6 lg:mb-8">
		<label class="flex">
			<input class="input-checkbox " type="checkbox" required>
			<span class="body-extra-small-light">
				<?php echo wp_kses_post("Su el. prekybos taisyklėmis susipažinau ir sutinku") ?></span>
		</label>
	</div>

	<div class="w-full px-5 lg:px-4 pb-5">
		<button class="checkout-button black-button w-full py-3"><?php echo wp_kses_post("Apmokėti") ?></button>
	</div>
</div>