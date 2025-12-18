<?php

/**
 * Review order table (Tailwind Flexbox version)
 *
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>

<div class="shop_table woocommerce-checkout-review-order-table flex flex-col gap-2 bg-light-gray p-10 rounded-md">

	<!-- Header -->
	<div class="flex bg-gray-100 font-semibold rounded-t-lg">
		<div class="flex-1 text-left"><?php esc_html_e('Product', 'woocommerce'); ?></div>
		<div class="w-32 text-right"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
	</div>

	<!-- Cart Items -->
	<div class="">
		<?php do_action('woocommerce_review_order_before_cart_contents'); ?>

		<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
			<?php
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0 || !apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
				continue;
			}
			?>
			<div class="flex items-start p-4 bg-white rounded shadow-sm">
				<?php
				$featured_img_id = $_product->get_image_id();
				if ($featured_img_id) {
					echo wp_get_attachment_image($featured_img_id, 'thumbnail', false, [
						'class' => 'w-20 h-24 object-cover mr-4 rounded-lg gallery-image'
					]);
				}
				?>
				<div class="flex-1">
					<?php
					echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;';
					echo apply_filters('woocommerce_checkout_cart_item_quantity', '<strong class="product-quantity">&times;&nbsp;' . esc_html($cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key);
					echo wc_get_formatted_cart_item_data($cart_item);
					?>
				</div>
				<div class="w-32 text-right">
					<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
				</div>
			</div>
		<?php endforeach; ?>

		<?php do_action('woocommerce_review_order_after_cart_contents'); ?>
	</div>

	<!-- Totals -->
	<div class="pt-4">
		<div class="flex justify-between font-semibold">
			<div><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
			<div><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>

		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<div class="flex justify-between">
				<div><?php wc_cart_totals_coupon_label($coupon); ?></div>
				<div><?php wc_cart_totals_coupon_html($coupon); ?></div>
			</div>
		<?php endforeach; ?>

		<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
			<?php do_action('woocommerce_review_order_before_shipping'); ?>
			<div class="flex flex-col gap-4 pt-6 mt-6 border-t border-mid-gray">
				<?php wc_cart_totals_shipping_html(); ?>
			</div>
			<?php do_action('woocommerce_review_order_after_shipping'); ?>
		<?php endif; ?>

		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<div class="flex justify-between">
				<div><?php echo esc_html($fee->name); ?></div>
				<div><?php wc_cart_totals_fee_html($fee); ?></div>
			</div>
		<?php endforeach; ?>

		<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
			<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
				<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
					<div class="flex justify-between p-2">
						<div><?php echo esc_html($tax->label); ?></div>
						<div><?php echo wp_kses_post($tax->formatted_amount); ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="flex justify-between p-2">
					<div><?php echo esc_html(WC()->countries->tax_or_vat()); ?></div>
					<div><?php wc_cart_totals_taxes_total_html(); ?></div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action('woocommerce_review_order_before_order_total'); ?>

		<div class="flex justify-between text-2xl font-semibold border-t border-mid-gray pt-6 mt-6">
			<div><?php esc_html_e('Total', 'woocommerce'); ?></div>
			<div><?php wc_cart_totals_order_total_html(); ?></div>
		</div>

		<?php do_action('woocommerce_review_order_after_order_total'); ?>
	</div>

</div>