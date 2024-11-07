<?php
// Ensure that this file is not accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="search-results-container max-h-[28rem] overflow-auto mb-5">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="flex items-center py-4 border-gray border-b-[0.5px]">
                <!-- Product Image as Link to Product Page -->
                <div class="flex-shrink-0 h-auto mr-5 aspect-[100/112] max-w-[6.25rem]">
                    <a class="w-full" href="<?php echo esc_url($product['link']); ?>">
                        <?php if (has_post_thumbnail($product['id'])): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url($product['id'], 'thumbnail')); ?>"
                                alt="<?php echo esc_attr($product['name']); ?>" class="w-full h-full object-cover round-12">
                        <?php else: ?>
                            <img src="<?php echo esc_url(wp_get_attachment_url(7)); ?>" alt="Placeholder Image"
                                class="w-full h-full object-cover round-12">
                        <?php endif; ?>
                    </a>
                </div>


                <div class="flex flex-col">
                    <!-- Product Categories as Links -->
                    <?php
                    $categories = get_the_terms($product['id'], 'product_cat');
                    if (!empty($categories) && !is_wp_error($categories)):
                        ?>
                        <p class="body-normal-semibold text-deep-dark-gray mb-1">
                            <?php foreach ($categories as $category): ?>
                                <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a><?php if (next($categories))
                                    echo ', '; ?>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>

                    <!-- Product Name with Attributes -->
                    <a href="<?php echo esc_url($product['link']); ?>" class="body-normal-regular text-deep-dark-gray mb-3">
                        <?php
                        echo esc_html($product['name']);
                        $product_obj = wc_get_product($product['id']); // Get product object
                        if ($product_obj) {
                            $attributes = $product_obj->get_attributes();
                            $attribute_texts = [];
                            if (!empty($attributes)) {
                                foreach ($attributes as $attribute) {
                                    // Check if it's a taxonomy-based attribute
                                    if ($attribute->is_taxonomy()) {
                                        $terms = wp_get_post_terms($product['id'], $attribute->get_name(), ['fields' => 'names']);
                                        if (!is_wp_error($terms) && !empty($terms)) {
                                            $attribute_texts[] = implode(', ', $terms) . ' ' . strtolower(wc_attribute_label($attribute->get_name()));
                                        }
                                    } else { // Custom attribute
                                        $attribute_texts[] = esc_html(implode(', ', $attribute->get_options())) . ' ' . strtolower(wc_attribute_label($attribute->get_name()));
                                    }
                                }
                                echo ' ' . implode(' ', $attribute_texts); // Append attributes after the name
                            }
                        }
                        ?>
                    </a>

                    <!-- Product Price -->
                    <p class="body-normal-semibold text-deep-dark-gray">
                        <?php echo wc_price(get_post_meta($product['id'], '_price', true)); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-sm text-gray-600 p-4">No products found</p>
    <?php endif; ?>
</div>