<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header();

do_action('woocommerce_before_main_content');

$current_url = home_url(add_query_arg(null, null));

$shop_url = esc_url(get_permalink(wc_get_page_id('shop')));
$all_active = ($current_url == $shop_url) ? 'link-active' : '';

$new_products_url = esc_url(add_query_arg('filter', 'naujienos', $shop_url));
$sale_url = esc_url(add_query_arg('filter', 'sale', $shop_url));
$new_products_active = ($current_url == $new_products_url) ? 'link-active' : '';
$sale_active = ($current_url == $sale_url) ? 'link-active' : '';

?>
<section id="primary" class="max-w-[87.5rem] mx-auto w-full">
    <main id="main" class="mx-12 md:mx-4 mb-36 md:mb-32 mt-5 md:mt-2.5">
        <header id="heading-section mb-4">
            <h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo wp_kses_post("Parduotuvė"); ?></h1>
        </header>

        <div
            class="flex gap-8 md:gap-6 overflow-x-auto body-small-regular text-dark-gray md:text-[0.75rem] md:leading-[1rem] pb-5 border-b-[0.5px] border-dark-gray mb-12 md:mb-6">
            <a href="<?php echo $shop_url; ?>"
                class="filter-button link-hover whitespace-nowrap <?php echo $all_active; ?>"><?php echo wp_kses_post("Rodyti viską") ?></a>

            <a href="<?php echo $new_products_url; ?>"
                class="filter-button link-hover whitespace-nowrap <?php echo $new_products_active; ?>"><?php echo wp_kses_post("Naujienos") ?></a>

            <a href="<?php echo $sale_url; ?>"
                class="filter-button link-hover whitespace-nowrap <?php echo $sale_active; ?>"><?php echo wp_kses_post("Išpardavimas") ?></a>

            <?php
            $uncategorized = null;
            $product_categories = get_terms('product_cat', array('hide_empty' => true));

            foreach ($product_categories as $category) {
                if ($category->slug === 'uncategorized') {
                    $uncategorized = $category;
                } else {
                    $category_url = esc_url(get_term_link($category));
                    $category_active = ($current_url == $category_url) ? 'link-active' : '';

                    echo '<a href="' . $category_url . '" class="filter-button link-hover whitespace-nowrap ' . $category_active . '">' . esc_html($category->name) . '</a>';
                }
            }

            if ($uncategorized) {
                $uncategorized_url = esc_url(get_term_link($uncategorized));
                $uncategorized_active = ($current_url == $uncategorized_url) ? 'link-active' : '';

                echo '<a href="' . $uncategorized_url . '" class="filter-button link-hover whitespace-nowrap ' . $uncategorized_active . '">' . esc_html($uncategorized->name) . '</a>';
            }
            ?>

        </div>

        <div class="flex justify-between items-center mb-8 md:mb-10">
            <div class="product-count text-deep-dark-gray body-extra-small-regular">
                <?php woocommerce_result_count(); ?>
            </div>

            <div class="product-sorting">
                <?php
                woocommerce_catalog_ordering();
                ?>
            </div>
        </div>

        <div id="product-list">
            <?php
            if (woocommerce_product_loop()) {
                do_action('woocommerce_before_shop_loop');
                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');

                    }
                }

                woocommerce_product_loop_end();
                do_action('woocommerce_after_shop_loop');
            } else {
                do_action('woocommerce_no_products_found');
            }
            ?>
        </div>

        <?php do_action('woocommerce_after_main_content'); ?>
        </div>

</section>


<?php get_footer(); ?>