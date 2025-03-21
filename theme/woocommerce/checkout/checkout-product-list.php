<?php
if (!defined('ABSPATH')) {
    exit;
}

// Ensure WooCommerce functions are available
if (!function_exists('WC')) {
    return;
}

// Define a helper function if not already defined.
if (!function_exists('clean_attribute_slug')) {
    function clean_attribute_slug($slug)
    {
        return str_replace('pa_', '', $slug);
    }
}
?>

<div class="cart-items">
    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item): ?>
        <?php
        $_product = $cart_item['data'];
        $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
        $thumbnail_id = $_product->get_image_id();
        $thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
        $product_name = $_product->get_name();

        // Build attribute string using the same logic as the single product template.
        $attributes = $_product->get_attributes();
        $attribute_strings = array();
        foreach ($attributes as $attribute_slug => $attribute) {
            // Retrieve the formatted attribute value.
            $attribute_value = $_product->get_attribute($attribute_slug);
            if ($attribute_value) {
                $formatted_attribute = esc_html($attribute_value) . ' ' . clean_attribute_slug($attribute_slug);
                $attribute_strings[] = $formatted_attribute;
            }
        }
        $attribute_text = !empty($attribute_strings) ? ' ' . implode(', ', $attribute_strings) : '';
        $formatted_product_name = $product_name . $attribute_text;
        ?>
        <div class="cart-item grid grid-cols-12 py-4" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
            <div class="product-thumbnail mr-4 relative max-w-[6.25rem] shrink-0 col-span-4 lg:col-span-2 md:col-span-3">
                <?php if ($thumbnail_src): ?>
                    <img class="w-full h-auto object-cover object-center aspect-[81/100] round-7"
                        src="<?php echo esc_url($thumbnail_src[0]); ?>" alt="<?php echo esc_attr($product_name); ?>" />
                <?php else: ?>
                    <img class="w-full h-auto object-cover object-center aspect-[81/100] round-7"
                        src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                        alt="<?php esc_attr_e('Placeholder Image', 'woocommerce'); ?>" />
                <?php endif; ?>
            </div>
            <div class="flex flex-col justify-between col-span-8 lg:col-span-10 md:col-span-9 ">
                <div class="product-details flex justify-between">
                    <div class="product-name body-small-medium deep-dark-gray mr-2">
                        <?php if ($product_permalink): ?>
                            <a href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo esc_html($formatted_product_name); ?>
                            </a>
                        <?php else: ?>
                            <?php echo esc_html($formatted_product_name); ?>
                        <?php endif; ?>
                    </div>
                    <button class="remove-item flex h-auto items-start"
                        data-remove-item="<?php echo esc_attr($cart_item_key); ?>"
                        data-product_name="<?php echo esc_attr($product_name); ?>">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_209_1212)">
                                <path
                                    d="M0.488373 9.99994C0.391786 9.99996 0.297365 9.97133 0.21705 9.91768C0.136736 9.86403 0.0741379 9.78776 0.0371735 9.69853C0.000209163 9.6093 -0.00946059 9.51111 0.00938739 9.41638C0.0282354 9.32165 0.0747543 9.23464 0.14306 9.16635L9.1665 0.142911C9.25808 0.0513285 9.38229 -0.00012207 9.51181 -0.00012207C9.64133 -0.00012207 9.76554 0.0513285 9.85712 0.142911C9.9487 0.234494 10.0002 0.358706 10.0002 0.488224C10.0002 0.617741 9.9487 0.741953 9.85712 0.833536L0.833685 9.85697C0.78838 9.90237 0.734551 9.93837 0.675292 9.96291C0.616033 9.98744 0.55251 10 0.488373 9.99994Z"
                                    fill="#868686" />
                                <path
                                    d="M9.51178 9.99994C9.44765 10 9.38412 9.98744 9.32486 9.96291C9.2656 9.93837 9.21178 9.90237 9.16647 9.85697L0.143033 0.833536C0.0514506 0.741953 0 0.617741 0 0.488224C0 0.358706 0.0514506 0.234494 0.143033 0.142911C0.234616 0.0513285 0.358828 -0.00012207 0.488346 -0.00012207C0.617863 -0.00012207 0.742076 0.0513285 0.833658 0.142911L9.8571 9.16635C9.9254 9.23464 9.97192 9.32165 9.99077 9.41638C10.0096 9.51111 9.99995 9.6093 9.96298 9.69853C9.92602 9.78776 9.86342 9.86403 9.7831 9.91768C9.70279 9.97133 9.60837 9.99996 9.51178 9.99994Z"
                                    fill="#868686" />
                            </g>
                            <defs>
                                <clipPath id="clip0_209_1212">
                                    <rect width="10" height="10" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
                <div class="flex justify-between gap-3 max-1200px:flex-wrap max-1200px:mt-3">
                    <div class="product-quantity max-1200px:order-2">
                        <div
                            class="flex items-center border-[0.7px] rounded-[46px] lg:rounded-[9px] py-0.5 border-deep-dark-gray justify-center overflow-hidden grow-0">
                            <button type="button"
                                class="minus focus:outline-none flex items-center justify-center pl-3 text-[1.3rem] text-deep-dark-gray custom-minus"
                                data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                <span><?php echo wp_kses_post("-"); ?></span>
                            </button>
                            <input type="number" id="quantity_<?php echo esc_attr($cart_item_key); ?>"
                                class="quantity-input ajax-cart-quantity w-[2.5rem] text-center focus:outline-none body-normal-semibold text-[1rem] text-deep-dark-gray"
                                name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]"
                                value="<?php echo esc_attr($cart_item['quantity']); ?>" size="4" min="1" step="1"
                                data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>" inputmode="numeric"
                                autocomplete="off">
                            <button type="button"
                                class="plus focus:outline-none flex items-center justify-center pr-3 text-[1.3rem] text-deep-dark-gray custom-plus"
                                data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                <span><?php echo wp_kses_post("+"); ?></span>
                            </button>
                        </div>
                    </div>
                    <div
                        class="product-price flex gap-x-2 flex-wrap justify-end max-1200px:justify-start max-1200px:order-2">
                        <?php
                        $product_original_price = $_product->get_regular_price();
                        $line_total_incl_tax = $cart_item['line_total'] + $cart_item['line_tax'];
                        $price_after_discount_incl_tax = $line_total_incl_tax / $cart_item['quantity'];
                        $tolerance = 0.01; // adjust as needed based on your price precision
                    
                        if (($product_original_price - $price_after_discount_incl_tax) > $tolerance): ?>
                            <span class="sale-price text-deep-dark-gray body-small-semibold flex items-end">
                                <?php echo wc_price($price_after_discount_incl_tax); ?>
                            </span>
                            <span class="text-discount-gray line-through body-small-medium flex items-end">
                                <?php echo wc_price($product_original_price); ?>
                            </span>
                        <?php else: ?>
                            <span class="text-deep-dark-gray body-small-semibold flex items-end">
                                <?php echo wc_price($product_original_price); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>