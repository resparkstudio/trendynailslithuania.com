<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */


defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}


?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="grid grid-cols-12">
		<?php
		do_action('woocommerce_before_single_product_summary'); // Product gallery section
		?>

		<div class="col-span-6 pl-16 pt-28 lg:pl-0 lg:pt-7 lg:col-span-12 ">

			<?php
			do_action('woocommerce_single_product_summary'); // Product summary section
			?>

			<?php
			// Custom Sections for Product Information
			$usage_conditions = get_field_object('product_usage_conditions');
			$ingredients = get_field_object('product_ingredients');
			$shipping = get_field_object('product_shipping');
			?>
			<div class="product-additional-info overflow-hidden mt-12 md:mt-10">
				<?php if (!empty($usage_conditions['value'])): ?>
					<div class="relative pb-3.5 z-30">
						<div class="relative info-expand overflow-hidden flex flex-nowrap items-center cursor-pointer">
							<h3 class="uppercase text-black grow flex items-center">
								<?php echo wp_kses_post($usage_conditions['label']); ?>
							</h3>
							<div class="plus-icon-wrap grow-0 flex justify-center items-center relative w-3 h-3">
								<div class="plus-stripe-h absolute w-full h-[0.1rem] bg-black"></div>
								<div class="plus-stripe-v absolute h-full w-[0.1rem] bg-black "></div>
							</div>
						</div>
						<div class="info-text overflow-hidden text-deep-dark-gray hidden pb-4 bg-white">
							<div class="pb-7 pt-4 lg:pt-5 lg:pb-6"><?php echo wp_kses_post($usage_conditions['value']); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($ingredients['value'])): ?>
					<div class="relative pb-3.5 z-20">
						<div class="relative info-expand overflow-hidden flex flex-nowrap items-center cursor-pointer">
							<h3 class="uppercase text-black grow flex items-center">
								<?php echo wp_kses_post($ingredients['label']); ?>
							</h3>
							<div class="plus-icon-wrap grow-0 flex justify-center items-center relative w-3 h-3">
								<div class="plus-stripe-h absolute w-full h-[0.1rem] bg-black"></div>
								<div class="plus-stripe-v absolute h-full w-[0.1rem] bg-black "></div>
							</div>
						</div>
						<div class="info-text overflow-hidden  text-deep-dark-gray hidden pb-4 ">
							<div class="pb-7 pt-4 "><?php echo wp_kses_post($ingredients['value']); ?></div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($shipping['value'])): ?>
					<div class="relative z-10">
						<div class="relative info-expand overflow-hidden flex flex-nowrap items-center cursor-pointer">
							<h3 class="uppercase text-black grow flex items-center">
								<?php echo wp_kses_post($shipping['label']); ?>
							</h3>
							<div class="plus-icon-wrap grow-0 flex justify-center items-center relative w-3 h-3">
								<div class="plus-stripe-h absolute w-full h-[0.1rem] bg-black"></div>
								<div class="plus-stripe-v absolute h-full w-[0.1rem] bg-black "></div>
							</div>
						</div>
						<div class="info-text overflow-hidden text-deep-dark-gray hidden pb-4">
							<div class="pb-7 pt-4 "><?php echo wp_kses_post($shipping['value']); ?></div>
						</div>
					</div>
				<?php endif; ?>

				<?php if ($product->get_sku()): ?>
					<div class="product-meta-info mt-7 lg:mt-6 text-sm overflow-hidden relative">
						<div class="product-sku body-extra-small-regular text-black">
							<?php echo wp_kses_post("Produkto kodas: " . $product->get_sku()) ?>
						</div>
					</div>
				<?php endif; ?>

				<?php $categories = wc_get_product_category_list($product->get_id(), ', '); ?>
				<?php if ($categories): ?>
					<div class="relative overflow-hidden">
						<div class="product-category text-black body-extra-small-regular mt-2">
							<?php echo wp_kses_post("Kategorija: " . $categories) ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="spacer col-span-12 mb-20 md:mb-12"></div>
		<?php if (have_rows('produkto_duk', $product->get_id())): ?>
			<div class="col-span-12 col-start-3 col-end-11 md:col-start-1 md:col-end-13 mb-24 md:mb-16">
				<?php wc_get_template('single-product/duk.php'); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php
	do_action('woocommerce_after_single_product_summary');
	?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>