<?php
/*
Template Name: About Us
*/
get_header();


// hero section
$hero_image = get_field('hero_image');
$hero_image_mobile = get_field('hero_image_mobile');
$hero_text = get_field('hero_text');

// description section 1
$description_1 = get_field('description_1');

// category-section
$product_category_image_1 = get_field('product_category_image_1');
$product_category_image_2 = get_field('product_category_image_2');
$product_category_image_3 = get_field('product_category_image_3');

// category description section
$product_category_description = get_field('product_category_description');

// description section 2
$bottom_image = get_field('bottom_image');
$bottom_image_description = get_field('bottom_image_description');

?>
<section id="primary" class="mb-36 md:mb-28">
    <main id="main">
        <div id="page-content" class="flex flex-col gap-20 md:gap-16">
            <?php if ($hero_image || $hero_image_mobile || $hero_text): ?>
                <div id="hero-section" class="mx-4 relative">
                    <?php if ($hero_image && $hero_image_mobile): ?>
                        <img class="block md:hidden w-full h-auto object-cover round-10"
                            src="<?php echo esc_url($hero_image); ?>" alt="Hero Image" />
                        <img class="hidden md:block w-full h-auto object-cover round-10"
                            src="<?php echo esc_url($hero_image_mobile); ?>" alt="Mobile Hero Image" />
                    <?php elseif ($hero_image): ?>
                        <img class="w-full h-auto object-cover round-10" src="<?php echo esc_url($hero_image); ?>"
                            alt="Hero Image" />
                    <?php endif; ?>

                    <?php if ($hero_text): ?>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h2 class="mx-24 body-hero-medium md:text-[1.5rem] md:leading-[2rem] md:mx-4 text-white">
                                <?php echo wp_kses_post($hero_text); ?>
                            </h2>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($description_1): ?>
                <div id="description-section-1" class="mx-4 grid grid-cols-12 grid-rows-1 gap-4">
                    <p class="col-start-7 col-end-12 md:col-start-1"><?php echo wp_kses_post($description_1); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($product_category_image_1 || $product_category_image_2 || $product_category_image_3): ?>
                <div id="category-section" class="mx-4 grid grid-cols-12 grid-rows-1 md:grid-cols-1 md:grid-rows-3 gap-4">
                    <img class="col-span-4 rounded-lg md:col-span-12 md:row-span-1 md:w-full md:h-72 object-cover object-center"
                        src="<?php echo esc_url($product_category_image_1); ?>" />
                    <img class="col-span-4 rounded-lg md:col-span-12 md:row-span-1 md:w-full md:h-72 object-cover object-center"
                        src="<?php echo esc_url($product_category_image_2); ?>" />
                    <img class="col-span-4 rounded-lg md:col-span-12 md:row-span-1 md:w-full md:h-72 object-cover object-center"
                        src="<?php echo esc_url($product_category_image_3); ?>" />
                </div>
            <?php endif; ?>

            <?php if ($product_category_description): ?>
                <div id="category-description-section" class="mx-4">
                    <h2 class="mx-24 body-hero-medium md:text-[1.5rem] md:leading-[2rem] md:mx-4 text-black">
                        <?php echo wp_kses_post($product_category_description); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <?php if ($bottom_image || $bottom_image_description): ?>
                <div id="description-section-2" class="mx-4 grid grid-cols-12 gap-4 grid-rows-1 md:grid-cols-1 md:gap-y-12">
                    <img class="col-span-6 rounded-lg md:col-span-12 md:row-span-1"
                        src="<?php echo esc_url($bottom_image); ?>" />
                    <div class="col-span-6 flex justify-center items-center ml-10 md:ml-0 md:col-span-12 md:row-span-1">
                        <p class="body-normal-regular">
                            <?php echo wp_kses_post($bottom_image_description); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>


        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();



