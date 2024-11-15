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

$current_category = get_queried_object();
$category_slug = (isset($current_category->slug) && $current_category->taxonomy === 'product_cat') ? esc_attr($current_category->slug) : '';

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


        <div class="border-b-[0.5px] border-dark-gray mb-12 md:mb-6 overflow-x-auto">
            <div
                class="shop-archive-nav-menu flex gap-8 md:gap-6 body-small-regular text-dark-gray md:text-[0.75rem] md:leading-[1rem] pb-5">
                <a href="<?php echo $shop_url; ?>"
                    class="filter-button link-hover whitespace-nowrap <?php echo $all_active; ?>">
                    <?php echo wp_kses_post("Rodyti viską") ?>
                </a>
                <a href="<?php echo $new_products_url; ?>"
                    class="filter-button link-hover whitespace-nowrap <?php echo $new_products_active; ?>">
                    <?php echo wp_kses_post("Naujienos") ?>
                </a>
                <a href="<?php echo $sale_url; ?>"
                    class="filter-button link-hover whitespace-nowrap <?php echo $sale_active; ?>">
                    <?php echo wp_kses_post("Išpardavimas") ?>
                </a>

                <?php
                $uncategorized = null;
                $product_categories = get_terms('product_cat', array('hide_empty' => true, 'parent' => 0));
                $current_category_id = get_queried_object_id();

                $active_category_ids = $current_category_id ? array_merge(get_ancestors($current_category_id, 'product_cat'), [$current_category_id]) : [];

                foreach ($product_categories as $category) {
                    if ($category->slug === 'uncategorized') {
                        $uncategorized = $category;
                    } else {
                        $category_url = esc_url(get_term_link($category));
                        $category_active = in_array($category->term_id, $active_category_ids) ? 'link-active' : '';
                        echo '<a href="' . $category_url . '" class="filter-button link-hover whitespace-nowrap ' . $category_active . '">' . esc_html($category->name) . '</a>';
                    }
                }

                if ($uncategorized) {
                    $uncategorized_url = esc_url(get_term_link($uncategorized));
                    $uncategorized_active = in_array($uncategorized->term_id, $active_category_ids) ? 'link-active' : '';
                    echo '<a href="' . $uncategorized_url . '" class="filter-button link-hover whitespace-nowrap ' . $uncategorized_active . '">' . esc_html($uncategorized->name) . '</a>';
                }
                ?>
            </div>

            <?php
            if ($current_category_id) {
                $active_category_ids = array_merge(get_ancestors($current_category_id, 'product_cat'), [$current_category_id]);
                display_hierarchy($current_category_id, $active_category_ids);
            }

            function display_hierarchy($category_id, $active_category_ids, $depth = 0)
            {
                $ancestors = get_ancestors($category_id, 'product_cat');
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $ancestor_id) {
                    display_subcategories($ancestor_id, $active_category_ids, $depth);
                    $depth++;
                }

                display_subcategories($category_id, $active_category_ids, $depth);
            }

            function display_subcategories($parent_id, $active_category_ids, $depth)
            {
                $subcategories = get_terms('product_cat', array('parent' => $parent_id, 'hide_empty' => true));

                if (!empty($subcategories)) {
                    // Calculate padding class based on depth
                    $padding_left = 2 + ($depth * 2);
                    $padding_class = 'pl-' . $padding_left;

                    echo '<div class="shop-archive-nav-menu flex gap-8 md:gap-6 overflow-x-auto body-small-regular text-dark-gray md:text-[0.75rem] md:leading-[1rem] pb-5 ' . esc_attr($padding_class) . '">';

                    foreach ($subcategories as $subcategory) {
                        $subcategory_url = esc_url(get_term_link($subcategory));
                        $subcategory_active = in_array($subcategory->term_id, $active_category_ids) ? 'link-active' : '';

                        echo '<a href="' . $subcategory_url . '" class="filter-button link-hover whitespace-nowrap ' . $subcategory_active . '">' . esc_html($subcategory->name) . '</a>';
                    }

                    echo '</div>';
                }
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

        <div id="product-list" class="products" data-category="<?php echo $category_slug; ?>">
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