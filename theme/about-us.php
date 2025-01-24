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
    <div class="w-full">
        <?php if ($hero_image || $hero_image_mobile || $hero_text): ?>
            <div id="hero-section" class="relative mb-20 md:mb-16 md:mx-0">
                <?php if ($hero_image && $hero_image_mobile): ?>
                    <img class="block md:hidden w-full h-auto object-cover" src="<?php echo esc_url($hero_image); ?>"
                        alt="Hero image of Trendy Nails DREAM base bottle with a floral background" />
                    <img class="hidden md:block w-full h-auto object-cover" src="<?php echo esc_url($hero_image_mobile); ?>"
                        alt="Hero image of Trendy Nails DREAM base bottle with a floral background" />
                <?php elseif ($hero_image): ?>
                    <img class="w-full h-auto object-cover" src="<?php echo esc_url($hero_image); ?>"
                        alt="Hero image of Trendy Nails DREAM base bottle with a floral background" />
                <?php endif; ?>

                <?php if ($hero_text): ?>
                    <div class="absolute inset-0 bg-black/[0.24] pointer-events-none">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center md:block">
                        <div class="hidden md:block mt-8 mb-2 body-small-regular w-full text-white md:mx-4">
                            <?php echo wp_kses_post("Apie mus"); ?>
                        </div>
                        <h2
                            class="mx-24 heading-lg md:text-[1.5rem] md:leading-[2rem] md:mx-4 text-white text-center md:text-start">
                            <?php echo wp_kses_post($hero_text); ?>
                        </h2>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <main id="main" class="max-w-[87.5rem] mx-auto w-full">
        <div id="page-content" class="flex flex-col gap-20 md:gap-16">


            <?php if ($description_1): ?>
                <div id="description-section-1" class="mx-12 md:mx-4 grid grid-cols-12 grid-rows-1 gap-4">
                    <div class="col-start-7 col-end-12 md:col-start-1"><?php echo wp_kses_post($description_1); ?></div>
                </div>
            <?php endif; ?>

            <?php if ($product_category_image_1 || $product_category_image_2 || $product_category_image_3): ?>
                <div id="category-section"
                    class="mx-12 md:mx-4 grid grid-cols-12 grid-rows-1 md:grid-cols-1 md:grid-rows-3 gap-4">
                    <img class="col-span-4 round-10 md:col-span-12 md:row-span-1 md:w-full md:h-72 object-cover object-center"
                        src="<?php echo esc_url($product_category_image_1); ?>"
                        alt="Stacked Trendy Nails bottles with dripping polish" />
                    <img class="col-span-4 round-10 md:col-span-12 md:row-span-1 md:w-full md:h-72 object-cover object-center"
                        src="<?php echo esc_url($product_category_image_2); ?>"
                        alt="Pink Trendy Nails box with a DREAM base bottle" />
                    <img class="col-span-4 round-10 md:col-span-12 md:row-span-1 md:w-full md:h-72 object-cover object-center"
                        src="<?php echo esc_url($product_category_image_3); ?>"
                        alt="Woman holding a Trendy Nails product" />
                </div>
            <?php endif; ?>

            <?php if ($product_category_description): ?>
                <div id="category-description-section" class="mx-12 md:mx-4">
                    <h2 class="mx-24 heading-lg md:text-[1.5rem] md:leading-[2rem] md:mx-4 text-black text-center">
                        <?php echo esc_textarea($product_category_description); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <?php if ($bottom_image || $bottom_image_description): ?>
                <div id="description-section-2"
                    class="mx-12 md:mx-4 grid grid-cols-12 gap-4 grid-rows-1 md:grid-cols-1 md:gap-y-12">
                    <img class="col-span-6 round-10 md:col-span-12 md:row-span-1"
                        src="<?php echo esc_url($bottom_image); ?>"
                        alt="Trendy Nails lollipops in front of a luxury Chanel store with decorative pearls and bows" />
                    <div class="col-span-6 flex justify-center items-center ml-10 md:ml-0 md:col-span-12 md:row-span-1">
                        <?php echo wp_kses_post($bottom_image_description); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();



