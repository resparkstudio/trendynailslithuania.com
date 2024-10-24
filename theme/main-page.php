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
        <div id="page-content" class="flex flex-col mx-12 md:mx-4 gap-20">
            <?php if ($hero_image || $hero_image_mobile || $heading || $hero_description || $read_more_button_text): ?>
                <div id="hero-section" class="relative w-full round-15 overflow-hidden">
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
                                    <a href="#"
                                        class="inline-block white-button border-white hover:border-deep-dark-gray text-white py-4 px-12 text-center sm:w-full">
                                        <?php echo esc_html($read_more_button_text); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>



            <?php endif; ?>


            <?php if ($sale_heading): ?>
                <div id="sale-section">
                    <!-- Swiper Container -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            // Query sale products
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10, // Change as needed
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array( // Query products with sale prices
                                        'key' => '_sale_price',
                                        'value' => 0,
                                        'compare' => '>',
                                        'type' => 'NUMERIC'
                                    ),
                                    array( // For variable products with sale price
                                        'key' => '_min_variation_sale_price',
                                        'value' => 0,
                                        'compare' => '>',
                                        'type' => 'NUMERIC'
                                    )
                                )
                            );
                            $loop = new WP_Query($args);

                            if ($loop->have_posts()):
                                while ($loop->have_posts()):
                                    $loop->the_post();
                                    global $product;
                                    ?>
                                    <!-- Swiper Slide for each product -->
                                    <div class="swiper-slide">
                                        <div class="product-card">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                <h2 class="product-title"><?php the_title(); ?></h2>
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

                        <!-- Custom Navigation Buttons (arrows) -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($new_products_heading): ?><!-- or no new products-->
                <div id="new-products-section"></div>
            <?php endif; ?>

            <?php if ($product_category_image_1 || $product_category_image_2 || $product_category_image_3 || $product_category_image_4 || $product_category_image_5 || $product_category_image_6): ?>
                <!-- or no categories-->
                <div id="categories-section"></div>
            <?php endif; ?>

            <?php if ($popular_products_heading): ?> <!-- or no popular products-->
                <div id="popular-products-section"></div>
            <?php endif; ?>

            <?php if ($blog_heading): ?> <!-- or no blogs-->
                <div id="blog-section"></div>
            <?php endif; ?>

            <?php if ($about_heading_1 || $about_description_1 || $about_heading_2 || $about_description_2): ?>
                <div id="about-section"></div>
            <?php endif; ?>

            <?php if ($follow_us_heading || $instagram_url): ?>
                <div id="instagram-section"></div>
            <?php endif; ?>
        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
