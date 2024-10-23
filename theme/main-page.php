<?php
/*
Template Name: Main Page
*/

$soc_media_page_id = 169;

$hero_image = get_field('hero_image');
$heading = get_field('heading');
$hero_description = get_field('hero_description');
$read_more_button_text = get_field('read_more_button_text');

$sale_heading = get_field('sale_heading');

$new_products_heading = get_field('new_products_heading');

$more_button_text = get_field('more_button_text');

$popular_products_heading = get_field('popular_products_heading');

$about_heading_1 = get_field('about_heading_1');
$about_description_1 = get_field('about_description_1');
$about_heading_2 = get_field('about_heading_2');
$about_description_2 = get_field('about_description_2');

$blog_heading = get_field('blog_heading');

$follow_us_heading = get_field('follow_us_heading');
$instagram_url = get_field('instagram_url', $soc_media_page_id);

get_header();
?>
<section id="primary" class="mb-48 mt-5 md:mb-28 md:mt-2.5">
    <main id="main">
        <div id="page-content" class="flex flex-col mx-12 md:mx-4 gap-20">
            <?php if ($hero_image || $heading || $hero_description || $read_more_button_text): ?>
                <div id="hero-section"></div>
            <?php endif; ?>

            <?php if ($sale_heading): ?> //or no products for sale
                <div id="sale-section"></div>
            <?php endif; ?>

            <?php if ($new_products_heading): ?> //or no new products
                <div id="new-products-section"></div>
            <?php endif; ?>

            <?php if ($popular_products_heading): ?> // or no categories
                <div id="categories-section"></div>
            <?php endif; ?>

            <?php if ($popular_products_heading): ?> //or no popular products
                <div id="popular-products-section"></div>
            <?php endif; ?>

            <?php if ($blog_heading): ?> // or no blogs
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
