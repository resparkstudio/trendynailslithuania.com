<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart_contents');

foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
        $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
        $thumbnail_id = $_product->get_image_id();
        if ($thumbnail_id) {
            $product_image_url = wp_get_attachment_url($thumbnail_id);
        } else {
            $product_image_url = wp_get_attachment_url(7);
        }
        $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
        ?>
        <li class="woocommerce-mini-cart-item py-5 border-b-[0.5px] border-[#C3C3C3]">
            <div class="flex items-start text-deep-dark-gray">
                <!-- Product Image -->
                <div class="flex-shrink-0">

                    <a href="<?php echo esc_url($product_permalink); ?>"
                        class="block aspect-[78/100] max-w-24 w-full relative mr-6">
                        <img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_name); ?>"
                            class="w-full h-full object-cover" />
                    </a>
                </div>

                <!-- Product Details (Name, Attributes, Price, Quantity) -->
                <div class="flex-1 mr-4">
                    <div class="mb-2">
                        <?php if (empty($product_permalink)): ?>
                            <span class="body-small-regular"><?php echo wp_kses_post($product_name); ?></span>
                        <?php else: ?>
                            <a href="<?php echo esc_url($product_permalink); ?>"><?php echo wp_kses_post($product_name); ?></a>
                        <?php endif; ?>

                        <div class="body-normal-semibold">
                            <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                        </div>
                    </div>
                    <div class="body-normal-semibold mb-3">
                        <?php echo $product_price; ?>
                    </div>
                    <div class="text-[0.75rem] leading-[0.875rem]">
                        <span class="font-light inline-block mr-2"><?php echo wp_kses_post("Kiekis: "); ?></span>
                        <span class="font-normal"><?php echo $cart_item['quantity']; ?></span>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    <?php
                    echo apply_filters(
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-product_name="%s">
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
                            esc_attr($_product->get_name())
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