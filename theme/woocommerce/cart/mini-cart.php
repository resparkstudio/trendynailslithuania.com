<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()): ?>

	<ul
		class="woocommerce-mini-cart cart_list grow product_list_widget mt-4 flex-1 px-2.5 mx-2.5  overflow-auto <?php echo esc_attr($args['list_class']); ?>">
		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				/**
				 * This filter is documented in woocommerce/templates/cart/cart.php.
				 *
				 * @since 2.1.0
				 */
				$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail_id = $_product->get_image_id(); // Get the image ID
				$product_image_url = wp_get_attachment_url($thumbnail_id); // Get the URL of the image
				$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
				?>
				<li
					class="woocommerce-mini-cart-item py-5 border-b-[0.5px] border-[#C3C3C3] <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
					<div class="flex items-start text-deep-dark-gray">
						<!-- Product Image -->
						<div class="flex-shrink-0">
							<?php if ($product_image_url && $product_permalink): ?>
								<a href="<?php echo esc_url($product_permalink); ?>"
									class="block aspect-[78/100] max-w-24 w-full relative mr-6">
									<img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_name); ?>"
										class="w-full h-full object-cover" />
								</a>
							<?php endif; ?>
						</div>

						<!-- Product Details (Name, Attributes, Price, Quantity) -->
						<div class="flex-1 mr-4">
							<div class="mb-2">
								<?php if (empty($product_permalink)): ?>
									<span class="body-small-regular"><?php echo wp_kses_post($product_name); ?></span>
								<?php else: ?>
									<a href="<?php echo esc_url($product_permalink); ?>" class="">
										<?php echo wp_kses_post($product_name); ?>
									</a>
								<?php endif; ?>

								<div class="body-normal-semibold">
									<!-- Display attributes or any additional product data here -->
									<?php echo wc_get_formatted_cart_item_data($cart_item); ?>
								</div>
							</div>

							<!-- Price -->
							<div class="body-normal-semibold mb-3">
								<?php echo $product_price; ?>
							</div>

							<!-- Quantity -->
							<div class="text-[0.75rem] leading-[0.875rem]">
								<span class="font-light inline-block mr-2"><?php echo wp_kses_post("Kiekis: "); ?></span>
								<span class="font-normal"><?php echo $cart_item['quantity']; ?></span>
							</div>
						</div>

						<!-- Remove Button -->
						<div class="flex-shrink-0">
							<?php
							echo apply_filters(
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-success_message="%s">
												<svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
													<line x1="0.901405" y1="1.37276" x2="10.2489" y2="10.7203" stroke="#747474"/>
													<line x1="10.2491" y1="1.30082" x2="0.901523" y2="10.6484" stroke="#747474"/>
												</svg>
											</a>',
									esc_url(wc_get_cart_remove_url($cart_item_key)),
									esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
									esc_attr($product_id),
									esc_attr($cart_item_key),
									esc_attr($_product->get_sku()),
									esc_attr(sprintf(__('&ldquo;%s&rdquo; has been removed from your cart', 'woocommerce'), wp_strip_all_tags($product_name)))
								),
								$cart_item_key
							);
							?>

						</div>
					</div>
				</li>


				<?php
			}
		}

		do_action('woocommerce_mini_cart_contents');
		?>
	</ul>

	<div class="text-right flex-none px-5">
		<div class="flex justify-between text-deep-dark-gray mb-4 mt-2">
			<span class="body-small-light"><?php echo wp_kses_post("Suma") ?></span>
			<span class="body-normal-regular"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
		</div>


		<div class="flex justify-between text-deep-dark-gray mb-4">
			<span class="body-small-light"><?php echo wp_kses_post("Pristatymas") ?></span>
			<span class="body-normal-regular"><?php echo wc_price(WC()->cart->get_shipping_total()); ?></span>
		</div>


		<div class="flex justify-between pt-2 mt-2 text-deep-dark-gray mb-5">
			<span class="body-normal-regular"><?php echo wp_kses_post("Iš viso") ?></span>
			<span class="body-normal-medium"><?php echo WC()->cart->get_total(); ?></span>
		</div>

		<button class="w-full black-button uppercase py-3 mb-6"><?php echo wp_kses_post("Pirkti") ?></button>
	</div>
<?php else: ?>
	<p class="woocommerce-mini-cart__empty-message"><?php echo wp_kses_post("Krepšelis tuščias") ?></p>
<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>