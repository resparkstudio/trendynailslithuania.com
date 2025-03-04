<?php
/*
Template Name: Wishlist
*/

get_header();

// Retrieve wishlist items
$wishlist_items = custom_get_wishlist();
?>

<section id="primary" class="mb-36 mt-5 md:mb-28 md:mt-2.5">
    <main id="main" class="max-w-[87.5rem] mx-auto w-full">
        <div id="page-content" class="flex flex-col mx-12 md:mx-4">
            <header id="heading-section">
                <h1 class="w-full heading-md text-deep-dark-gray mb-12 md:mb-10">
                    <?php echo wp_kses_post("Norų sąrašas"); ?>
                </h1>
            </header>

            <?php if (!empty($wishlist_items)): ?>
                <div class="wishlist-items grid grid-cols-12 gap-4">
                    <?php foreach ($wishlist_items as $product_id): ?>
                        <?php
                        $product = wc_get_product($product_id);
                        if (!$product || !$product->is_visible())
                            continue;
                        ?>

                        <div class="product-card flex flex-col col-span-3 lg:col-span-4 md:col-span-6">
                            <div class="aspect-[324/365] w-full relative mb-4 lg:mb-3">
                                <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="w-full">
                                    <?php
                                    $thumbnail_id = get_post_thumbnail_id($product_id);
                                    $image_url = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'medium')[0] : wc_placeholder_img_src();
                                    ?>
                                    <img src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($product->get_name()); ?>"
                                        class="w-full h-full object-cover round-12">
                                </a>
                                <a class="shop-heart-icon cursor-pointer filled-heart remove-from-wishlist-btn absolute top-5 right-5 z-10"
                                    data-product_id="<?php echo esc_attr($product_id); ?>"
                                    data-product_name="<?php echo esc_attr($product->get_name()); ?>">
                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                            stroke="#201F1F" stroke-width="0.7" stroke-linecap="round" fill="currentColor" />
                                    </svg>
                                </a>
                                <a data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                    data-product_name="<?php echo esc_attr($product->get_name()); ?>"
                                    class="add-item-icon add-to-cart-swiper-btn cursor-pointer absolute bottom-5 right-5 z-10 p-4 lg:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
                                            fill="#201F1F" />
                                    </svg>
                                </a>
                            </div>

                            <div class="product-info flex flex-col">
                                <?php
                                $categories = get_the_terms($product_id, 'product_cat');
                                if (!empty($categories) && !is_wp_error($categories)) {
                                    $category = $categories[0];
                                    echo '<a href="' . esc_url(get_term_link($category)) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . esc_html($category->name) . '</a>';
                                }
                                $product_name = $product->get_name();
                                $attributes = $product->get_attributes();
                                $attribute_strings = array();

                                foreach ($attributes as $attribute_slug => $attribute) {
                                    // Get the attribute display value
                                    $attribute_value = $product->get_attribute($attribute_slug);
                                    if ($attribute_value) {
                                        // Remove 'pa_' prefix from the attribute slug for display
                                        $clean_slug = str_replace('pa_', '', $attribute_slug);
                                        // Format as "attribute value attribute name" (slug in lowercase)
                                        $attribute_strings[] = esc_html($attribute_value) . ' ' . strtolower(esc_html($clean_slug));
                                    }
                                }

                                $attribute_text = !empty($attribute_strings) ? ' ' . implode(', ', $attribute_strings) : '';
                                $formatted_product_name = $product_name . $attribute_text;
                                ?>
                                <a href="<?php echo esc_url(get_permalink($product_id)); ?>"
                                    class="product-title body-normal-regular mb-2.5 lg:mb-7">
                                    <?php echo esc_html($formatted_product_name); ?>
                                </a>

                                <div class="product-price">
                                    <?php woocommerce_template_loop_price(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="body-small-regular text-deep-dark-gray mt-10">
                    <?php echo wp_kses_post("Jūsų norų sąrašas tuščias."); ?>
                </p>
            <?php endif; ?>
        </div>

    </main>
</section>

<?php get_footer(); ?>