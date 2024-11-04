<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()): ?>
	<ul
		class="woocommerce-mini-cart cart_list grow product_list_widget mt-4 flex-1 px-2.5 mx-2.5 overflow-auto <?php echo esc_attr($args['list_class']); ?>">
		<?php
		// Load the cart contents from the new mini-cart-contents.php template
		wc_get_template('cart/mini-cart-contents.php');
		?>
	</ul>

	<!-- Load Cart Totals from the new mini-cart-totals.php template -->
	<div id="mini-cart-totals" class="text-right px-5">
		<?php
		wc_get_template('cart/mini-cart-totals.php');
		?>
	</div>

<?php else: ?>
	<!-- Show a message when the cart is empty -->
	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>
<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>