<?php

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

		<div class="col-span-6 pl-16 pt-28">

			<?php
			do_action('woocommerce_single_product_summary'); // Product summary section
			?>

			<?php
			// Custom Sections for Product Information
			$usage_conditions = get_field_object('product_usage_conditions');
			$ingredients = get_field_object('product_ingredients');
			$shipping = get_field_object('product_shipping');
			?>

			<div class="product-additional-info overflow-hidden">
				<?php if ($usage_conditions): ?>
					<div
						class="relative info-expand overflow-hidden flex flex-nowrap items-center cursor-pointer z-10 bg-white">
						<h3 class="uppercase text-black grow flex items-center">
							<?php echo wp_kses_post($usage_conditions['label']); ?>
						</h3>
						<div class="plus-icon-wrap grow-0 flex justify-center items-center relative w-3 h-3">
							<div class="plus-stripe-h absolute w-full h-[0.1rem] bg-black"></div>
							<div class="plus-stripe-v absolute h-full w-[0.1rem] bg-black "></div>
						</div>
					</div>
					<div class="info-text body-small-regular text-deep-dark-gray hidden pb-4">
						<p class="pb-7 pt-4"><?php echo wp_kses_post($usage_conditions['value']); ?></p>
					</div>
				<?php endif; ?>

				<?php if ($ingredients): ?>
					<div
						class="relative info-expand overflow-hidden flex flex-nowrap items-center cursor-pointer z-10 bg-white pt-4">
						<h3 class="uppercase text-black grow flex items-center">
							<?php echo wp_kses_post($ingredients['label']); ?>
						</h3>
						<div class="plus-icon-wrap grow-0 flex justify-center items-center relative w-3 h-3">
							<div class="plus-stripe-h absolute w-full h-[0.1rem] bg-black"></div>
							<div class="plus-stripe-v absolute h-full w-[0.1rem] bg-black "></div>
						</div>
					</div>
					<div class="info-text body-small-regular text-deep-dark-gray hidden pb-4">
						<p class="pb-7 pt-4"><?php echo wp_kses_post($ingredients['value']); ?></p>
					</div>
				<?php endif; ?>

				<?php if ($shipping): ?>
					<div
						class="relative info-expand overflow-hidden flex flex-nowrap items-center cursor-pointer z-10 bg-white pt-4">
						<h3 class="uppercase text-black grow flex items-center">
							<?php echo wp_kses_post($shipping['label']); ?>
						</h3>
						<div class="plus-icon-wrap grow-0 flex justify-center items-center relative w-3 h-3">
							<div class="plus-stripe-h absolute w-full h-[0.1rem] bg-black"></div>
							<div class="plus-stripe-v absolute h-full w-[0.1rem] bg-black "></div>
						</div>
					</div>
					<div class="info-text body-small-regular text-deep-dark-gray hidden pb-4 ">
						<p class="pb-7 pt-4"><?php echo wp_kses_post($shipping['value']); ?></p>
					</div>
				<?php endif; ?>

				<?php if ($product->get_sku()): ?>
					<div class="product-meta-info mt-4 text-sm bg-white z-40 relative body-extra-small-regular text-black">
						<div class="product-sku">
							<?php esc_kses_post("Produkto kodas: " . $product->get_sku()) ?>'
						</div>
					</div>
				<?php endif; ?>

				<?php $categories = wc_get_product_category_list($product->get_id(), ', '); ?>
				<?php if ($categories): ?>
					<div class="z-40 relative bg-white  text-black" body-extra-small-regular>
						<div class="product-category "><?php wp_kses_post("Kategorija: " . $categories) ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	do_action('woocommerce_after_single_product_summary');
	?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>