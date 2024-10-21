<?php
/*
Template Name: About Us
*/
get_header();
?>

<section id="primary" class="mb-36 md:mb-28">
    <main id="main">
        <div id="page-content">
            <div id="hero-section" class="mx-4 relative">
                <?php
                $hero_image = get_field('hero_image');
                $hero_image_mobile = get_field('hero_image_mobile');
                $hero_text = get_field('hero_text');

                if ($hero_image) {
                    echo '<img class="block md:hidden w-full h-auto object-cover" src="' . esc_url($hero_image) . '" alt="Hero Image" />';

                    echo '<img class="hidden md:block w-full h-auto object-cover" src="' . esc_url($hero_image_mobile) . '" alt="Mobile Hero Image" />';
                } elseif ($hero_image) {

                    echo '<img class="w-full h-auto object-cover" src="' . esc_url($hero_image) . '" alt="Hero Image" />';
                }

                if ($hero_text) {
                    echo '<div class="absolute inset-0 flex items-center justify-center">';
                    echo '<p class="mx-24 body-hero-medium md:text-[1.5rem] md:leading-[2rem] md:mx-4 text-white">' . wp_kses_post($hero_text) . '</p>';
                    echo '</div>';
                }
                ?>

            </div>
            <div id="description-section-1" class="w-full mx-4">
                <?php



                ?>
            </div>
            <div id="category-section" class="w-full mx-4">
                <?php



                ?>
            </div>
            <div id="category-description-section" class="w-full mx-4">
                <?php



                ?>
            </div>
            <div id="decription-section-2" class="w-full mx-4">
                <?php



                ?>
            </div>

        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();



