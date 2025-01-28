<?php
/*
Template Name: Main Page
*/

$soc_media_page_id = 169;

$hero_image = get_field('hero_image');
$hero_image_mobile = get_field('hero_image_mobile');
$hero_heading = get_field('heading');
$hero_description = get_field('hero_description');

$about_heading_1 = get_field('about_heading_1');
$about_description_1 = get_field('about_description_1');
$about_image_1 = get_field('about_image_1');
$about_heading_2 = get_field('about_heading_2');
$about_description_2 = get_field('about_description_2');
$about_image_2 = get_field('about_image_2');

$follow_us_heading = get_field('follow_us_heading');
$instagram_link = get_field('instagram_link', 'option');
$instagram_button_text = get_field('instagram_button_text');
$instagram_gallery = get_field('instagram_gallery');

$sale_url = esc_url(add_query_arg('filter', 'sale', get_permalink(wc_get_page_id('shop'))));
$new_products_url = esc_url(add_query_arg('filter', 'naujienos', get_permalink(wc_get_page_id('shop'))));
$shop_url = esc_url(get_permalink(wc_get_page_id('shop')));

get_header();
?>
<section id="primary" class="mb-48 md:mb-28">
    <?php if ($hero_image || $hero_image_mobile || $hero_heading || $hero_description): ?>
        <div class="w-full">
            <div id="hero-section" class="relative w-full overflow-hidden mb-16 md:mb-20">
                <?php if ($hero_image && $hero_image_mobile): ?>
                    <img class="w-full h-auto block md:hidden aspect-[1401/581]" src="<?php echo esc_url($hero_image); ?>"
                        alt="Trendy Nails DREAM base bottles in soft pink tones with labels, accompanied by text promoting new products" />
                    <img class="w-full h-auto hidden md:block" src="<?php echo esc_url($hero_image_mobile); ?>"
                        alt="Trendy Nails DREAM base bottles in soft pink tones with labels, accompanied by text promoting new products" />
                <?php elseif ($hero_image): ?>
                    <img class="w-full h-auto object-cover" src="<?php echo esc_url($hero_image); ?>"
                        alt="Trendy Nails DREAM base bottles in soft pink tones with labels, accompanied by text promoting new products" />
                <?php endif; ?>

                <div class="absolute inset-0 flex items-end justify-starts md:items-center md:justify-center">

                    <div class="absolute inset-0 bg-black/30">
                    </div>

                    <div class="relative z-10 pl-9 pb-16 w-full md:pb-10 md:px-5">

                        <div class="text-center">
                            <?php if ($hero_heading): ?>
                                <h1
                                    class="text-white heading-xl font-semibold mb-2.5 md:text-[1.5rem] md:leading-[2rem] md:mb-2">
                                    <?php echo wp_kses_post($hero_heading); ?>
                                </h1>
                            <?php endif; ?>

                            <?php if ($hero_description): ?>
                                <div class="text-white mb-7 md:mb-6">
                                    <?php echo wp_kses_post($hero_description); ?>
                                </div>
                            <?php endif; ?>

                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"
                                class="inline-block white-button-black-text-fill py-4 px-20 text-center">
                                <?php echo wp_kses_post("Įsigyti"); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
    <main id="main" class="max-w-[87.5rem] mx-auto w-full">
        <div id="page-content" class="flex flex-col mx-12 md:mx-4">
            <!-- Sale products section -->
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 10,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => '_sale_price',
                        'value' => 0,
                        'compare' => '>',
                        'type' => 'NUMERIC'
                    ),
                    array(
                        'key' => '_min_variation_sale_price',
                        'value' => 0,
                        'compare' => '>',
                        'type' => 'NUMERIC'
                    )
                )
            );
            $sale_product_loop = new WP_Query($args);
            ?>
            <?php if ($sale_product_loop->have_posts()): ?>
                <div id="sale-section" class="mb-28 md:mb-20">
                    <div class="flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo wp_kses_post("Išpardavimas"); ?>
                        </h3>
                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="daugiau-button flex gap-3" href="<?php echo $sale_url ?>">
                                <span><?php echo wp_kses_post("Daugiau"); ?></span>
                                <div class="flex items-center">
                                    <svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                            fill="#201F1F" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="relative swiper-container sale-swiper-container overflow-hidden">
                            <div id="product-swiper-wrapper" class="swiper-wrapper">
                                <?php
                                if ($sale_product_loop->have_posts()):
                                    while ($sale_product_loop->have_posts()):
                                        $sale_product_loop->the_post();
                                        global $product;
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="relative product-card flex flex-col">
                                                <?php
                                                $gallery_image_ids = $product->get_gallery_image_ids();
                                                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                                                $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'full')[0] : wp_get_attachment_image_src(7, 'full')[0];
                                                $first_gallery_image_url = !empty($gallery_image_ids) ? wp_get_attachment_image_src($gallery_image_ids[0], 'full')[0] : '';
                                                ?>

                                                <div class=" w-full relative mb-4 md:mb-3 product-image-container ">
                                                    <a class="w-full" href="<?php the_permalink(); ?>">

                                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                            alt="<?php the_title(); ?>"
                                                            class="w-full object-cover object-center aspect-[324/365] rounded-lg original-image"
                                                            style="position: relative; opacity: 1;">

                                                        <?php if ($first_gallery_image_url): ?>
                                                            <img src="<?php echo esc_url($first_gallery_image_url); ?>"
                                                                alt="<?php the_title(); ?> - Gallery"
                                                                class="w-full object-cover object-center aspect-[324/365] rounded-lg gallery-image"
                                                                style="position: absolute; top: 0; left: 0; opacity: 0;">
                                                        <?php endif; ?>
                                                    </a>

                                                    <?php
                                                    $wishlist = custom_get_wishlist(); // Fetch the current wishlist
                                                    $is_in_wishlist = in_array($product->get_id(), $wishlist); // Check if the product is in the wishlist
                                                    ?>

                                                    <a class="shop-heart-icon add-to-wishlist-btn absolute top-5 right-5 z-10 cursor-pointer 
                                                        <?php echo $is_in_wishlist ? 'active' : ''; ?>"
                                                        data-action="add_to_wishlist"
                                                        data-product_id="<?php echo esc_attr(get_the_ID()); ?>"
                                                        data-product_name="<?php echo esc_attr(get_the_title()); ?>">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                                                stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
                                                                fill="<?php echo $is_in_wishlist ? 'currentColor' : 'none'; ?>" />
                                                        </svg>
                                                    </a>
                                                    <div class="absolute bottom-5 right-5 z-10">
                                                        <a data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                            data-product_name="<?php echo esc_attr($product->get_name()); ?>"
                                                            class="add_to_cart_button add-item-icon add-to-cart-swiper-btn cursor-pointer flex items-center justify-center p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <mask id="path-1-inside-1_46_159" fill="white">
                                                                    <path
                                                                        d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z" />
                                                                </mask>
                                                                <path
                                                                    d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
                                                                    fill="#201F1F" />
                                                                <path
                                                                    d="M6.678 0.69H7.678V-0.31H6.678V0.69ZM6.678 11.91V12.91H7.678V11.91H6.678ZM5.424 11.91H4.424V12.91H5.424V11.91ZM5.424 0.69V-0.31H4.424V0.69H5.424ZM0.452 5.728V4.728H-0.548V5.728H0.452ZM11.65 5.728H12.65V4.728H11.65V5.728ZM11.65 6.872V7.872H12.65V6.872H11.65ZM0.452 6.872H-0.548V7.872H0.452V6.872ZM5.678 0.69V11.91H7.678V0.69H5.678ZM6.678 10.91H5.424V12.91H6.678V10.91ZM6.424 11.91V0.69H4.424V11.91H6.424ZM5.424 1.69H6.678V-0.31H5.424V1.69ZM0.452 6.728H11.65V4.728H0.452V6.728ZM10.65 5.728V6.872H12.65V5.728H10.65ZM11.65 5.872H0.452V7.872H11.65V5.872ZM1.452 6.872V5.728H-0.548V6.872H1.452Z"
                                                                    fill="#201F1F" mask="url(#path-1-inside-1_46_159)" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>


                                                <?php
                                                $categories = get_the_terms($product->get_id(), 'product_cat');
                                                if (!empty($categories) && !is_wp_error($categories)) {
                                                    $category = $categories[0];
                                                    echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . wp_kses_post($category->name) . '</a>';
                                                }

                                                $attributes = $product->get_attributes();
                                                $attributes_text = '';

                                                foreach ($attributes as $attribute) {
                                                    $attribute_name = wc_attribute_label($attribute->get_name());
                                                    $attribute_values = $product->get_attribute($attribute->get_name());

                                                    if (!empty($attribute_values)) {
                                                        $attributes_text .= $attribute_values . ' <span class="lowercase">' . strtolower($attribute_name) . '</span> ';
                                                    }
                                                }
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <p class="product-title text-wrap body-normal-regular mb-2.5 md:mb-7">
                                                        <?php the_title(); ?>
                                                        <?php if ($attributes_text): ?>
                                                            <?php echo trim($attributes_text); ?>
                                                        <?php endif; ?>
                                                    </p>
                                                </a>

                                                <div class="product-price">
                                                    <?php woocommerce_template_loop_price(); ?>
                                                </div>


                                            </div>

                                        </div>
                                    <?php endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>

                        <div
                            class="sale-nav-button-prev product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                        <div
                            class="sale-nav-button-next product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <!-- New Products Section -->
            <?php
            $new_product_days = 30;
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 20,
                'orderby' => 'date',
                'order' => 'DESC',
                'date_query' => array(
                    array(
                        'after' => date('Y-m-d', strtotime("-{$new_product_days} days")),
                    ),
                ),
            );
            $new_product_loop = new WP_Query($args);
            ?>
            <?php if ($new_product_loop->have_posts()): ?>
                <div id="new-products-section" class="mb-28 md:mb-20">
                    <div class=" flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo wp_kses_post("Naujienos"); ?>
                        </h3>
                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="daugiau-button flex gap-3" href="<?php echo $new_products_url ?>">
                                <span><?php echo wp_kses_post("Daugiau"); ?></span>
                                <div class="flex items-center">
                                    <svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                            fill="#201F1F" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative">

                        <div class="relative swiper-container new-products-swiper-container overflow-hidden">
                            <div id="product-swiper-wrapper" class="swiper-wrapper">
                                <?php

                                if ($new_product_loop->have_posts()):
                                    while ($new_product_loop->have_posts()):
                                        $new_product_loop->the_post();
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="relative product-card flex flex-col">
                                                <?php
                                                $gallery_image_ids = $product->get_gallery_image_ids();
                                                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                                                $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'full')[0] : wp_get_attachment_image_src(7, 'full')[0];
                                                $first_gallery_image_url = !empty($gallery_image_ids) ? wp_get_attachment_image_src($gallery_image_ids[0], 'full')[0] : '';
                                                ?>

                                                <div class=" w-full relative mb-4 md:mb-3 product-image-container">
                                                    <a class="w-full" href="<?php the_permalink(); ?>">

                                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                            alt="<?php the_title(); ?>"
                                                            class="w-full object-cover object-center aspect-[324/365] rounded-lg original-image"
                                                            style="position: relative; opacity: 1;">

                                                        <?php if ($first_gallery_image_url): ?>
                                                            <img src="<?php echo esc_url($first_gallery_image_url); ?>"
                                                                alt="<?php the_title(); ?> - Gallery"
                                                                class="w-full object-cover object-center aspect-[324/365] rounded-lg gallery-image"
                                                                style="position: absolute; top: 0; left: 0; opacity: 0;">
                                                        <?php endif; ?>
                                                    </a>

                                                    <?php
                                                    $wishlist = custom_get_wishlist(); // Fetch the current wishlist
                                                    $is_in_wishlist = in_array($product->get_id(), $wishlist); // Check if the product is in the wishlist
                                                    ?>

                                                    <a class="shop-heart-icon add-to-wishlist-btn absolute top-5 right-5 z-10 cursor-pointer 
                                                        <?php echo $is_in_wishlist ? 'active' : ''; ?>"
                                                        data-action="add_to_wishlist"
                                                        data-product_id="<?php echo esc_attr(get_the_ID()); ?>"
                                                        data-product_name="<?php echo esc_attr(get_the_title()); ?>">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                                                stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
                                                                fill="<?php echo $is_in_wishlist ? 'currentColor' : 'none'; ?>" />
                                                        </svg>
                                                    </a>

                                                    <div class="absolute bottom-5 right-5 z-10">
                                                        <a data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                            data-product_name="<?php echo esc_attr($product->get_name()); ?>"
                                                            class="add_to_cart_button add-item-icon add-to-cart-swiper-btn cursor-pointer flex items-center justify-center p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <mask id="path-1-inside-1_46_159" fill="white">
                                                                    <path
                                                                        d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z" />
                                                                </mask>
                                                                <path
                                                                    d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
                                                                    fill="#201F1F" />
                                                                <path
                                                                    d="M6.678 0.69H7.678V-0.31H6.678V0.69ZM6.678 11.91V12.91H7.678V11.91H6.678ZM5.424 11.91H4.424V12.91H5.424V11.91ZM5.424 0.69V-0.31H4.424V0.69H5.424ZM0.452 5.728V4.728H-0.548V5.728H0.452ZM11.65 5.728H12.65V4.728H11.65V5.728ZM11.65 6.872V7.872H12.65V6.872H11.65ZM0.452 6.872H-0.548V7.872H0.452V6.872ZM5.678 0.69V11.91H7.678V0.69H5.678ZM6.678 10.91H5.424V12.91H6.678V10.91ZM6.424 11.91V0.69H4.424V11.91H6.424ZM5.424 1.69H6.678V-0.31H5.424V1.69ZM0.452 6.728H11.65V4.728H0.452V6.728ZM10.65 5.728V6.872H12.65V5.728H10.65ZM11.65 5.872H0.452V7.872H11.65V5.872ZM1.452 6.872V5.728H-0.548V6.872H1.452Z"
                                                                    fill="#201F1F" mask="url(#path-1-inside-1_46_159)" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>


                                                <?php
                                                $categories = get_the_terms($product->get_id(), 'product_cat');
                                                if (!empty($categories) && !is_wp_error($categories)) {
                                                    $category = $categories[0];
                                                    echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . wp_kses_post($category->name) . '</a>';
                                                }

                                                $attributes = $product->get_attributes();
                                                $attributes_text = '';

                                                foreach ($attributes as $attribute) {
                                                    $attribute_name = wc_attribute_label($attribute->get_name());
                                                    $attribute_values = $product->get_attribute($attribute->get_name());

                                                    if (!empty($attribute_values)) {
                                                        $attributes_text .= $attribute_values . ' <span class="lowercase">' . strtolower($attribute_name) . '</span> ';
                                                    }
                                                }
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <p class="product-title text-wrap body-normal-regular mb-2.5 md:mb-7">
                                                        <?php the_title(); ?>
                                                        <?php if ($attributes_text): ?>
                                                            <?php echo trim($attributes_text); ?>
                                                        <?php endif; ?>
                                                    </p>
                                                </a>

                                                <div class="product-price">
                                                    <?php woocommerce_template_loop_price(); ?>
                                                </div>


                                            </div>

                                        </div>
                                    <?php endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>

                        <div
                            class="product-nav-button-prev new-products-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                        <div
                            class="product-nav-button-next new-products-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            // Categories section
            $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true, // Only show categories with products
                'meta_query' => array(
                    array(
                        'key' => '_display_in_section',
                        'value' => 'yes',
                        'compare' => '='
                    ),
                )
            ));
            ?>

            <?php if (!empty($product_categories) && !is_wp_error($product_categories)): ?>
                <div id="categories-section" class="mb-28 md:mb-20 grid grid-cols-12 gap-4">
                    <?php foreach ($product_categories as $category):
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        if ($thumbnail_id) {
                            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
                        } else {
                            $thumbnail_url = wp_get_attachment_image_src(7, 'full')[0];
                        }

                        if ($thumbnail_url):
                            ?>
                            <div class="col-span-4 lg:col-span-6 md:col-span-12">
                                <div class="aspect-square md:aspect-[361/220] object-center w-full">
                                    <a href="<?php echo get_term_link($category); ?>"
                                        class="product-category-link-wrap block w-full relative round-12 ">
                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                            alt="<?php echo esc_attr($category->name); ?>"
                                            class="product-category-link-wrap-image aspect-square md:aspect-[361/220] round-12 w-full object-cover object-center">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-deep-dark-gray/100 via-deep-dark-gray/50 to-transparent/0 opacity-20 pointer-events-none round-15">
                                        </div>
                                        <div class="px-5 absolute bottom-5 right-0 w-full">
                                            <div
                                                class="product-category-button py-3 white-button-white-text inline-block w-full text-center">
                                                <?php echo wp_kses_post($category->name); ?>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Popular product section -->
            <?php
            // Query for products marked as "Populiariausi"
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 10,
                'meta_query' => array(
                    array(
                        'key' => '_populiariausi',
                        'value' => 'yes',
                        'compare' => '=',
                    )
                )
            );

            $popular_product_loop = new WP_Query($args);
            ?>
            <?php if ($popular_product_loop->have_posts()): ?>
                <div id="popular-products-section" class="mb-28 md:mb-20">
                    <div class="flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo wp_kses_post("Populiariausi"); ?>
                        </h3>

                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="daugiau-button flex gap-3" href="<?php echo $shop_url . "?orderby=popularity" ?>">
                                <span><?php echo wp_kses_post("Daugiau"); ?></span>
                                <div class="flex items-center">
                                    <svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                            fill="#201F1F" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative">

                        <div class="relative swiper-container popular-products-swiper-container overflow-hidden">
                            <div id="product-swiper-wrapper" class="swiper-wrapper">
                                <?php
                                $args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => 10,
                                    'meta_query' => array(
                                        'relation' => 'OR',
                                        array(
                                            'key' => '_sale_price',
                                            'value' => 0,
                                            'compare' => '>',
                                            'type' => 'NUMERIC'
                                        ),
                                        array(
                                            'key' => '_min_variation_sale_price',
                                            'value' => 0,
                                            'compare' => '>',
                                            'type' => 'NUMERIC'
                                        )
                                    )
                                );
                                if ($popular_product_loop->have_posts()):
                                    while ($popular_product_loop->have_posts()):
                                        $popular_product_loop->the_post();
                                        global $product;
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="relative product-card flex flex-col">
                                                <?php
                                                $gallery_image_ids = $product->get_gallery_image_ids();
                                                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                                                $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'full')[0] : wp_get_attachment_image_src(7, 'full')[0];
                                                $first_gallery_image_url = !empty($gallery_image_ids) ? wp_get_attachment_image_src($gallery_image_ids[0], 'full')[0] : '';
                                                ?>

                                                <div
                                                    class="aspect-[324/365] object-center w-full relative mb-4 md:mb-3 product-image-container">
                                                    <a class="w-full" href="<?php the_permalink(); ?>">

                                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                            alt="<?php the_title(); ?>"
                                                            class="w-full object-cover object-center aspect-[324/365] rounded-lg original-image"
                                                            style="position: relative; opacity: 1;">

                                                        <?php if ($first_gallery_image_url): ?>
                                                            <img src="<?php echo esc_url($first_gallery_image_url); ?>"
                                                                alt="<?php the_title(); ?> - Gallery"
                                                                class="w-full rounded-lg gallery-image object-cover object-center aspect-[324/365]"
                                                                style="position: absolute; top: 0; left: 0; opacity: 0;">
                                                        <?php endif; ?>
                                                    </a>
                                                    <?php
                                                    $wishlist = custom_get_wishlist(); // Fetch the current wishlist
                                                    $is_in_wishlist = in_array($product->get_id(), $wishlist); // Check if the product is in the wishlist
                                                    ?>

                                                    <a class="shop-heart-icon add-to-wishlist-btn absolute top-5 right-5 z-10 cursor-pointer 
                                                        <?php echo $is_in_wishlist ? 'active' : ''; ?>"
                                                        data-action="add_to_wishlist"
                                                        data-product_id="<?php echo esc_attr(get_the_ID()); ?>"
                                                        data-product_name="<?php echo esc_attr(get_the_title()); ?>">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                                                stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
                                                                fill="<?php echo $is_in_wishlist ? 'currentColor' : 'none'; ?>" />
                                                        </svg>
                                                    </a>

                                                    <div class="absolute bottom-5 right-5 z-10">
                                                        <a data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                            data-product_name="<?php echo esc_attr($product->get_name()); ?>"
                                                            class="add_to_cart_button add-item-icon add-to-cart-swiper-btn cursor-pointer flex items-center justify-center p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <mask id="path-1-inside-1_46_159" fill="white">
                                                                    <path
                                                                        d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z" />
                                                                </mask>
                                                                <path
                                                                    d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
                                                                    fill="#201F1F" />
                                                                <path
                                                                    d="M6.678 0.69H7.678V-0.31H6.678V0.69ZM6.678 11.91V12.91H7.678V11.91H6.678ZM5.424 11.91H4.424V12.91H5.424V11.91ZM5.424 0.69V-0.31H4.424V0.69H5.424ZM0.452 5.728V4.728H-0.548V5.728H0.452ZM11.65 5.728H12.65V4.728H11.65V5.728ZM11.65 6.872V7.872H12.65V6.872H11.65ZM0.452 6.872H-0.548V7.872H0.452V6.872ZM5.678 0.69V11.91H7.678V0.69H5.678ZM6.678 10.91H5.424V12.91H6.678V10.91ZM6.424 11.91V0.69H4.424V11.91H6.424ZM5.424 1.69H6.678V-0.31H5.424V1.69ZM0.452 6.728H11.65V4.728H0.452V6.728ZM10.65 5.728V6.872H12.65V5.728H10.65ZM11.65 5.872H0.452V7.872H11.65V5.872ZM1.452 6.872V5.728H-0.548V6.872H1.452Z"
                                                                    fill="#201F1F" mask="url(#path-1-inside-1_46_159)" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>


                                                <?php
                                                $categories = get_the_terms($product->get_id(), 'product_cat');
                                                if (!empty($categories) && !is_wp_error($categories)) {
                                                    $category = $categories[0];
                                                    echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . wp_kses_post($category->name) . '</a>';
                                                }

                                                $attributes = $product->get_attributes();
                                                $attributes_text = '';

                                                foreach ($attributes as $attribute) {
                                                    $attribute_name = wc_attribute_label($attribute->get_name());
                                                    $attribute_values = $product->get_attribute($attribute->get_name());

                                                    if (!empty($attribute_values)) {
                                                        $attributes_text .= $attribute_values . ' <span class="lowercase">' . strtolower($attribute_name) . '</span> ';
                                                    }
                                                }
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <p class="product-title text-wrap body-normal-regular mb-2.5 md:mb-7">
                                                        <?php the_title(); ?>
                                                        <?php if ($attributes_text): ?>
                                                            <?php echo trim($attributes_text); ?>
                                                        <?php endif; ?>
                                                    </p>
                                                </a>


                                                <div class="product-price">
                                                    <?php woocommerce_template_loop_price(); ?>
                                                </div>


                                            </div>

                                        </div>
                                    <?php endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>

                        <div
                            class="product-nav-button-prev popular-products-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                        <div
                            class="product-nav-button-next popular-products-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            $latest_posts_query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 9,
                'orderby' => 'date',
                'order' => 'DESC'
            ]);
            ?>
            <?php if ($latest_posts_query->have_posts()): ?>
                <div id="blog-section" class="mb-28 md:mb-20 relative">
                    <div class="flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo wp_kses_post("Blogas"); ?>
                        </h3>
                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="daugiau-button flex gap-3"
                                href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                                <span><?php echo wp_kses_post("Daugiau"); ?></span>
                                <div class="flex items-center">
                                    <svg class="daugiau-buttom-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                            fill="#201F1F" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="blog-posts-gallery-swiper-container swiper-container overflow-hidden relative">
                        <div class="swiper-wrapper">
                            <?php

                            while ($latest_posts_query->have_posts()):
                                $latest_posts_query->the_post();
                                ?>
                                <a class="swiper-slide" href="<?php the_permalink(); ?>">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class("related-post-item"); ?>>
                                        <div class="related-post-thumbnail block mb-5 round-12">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('medium', [
                                                    'class' => 'w-full h-auto object-cover object-center aspect-center aspect-square round-12',
                                                    'alt' => esc_attr(get_the_title()) // Add the post title as the alt attribute
                                                ]); ?>
                                            <?php else: ?>
                                                <?php echo wp_get_attachment_image(7, 'medium', false, ['class' => 'w-full h-auto object-cover object-center aspect-center aspect-square round-12']); ?>
                                            <?php endif; ?>
                                        </div>

                                        <p class="related-post-title mb-4 heading-sm text-deep-dark-gray">
                                            <span><?php the_title(); ?></span>
                                        </p>
                                        <div class="daugiau-button flex gap-3">
                                            <span
                                                class="body-small-regular uppercase text-deep-dark-gray"><?php echo wp_kses_post("Daugiau"); ?></span>
                                            <div class="flex items-center">
                                                <svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                                        fill="#201F1F" />
                                                </svg>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div
                        class="blog-posts-button-prev product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div
                        class="blog-posts-button-next product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                fill="black" />
                        </svg>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($about_heading_1 || $about_description_1 || $about_image_1 || $about_heading_2 || $about_description_2 || $about_image_2): ?>
                <div id="about-section" class="mb-28 md:mb-20 grid grid-cols-12 relative">
                    <a href="<?php echo get_permalink(28); ?>"
                        class="mouse-hover-overlay h-full w-full absolute inset-0 z-10 lg:hidden"></a>
                    <?php if ($about_image_1): ?>
                        <div class="col-span-6 lg:col-span-12 aspect-[670/507] w-full relative h-full order-1">
                            <img class="w-full h-full object-cover rounded-tl-[12px] lg:rounded-t-[12px]"
                                src="<?php echo esc_url($about_image_1); ?>"
                                alt="Trendy Nails DREAM base bottle with a floral background">
                        </div>
                    <?php endif; ?>

                    <?php if ($about_heading_1 || $about_description_1): ?>
                        <div
                            class="text-deep-dark-gray rounded-tr-[12px] lg:rounded-tr-[0px] lg:z-1 col-span-6 lg:col-span-12 bg-light-gray px-16 pt-8 pb-28 lg:justify-space-between lg:pt-10 lg:pb-14 flex flex-col justify-end min-h-[365px] lg:min-h-[0px] h-full lg:h-auto order-2 lg:px-5">
                            <h3 class="heading-md mb-4 lg:mb-5 lg:text-[1.125rem] lg:leading-[1.375rem]">
                                <?php echo wp_kses_post($about_heading_1) ?>
                            </h3>
                            <div class="text-base leading-relaxed lg:mb-8">
                                <?php echo wp_kses_post($about_description_1) ?>
                            </div>
                            <div class="hidden lg:flex w-full body-small-regular uppercase text-deep-dark-gray">
                                <a class="daugiau-button flex gap-3" href="<?php echo get_permalink(28); ?>">
                                    <span><?php echo wp_kses_post("Skaityti daugiau"); ?></span>
                                    <div class="flex items-center">
                                        <svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                                fill="#201F1F" />
                                        </svg>
                                    </div>
                                </a>
                            </div>

                        </div>
                    <?php endif; ?>

                    <?php if ($about_heading_2 || $about_description_2): ?>
                        <div
                            class="text-deep-dark-gray rounded-bl-[12px] lg:rounded-b-[12px] col-span-6 lg:z-2 lg:col-span-12 lg:py-10 bg-light-gray px-16 pt-8 pb-28 flex flex-col justify-end lg:justify-space-between min-h-[365px] lg:min-h-[0px] h-full lg:h-auto order-3 lg:order-4 lg:px-5 lg:relative lg:top-[-1rem]">
                            <h3 class="heading-md mb-4 lg:mb-5 lg:text-[1.125rem] lg:leading-[1.375rem]">
                                <?php echo wp_kses_post($about_heading_2) ?>
                            </h3>
                            <div class="text-base leading-relaxed lg:mb-8">
                                <?php echo wp_kses_post($about_description_2) ?>
                            </div>
                            <div class="hidden lg:flex w-full body-small-regular uppercase text-deep-dark-gray">
                                <a class="daugiau-button flex gap-3" href="<?php echo get_permalink(28); ?>">
                                    <span><?php echo wp_kses_post("Skaityti daugiau"); ?></span>
                                    <div class="flex items-center">
                                        <svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                                fill="#201F1F" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($about_image_2): ?>
                        <div
                            class="col-span-6 lg:col-span-12 aspect-[670/507] w-full relative h-full order-4 lg:order-3 lg:relative lg:top-[-1rem]">
                            <img class="w-full h-full object-cover rounded-br-[12px] lg:rounded-t-[12px] lg:rounded-br-[0px]"
                                src="<?php echo esc_url($about_image_2); ?>"
                                alt="Row of Trendy Nails Builder Gel bottles on a pink surface">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>




        </div><!-- .page-content -->
    </main><!-- #main -->
    <?php if ($follow_us_heading || $instagram_link || $instagram_button_text): ?>
        <div id="instagram-section" class="grid grid-cols-12 gap-4 pl-12 md:pl-4 w-full">
            <div
                class="col-span-2 lg:col-span-3 md:col-span-12 flex flex-col w-full justify-center md:flex-nowrap md:flex-row md:mb-8">
                <?php if ($follow_us_heading): ?>
                    <h3
                        class="w-full heading-md text-deep-dark-gray mb-6 md:mb-0 md:text-[1.125rem] md:leading-[1.375rem] md:max-w-32 pr-6">
                        <?php echo wp_kses_post($follow_us_heading); ?>
                    </h3>
                <?php endif; ?>
                <?php if ($instagram_link && $instagram_button_text): ?>
                    <div class="w-full h-auto md:flex md:justify-end md:items-center md:pr-4">
                        <a class="white-button-black-text px-6 py-4 normal-case body-normal-regular md:px-7 md:font-normal md:text-[1.125rem] md:leading-[1.375rem] "
                            target="_blank" href="<?php echo esc_url($instagram_link); ?>">
                            <?php echo wp_kses_post($instagram_button_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-span-10 lg:col-span-9 md:col-span-12 relative">
                <?php if (!empty($instagram_gallery)): ?>
                    <div class="instagram-gallery-swiper relative">
                        <div class="swiper-wrapper">
                            <?php foreach ($instagram_gallery as $image_url): ?>
                                <div class="swiper-slide round-12">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="Trendy Nails Instagram Image"
                                        class="instagram-image w-full h-auto object-cover aspect-square round-12">
                                    <a class="instagram-image-overlay flex round-12 absolute inset-0 left-0 top-0 w-full h-full bg-black/[.32] justify-center items-center"
                                        href="<?php echo esc_url($instagram_link); ?>" target="_blank">
                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.51451 3.14844C8.34263 3.14844 9.85156 4.65737 9.85156 6.48549C9.85156 8.34263 8.34263 9.82254 6.51451 9.82254C4.65737 9.82254 3.17746 8.34263 3.17746 6.48549C3.17746 4.65737 4.65737 3.14844 6.51451 3.14844ZM6.51451 8.66183C7.70424 8.66183 8.66183 7.70424 8.66183 6.48549C8.66183 5.29576 7.70424 4.33817 6.51451 4.33817C5.29576 4.33817 4.33817 5.29576 4.33817 6.48549C4.33817 7.70424 5.32478 8.66183 6.51451 8.66183ZM10.7511 3.03237C10.7511 3.46763 10.4029 3.81585 9.96763 3.81585C9.53237 3.81585 9.18415 3.46763 9.18415 3.03237C9.18415 2.5971 9.53237 2.24888 9.96763 2.24888C10.4029 2.24888 10.7511 2.5971 10.7511 3.03237ZM12.9565 3.81585C13.0145 4.88951 13.0145 8.11049 12.9565 9.18415C12.8984 10.2288 12.6663 11.1283 11.9118 11.9118C11.1574 12.6663 10.2288 12.8984 9.18415 12.9565C8.11049 13.0145 4.88951 13.0145 3.81585 12.9565C2.77121 12.8984 1.87165 12.6663 1.08817 11.9118C0.333705 11.1283 0.101562 10.2288 0.0435268 9.18415C-0.0145089 8.11049 -0.0145089 4.88951 0.0435268 3.81585C0.101562 2.77121 0.333705 1.84263 1.08817 1.08817C1.87165 0.333705 2.77121 0.101562 3.81585 0.0435268C4.88951 -0.0145089 8.11049 -0.0145089 9.18415 0.0435268C10.2288 0.101562 11.1574 0.333705 11.9118 1.08817C12.6663 1.84263 12.8984 2.77121 12.9565 3.81585ZM11.5636 10.3158C11.9118 9.47433 11.8248 7.44308 11.8248 6.48549C11.8248 5.55692 11.9118 3.52567 11.5636 2.65513C11.3315 2.10379 10.8962 1.63951 10.3449 1.43638C9.47433 1.08817 7.44308 1.17522 6.51451 1.17522C5.55692 1.17522 3.52567 1.08817 2.68415 1.43638C2.10379 1.66853 1.66853 2.10379 1.43638 2.65513C1.08817 3.52567 1.17522 5.55692 1.17522 6.48549C1.17522 7.44308 1.08817 9.47433 1.43638 10.3158C1.66853 10.8962 2.10379 11.3315 2.68415 11.5636C3.52567 11.9118 5.55692 11.8248 6.51451 11.8248C7.44308 11.8248 9.47433 11.9118 10.3449 11.5636C10.8962 11.3315 11.3605 10.8962 11.5636 10.3158Z"
                                                fill="white" />
                                        </svg>

                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div
                        class="product-nav-button-prev instagram-gallery-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                fill="black" />
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section><!-- #primary -->

<?php
get_footer();
