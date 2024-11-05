<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<div class="mx-12 md:mx-4 mb-36 md:mb-32 mt-5 md:mt-2.5">
    <header id="heading-section">
        <h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo wp_kses_post("Parduotuvė"); ?></h1>
    </header>

    <!-- Dynamic Filter Menu -->
    <div class="flex space-x-4 overflow-x-scroll">
        <button class="filter-button" data-filter="all">Rodyti viską</button>
        <button class="filter-button" data-filter="naujienos">Naujienos</button>
        <button class="filter-button" data-filter="sale">Išpardavimas</button>

        <?php
        // Generate category filters dynamically
        $product_categories = get_terms('product_cat', array('hide_empty' => true));
        foreach ($product_categories as $category) {
            echo '<button class="filter-button" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
        }
        ?>
    </div>

    <!-- Product Count and Sorting Dropdown -->
    <div class="flex justify-between items-center mt-4 mb-4">
        <div class="product-count">
            <?php woocommerce_result_count(); ?>
        </div>

        <div class="product-sorting">
            <?php
            // WooCommerce sorting dropdown
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
                    echo '<div class="custom-product">';
                    wc_get_template_part('content', 'product');
                    echo '</div>';
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

<?php get_footer(); ?>