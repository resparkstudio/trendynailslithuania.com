<?php
// Ensure that this file is not accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="search-results-container max-h-[23.4375rem] overflow-auto">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="flex items-center p-4 border-b">
                <!-- Product Image -->
                <div class="flex-shrink-0 w-16 h-16 mr-4">
                    <?php if (has_post_thumbnail($product['id'])): ?>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($product['id'], 'thumbnail')); ?>"
                            alt="<?php echo esc_attr($product['name']); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-200"></div>
                    <?php endif; ?>
                </div>

                <!-- Product Details -->
                <div class="flex flex-col">
                    <!-- Product Categories -->
                    <?php
                    $categories = get_the_terms($product['id'], 'product_cat');
                    if (!empty($categories) && !is_wp_error($categories)):
                        $category_names = wp_list_pluck($categories, 'name');
                        ?>
                        <p class="text-sm text-gray-600">
                            <?php echo implode(', ', $category_names); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Product Name -->
                    <a href="<?php echo esc_url($product['link']); ?>" class="text-lg font-semibold">
                        <?php echo esc_html($product['name']); ?>
                    </a>

                    <!-- Product Attributes -->
                    <?php
                    $product_obj = wc_get_product($product['id']); // Get product object
                    if ($product_obj) { // Check if the product object is valid
                        $attributes = $product_obj->get_attributes(); // Get attributes
                        if (!empty($attributes)):
                            $attribute_texts = [];
                            foreach ($attributes as $attribute) {
                                // Check if it's a taxonomy-based attribute
                                if ($attribute->is_taxonomy()) {
                                    $terms = wp_get_post_terms($product['id'], $attribute->get_name(), ['fields' => 'names']);
                                    if (!is_wp_error($terms) && !empty($terms)) {
                                        $attribute_texts[] = ucfirst(wc_attribute_label($attribute->get_name())) . ': ' . implode(', ', $terms);
                                    }
                                } else { // Custom attribute
                                    $attribute_texts[] = ucfirst(wc_attribute_label($attribute->get_name())) . ': ' . esc_html(implode(', ', $attribute->get_options()));
                                }
                            }
                            ?>
                            <p class="text-sm text-gray-600">
                                <?php echo implode(' | ', $attribute_texts); ?>
                            </p>
                            <?php
                        endif;
                    }
                    ?>

                    <!-- Product Price -->
                    <p class="text-lg font-semibold mt-1">
                        <?php echo wc_price(get_post_meta($product['id'], '_price', true)); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-sm text-gray-600 p-4">No products found</p>
    <?php endif; ?>
</div>