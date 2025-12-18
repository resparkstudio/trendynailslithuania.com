<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart_contents');


function clean_attribute_slug_1($slug) {
    return str_replace('pa_', '', $slug);
}


foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
        $product_name = $_product->get_name();

        // Build attribute string using the same logic as in your single product template.
        $attributes = $_product->get_attributes();
        $attribute_strings = array();
        foreach ($attributes as $attribute_slug => $attribute) {
            // Get the formatted attribute value using get_attribute()
            $attribute_value = $_product->get_attribute($attribute_slug);
            if ($attribute_value) {
                $formatted_attribute = esc_html($attribute_value) . ' ' . clean_attribute_slug_1($attribute_slug);
                $attribute_strings[] = $formatted_attribute;
            }
        }
        $attribute_text = !empty($attribute_strings) ? ' ' . implode(', ', $attribute_strings) : '';
        $formatted_product_name = $product_name . $attribute_text;

        $thumbnail_id = $_product->get_image_id();
        if ($thumbnail_id) {
            $product_image_url = wp_get_attachment_url($thumbnail_id);
        } else {
            $product_image_url = wp_get_attachment_url(7);
        }
        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
?>
        <li class="woocommerce-mini-cart-item py-5 border-b-[0.5px] border-[#C3C3C3]">

            <div class="flex items-start text-deep-dark-gray sm:grid sm:grid-cols-12 relative">
                <!-- Product Image -->
                <div class="flex-shrink-0 sm:col-span-3 mr-6 sm:mr-4">
                    <a href="<?php echo esc_url($product_permalink); ?>" class="block max-w-24 w-full relative">
                        <img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_name); ?>"
                            class="w-full object-cover object-center aspect-[78/100] sm:aspect-[82/100] rounded-[4px]" />
                    </a>
                </div>

                <!-- Product Details (Name, Attributes, Price, Quantity) -->
                <div class="name-price flex flex-col justify-between h-full mr-4 sm:col-span-9">
                    <!-- Product Name and Attributes -->
                    <div class="mb-2 sm:w-full">
                        <?php if (empty($product_permalink)): ?>
                            <span class="body-small-regular"><?php echo wp_kses_post($formatted_product_name); ?></span>
                        <?php else: ?>
                            <a href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo wp_kses_post($formatted_product_name); ?>
                            </a>
                        <?php endif; ?>

                        <div class="body-normal-semibold">
                            <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                        </div>
                    </div>

                    <!-- Price and Quantity on the Same Line -->
                    <div class="flex justify-between items-center sm:gap-4 mt-auto flex-wrap sm:flex-nowrap shrink-0">
                        <div class="flex flex-col gap-4">
                            <div
                                class="product-price flex gap-x-2 flex-wrap justify-start h-full items-center w-full sm:justify-end">
                                <?php
                                $product_original_price = floatval($_product->get_regular_price());
                                $line_total_incl_tax = $cart_item['line_total'] + $cart_item['line_tax'];
                                $price_after_discount_incl_tax = $line_total_incl_tax / $cart_item['quantity'];
                                $tolerance = 0.01; // adjust as needed based on your price precision

                                // For gift cards or products without a regular price, use the cart item price
                                if ($product_original_price == 0) {
                                    $product_original_price = $price_after_discount_incl_tax;
                                }

                                if (($product_original_price - $price_after_discount_incl_tax) > $tolerance): ?>
                                    <span class="sale-price text-deep-dark-gray body-small-semibold flex items-end">
                                        <?php echo wc_price($price_after_discount_incl_tax); ?>
                                    </span>
                                    <span class="text-discount-gray line-through body-small-medium flex items-end">
                                        <?php echo wc_price($product_original_price); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-deep-dark-gray body-small-semibold flex items-end">
                                        <?php echo wc_price($price_after_discount_incl_tax); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div
                                class="flex items-center border-[0.7px] rounded-[46px] lg:rounded-[9px] py-[0.25rem] border-deep-dark-gray justify-center overflow-hidden">
                                <button type="button"
                                    class="minus focus:outline-none flex items-center justify-center pl-3 text-lg text-deep-dark-gray custom-minus"
                                    data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.8334 10L4.16675 10" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="square" />
                                    </svg>

                                </button>
                                <input type="number" id="quantity_<?php echo esc_attr($cart_item_key); ?>"
                                    class="quantity-input ajax-cart-quantity w-[2.5rem] text-center focus:outline-none body-normal-regular text-sm text-deep-dark-gray"
                                    name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]"
                                    value="<?php echo esc_attr($cart_item['quantity']); ?>" size="4" min="1" step="1"
                                    data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>" inputmode="numeric"
                                    autocomplete="off">
                                <button type="button"
                                    class="plus focus:outline-none flex items-center justify-center pr-3 text-lg text-deep-dark-gray custom-plus"
                                    data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.8332 10L4.1665 10" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="square" />
                                        <path d="M10 4.16664L10 15.8333" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="square" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute right-0 top-0">
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