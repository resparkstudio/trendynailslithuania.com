<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */


if (!defined('ABSPATH')) {
	exit;
}

get_header('shop'); ?>

<?php

do_action('woocommerce_before_main_content');
?>
<div id="single-product-page" class="max-w-[87.5rem] mx-auto w-full px-12 md:px-4 mb-40 md:mb-32 mt-5 md:mt-0">
	<?php while (have_posts()): ?>
		<?php the_post(); ?>

		<?php wc_get_template_part('content', 'single-product'); ?>

	<?php endwhile; // end of the loop. ?>

</div>



<?php

do_action('woocommerce_after_main_content');
?>

<?php

do_action('woocommerce_sidebar');
?>

<?php
get_footer();


