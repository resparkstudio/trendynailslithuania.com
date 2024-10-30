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
			$usage_conditions = get_field('product_usage_conditions');
			$ingredients = get_field('product_ingredients');
			$shipping = get_field('product_shipping');
			?>

			<div class="product-additional-info">
				<?php if ($usage_conditions): ?>
					<h3>NAUDOJIMAS IR LAIKYMO SĄLYGOS</h3>
					<div class="product-usage-conditions">
						<?php echo wp_kses_post($usage_conditions); ?>
					</div>
				<?php endif; ?>

				<?php if ($ingredients): ?>
					<h3>SUDĖTIS</h3>
					<div class="product-ingredients">
						<?php echo wp_kses_post($ingredients); ?>
					</div>
				<?php endif; ?>

				<?php if ($shipping): ?>
					<h3>PRISTATYMAS</h3>
					<div class="product-shipping">
						<?php echo wp_kses_post($shipping); ?>
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