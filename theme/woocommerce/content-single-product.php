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

		<div class="col-span-6 pl-16">

			<?php
			do_action('woocommerce_single_product_summary'); // Product summary section
			?>

			<?php
			// Custom Sections for Product Information
			$usage_conditions = get_field_object('product_usage_conditions');
			$ingredients = get_field_object('product_ingredients');
			$shipping = get_field_object('product_shipping');
			?>

			<div class="product-additional-info">
				<?php if ($usage_conditions): ?>
					<div class="flex flex-nowrap">
						<h3 class="uppercase text-black grow"><?php echo wp_kses_post($usage_conditions['label']); ?></h3>
						<div class="plus-icon-wrap grow-0 flex justify-center items-center">
							<div class="plus-stripe-h flex justify-center items-center">
								<svg width="7" height="2" viewBox="0 0 7 2" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.896 0.632H6.412V1.584H0.896V0.632Z" fill="black" />
								</svg>
							</div>
							<div class="plus-stripe-v flex justify-center items-center">
								<svg width="7" height="2" viewBox="0 0 7 2" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.896 0.632H6.412V1.584H0.896V0.632Z" fill="black" />
								</svg>
							</div>
						</div>
					</div>
					<div class="product-usage-conditions body-small-regular text-deep-dark-gray">
						<?php echo wp_kses_post($usage_conditions['value']); ?>
					</div>
				<?php endif; ?>

				<?php if ($ingredients): ?>
					<h3 class="uppercase text-black"><?php echo wp_kses_post($ingredients['label']); ?></h3>
					<div class="product-ingredients body-small-regular text-deep-dark-gray">
						<?php echo wp_kses_post($ingredients['value']); ?>
					</div>
				<?php endif; ?>

				<?php if ($shipping): ?>
					<h3 class="uppercase text-black"><?php echo wp_kses_post($shipping['label']); ?></h3>
					<div class="product-shipping body-small-regular text-deep-dark-gray">
						<?php echo wp_kses_post($shipping['value']); ?>
					</div>
				<?php endif; ?>

				<?php if ($product->get_sku()): ?>
					<div class="product-meta-info mt-4 text-sm">
						<div class="product-sku">Produkto kodas:
							<?php esc_html($product->get_sku()) ?>'
						</div>
					</div>
				<?php endif; ?>

				<?php $categories = wc_get_product_category_list($product->get_id(), ', '); ?>
				<?php if ($categories): ?>
					<div>
						<div class="product-category">Kategorija: <?php wp_kses_post($categories) ?></div>
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