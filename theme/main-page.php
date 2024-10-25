<?php
/*
Template Name: Main Page
*/

$soc_media_page_id = 169;

$hero_image = get_field('hero_image');
$hero_image_mobile = get_field('hero_image_mobile');
$heading = get_field('heading');
$hero_description = get_field('hero_description');
$read_more_button_text = get_field('read_more_button_text');

$sale_heading = get_field('sale_heading');

$new_products_heading = get_field('new_products_heading');

$product_category_image_1 = get_field('product_category_image_1');
$product_category_image_2 = get_field('product_category_image_2');
$product_category_image_3 = get_field('product_category_image_3');
$product_category_image_4 = get_field('product_category_image_4');
$product_category_image_5 = get_field('product_category_image_5');
$product_category_image_6 = get_field('product_category_image_6');

$popular_products_heading = get_field('popular_products_heading');

$about_heading_1 = get_field('about_heading_1');
$about_description_1 = get_field('about_description_1');
$about_image_1 = get_field('about_image_1');
$about_heading_2 = get_field('about_heading_2');
$about_description_2 = get_field('about_description_2');
$about_image_2 = get_field('about_image_2');

$blog_heading = get_field('blog_heading');

$follow_us_heading = get_field('follow_us_heading');
$instagram_url = get_field('instagram_url', $soc_media_page_id);

$more_button_text = get_field('more_button_text');

get_header();
?>
<section id="primary" class="mb-48 mt-5 md:mb-28 md:mt-2.5">
    <main id="main">
        <div id="page-content" class="flex flex-col mx-12 md:mx-4">
            <?php if ($hero_image || $hero_image_mobile || $heading || $hero_description || $read_more_button_text): ?>
                <div id="hero-section" class="relative w-full round-15 overflow-hidden mb-16 md:mb-20">
                    <?php if ($hero_image && $hero_image_mobile): ?>
                        <img class="w-full h-auto round-15 block md:hidden" src="<?php echo esc_url($hero_image); ?>"
                            alt="Hero Image" />
                        <img class="w-full h-auto round-15 hidden md:block" src="<?php echo esc_url($hero_image_mobile); ?>"
                            alt="Hero Image Mobile" />
                    <?php elseif ($hero_image): ?>
                        <img class="w-full h-auto object-cover round-15" src="<?php echo esc_url($hero_image); ?>"
                            alt="Hero Image" />
                    <?php endif; ?>

                    <div class="absolute inset-0 flex items-end justify-start">

                        <div
                            class="absolute inset-0 bg-gradient-to-r md:bg-gradient-to-t from-deep-dark-gray/100 via-deep-dark-gray/50 to-transparent/0 opacity-20 pointer-events-none round-15">
                        </div>

                        <div class="relative z-10 pl-9 pb-16 w-full md:mb-10 md:px-5">

                            <div class="text-left">
                                <?php if ($heading): ?>
                                    <h1
                                        class="text-white heading-xl md:text-4xl font-semibold mb-2.5 md:text-[1.5rem] md:leading-[2rem] md:mb-4">
                                        <?php echo esc_html($heading); ?>
                                    </h1>
                                <?php endif; ?>

                                <?php if ($hero_description): ?>
                                    <p class="text-white text-sm md:text-lg mb-7 body-small-regular md:mb-6">
                                        <?php echo esc_html($hero_description); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($read_more_button_text): ?>
                                    <a href="#" class="inline-block white-button-white-text py-4 px-12 text-center sm:w-full">
                                        <?php echo esc_html($read_more_button_text); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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
            <?php if ($sale_product_loop->have_posts() && $sale_heading): ?>
                <div id="sale-section" class="mb-28 md:mb-20">
                    <div class="flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo esc_html($sale_heading); ?>
                        </h3>
                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="flex gap-3" href="#">
                                <span><?php echo esc_html($more_button_text); ?></span>
                                <div class="flex items-center">
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
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
                        <div class="relative swiper-container overflow-hidden">
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
                                                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                                                $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
                                                ?>

                                                <div class="aspect-[324/365] object-center w-full relative mb-4 md:mb-3">
                                                    <a class="w-full" href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                            alt="<?php the_title(); ?>"
                                                            class="w-full h-full object-cover rounded-lg">
                                                    </a>

                                                    <a href="#" class="shop-heart-icon absolute top-5 right-5 z-10">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                                                stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
                                                                fill="none" />
                                                        </svg>
                                                    </a>

                                                    <div class="absolute bottom-5 right-5 z-10">
                                                        <a href="?add-to-cart=<?php echo $product->get_id(); ?>"
                                                            class="add-item-icon flex items-center justify-center p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
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
                                                    echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . esc_html($category->name) . '</a>';
                                                }
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <p class="product-title text-wrap body-normal-regular mb-2.5 md:mb-7">
                                                        <?php the_title(); ?>
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

                        <div class="product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                        <div class="product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
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
                'posts_per_page' => 10,
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
            <?php if ($new_product_loop->have_posts() && $new_products_heading): ?>
                <div id="new-products-section" class="mb-28 md:mb-20">
                    <div class="flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo esc_html($new_products_heading); ?>
                        </h3>
                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="flex gap-3" href="#">
                                <span><?php echo esc_html($more_button_text); ?></span>
                                <div class="flex items-center">
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
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

                        <div class="relative swiper-container overflow-hidden">
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
                                $new_product_loop = new WP_Query($args);
                                if ($new_product_loop->have_posts()):
                                    while ($new_product_loop->have_posts()):
                                        $new_product_loop->the_post();
                                        global $product;
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="relative product-card flex flex-col">
                                                <?php
                                                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                                                $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
                                                ?>

                                                <div class="aspect-[324/365] object-center w-full relative mb-4 md:mb-3">
                                                    <a class="w-full" href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                            alt="<?php the_title(); ?>"
                                                            class="w-full h-full object-cover rounded-lg">
                                                    </a>

                                                    <a href="#" class="shop-heart-icon absolute top-5 right-5 z-10">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                                                stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
                                                                fill="none" />
                                                        </svg>
                                                    </a>

                                                    <div class="absolute bottom-5 right-5 z-10">
                                                        <a href="?add-to-cart=<?php echo $product->get_id(); ?>"
                                                            class="add-item-icon flex items-center justify-center p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
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
                                                    echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . esc_html($category->name) . '</a>';
                                                }
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <p class="product-title text-wrap body-normal-regular mb-2.5 md:mb-7">
                                                        <?php the_title(); ?>
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

                        <div class="product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                        <div class="product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
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
                        $thumbnail_url = wp_get_attachment_url($thumbnail_id);

                        if ($thumbnail_url):
                            ?>
                            <div class="col-span-4 lg:col-span-6 md:col-span-12">
                                <div class="aspect-square object-center w-full">
                                    <div class="w-full relative round-12">
                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                            alt="<?php echo esc_attr($category->name); ?>"
                                            class="round-12 w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-deep-dark-gray/100 via-deep-dark-gray/50 to-transparent/0 opacity-20 pointer-events-none round-15">
                                        </div>
                                        <div class="px-5 absolute bottom-5 right-0 w-full">
                                            <a href="<?php echo get_term_link($category); ?>"
                                                class="py-3 white-button-white-text inline-block w-full text-center">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        </div>

                                    </div>
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
                'posts_per_page' => 10, // Change as per your needs
                'meta_query' => array(
                    array(
                        'key' => '_populiariausi',
                        'value' => 'yes',
                        'compare' => '=', // Ensure we are checking for exact matches
                    )
                )
            );

            $popular_product_loop = new WP_Query($args);
            ?>
            <?php if ($popular_products_heading): ?> <!-- or no popular products-->
                <div id="popular-products-section" class="mb-28 md:mb-20">
                    <div class="flex justify-between w-full mb-7">
                        <h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
                            <?php echo esc_html($popular_products_heading); ?>
                        </h3>
                        <div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
                            <a class="flex gap-3" href="#">
                                <span><?php echo esc_html($more_button_text); ?></span>
                                <div class="flex items-center">
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
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

                        <div class="relative swiper-container overflow-hidden">
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
                                                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                                                $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
                                                ?>

                                                <div class="aspect-[324/365] object-center w-full relative mb-4 md:mb-3">
                                                    <a class="w-full" href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                            alt="<?php the_title(); ?>"
                                                            class="w-full h-full object-cover rounded-lg">
                                                    </a>

                                                    <a href="#" class="shop-heart-icon absolute top-5 right-5 z-10">
                                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
                                                                stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
                                                                fill="none" />
                                                        </svg>
                                                    </a>

                                                    <div class="absolute bottom-5 right-5 z-10">
                                                        <a href="?add-to-cart=<?php echo $product->get_id(); ?>"
                                                            class="add-item-icon flex items-center justify-center p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
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
                                                    echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . esc_html($category->name) . '</a>';
                                                }
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <p class="product-title text-wrap body-normal-regular mb-2.5 md:mb-7">
                                                        <?php the_title(); ?>
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

                        <div class="product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                        <div class="product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($blog_heading): ?> <!-- or no blogs-->
                <div id="blog-section" class="mb-28 md:mb-20"></div>
            <?php endif; ?>

            <?php if ($about_heading_1 || $about_description_1 || $about_heading_2 || $about_description_2): ?>
                <div id="about-section" class="mb-28 md:mb-20"></div>
            <?php endif; ?>

            <?php if ($follow_us_heading || $instagram_url): ?>
                <div id="instagram-section"></div>
            <?php endif; ?>
        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
