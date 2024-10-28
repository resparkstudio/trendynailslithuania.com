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
	exit; // Exit if accessed directly
}

get_header();

$product = wc_get_product(get_the_ID());
$product_id = $product->get_id();
$product_title = $product->get_name();
$product_price = $product->get_price_html();
$product_short_description = $product->get_short_description();
$product_long_description = $product->get_description();
$product_image_id = $product->get_image_id();
$product_gallery_image_ids = $product->get_gallery_image_ids();
$product_sku = $product->get_sku();
$product_category = wc_get_product_category_list($product_id);
$product_weight = $product->get_weight();
$product_attributes = $product->get_attributes();

?>


<section id="primary">
	<main id="main" class="max-w-[87.5rem] mx-auto w-full">
		<div id="page-content" class="mx-12 md:mx-4 flex justify-center align-center flex-wrap">
			<div id="product-section" class="grid grid-cols-12 gap-4">
				<!-- Product Gallery Swiper -->
				<div class="col-span-6">
					<div class="swiper product-gallery-swiper relative">
						<div class="swiper-wrapper">
							<div class="swiper-slide aspect-[663/725] object-center w-full relative">
								<?php echo wp_get_attachment_image($product_image_id, 'large', false, ['class' => 'w-full object-cover h-full object-cover round-12']); ?>
							</div>

							<?php foreach ($product_gallery_image_ids as $gallery_image_id): ?>
								<div class="swiper-slide aspect-[663/725] object-center w-full relative">
									<?php echo wp_get_attachment_image($gallery_image_id, 'large', false, ['class' => 'w-full object-cover h-full object-cover round-12']); ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="z-10 product-gallery-swiper-pagination pb-5 px-5 gap-2 absolute flex justify-end">
						</div>
					</div>
				</div>

				<!-- Product Description -->
				<div class="col-span-6">
					<h1 class="text-3xl font-semibold"><?php echo $product_title; ?></h1>
					<p class="text-lg"><?php echo $product->get_attribute('size'); ?> ML</p>
					<div class="text-2xl font-bold mb-4"><?php echo $product_price; ?></div>
					<p class="text-sm mb-6"><?php echo $product_short_description; ?></p>

					<!-- Quantity Selector and Add to Cart -->
					<div class="flex items-center mb-6">
						<?php woocommerce_quantity_input(); ?>
						<button class="ml-4 px-6 py-2 bg-black text-white rounded">
							<?php esc_html_e('Add to Cart', 'woocommerce'); ?>
						</button>
					</div>

					<!-- Product Additional Information -->
					<div class="space-y-4">
						<div>
							<h3 class="font-semibold"><?php esc_html_e('Usage and Care Conditions', 'woocommerce'); ?>
							</h3>
							<p class="text-sm"><?php echo $product_long_description; ?></p>
						</div>
						<div>
							<h3 class="font-semibold"><?php esc_html_e('Ingredients', 'woocommerce'); ?></h3>
							<p class="text-sm">

							</p>
						</div>
						<div>
							<h3 class="font-semibold"><?php esc_html_e('Shipping', 'woocommerce'); ?></h3>
							<p class="text-sm">

							</p>
						</div>
					</div>

					<!-- Product Meta -->
					<div class="mt-6 text-sm text-gray-500">
						<p><?php echo esc_html__('Product Code:', 'woocommerce') . ' ' . $product_sku; ?></p>
						<p><?php echo esc_html__('Category:', 'woocommerce') . ' ' . $product_category; ?></p>
					</div>
				</div>

			</div>
		</div>
	</main>
</section>


<?php
get_footer();

