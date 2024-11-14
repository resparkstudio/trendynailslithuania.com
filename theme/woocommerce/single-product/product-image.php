<?php
/**
 * Single Product Image with Swiper Integration
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 */

defined('ABSPATH') || exit;

global $product;

$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();

$product_date = new DateTime($product->get_date_created());
$date_diff = (new DateTime())->diff($product_date)->days;
$is_new_product = $date_diff <= 30;

$is_discounted = $product->is_on_sale();

?>

<div
	class="woocommerce-product-gallery aspect-[663/725] inline-block product-gallery-swiper col-span-6 overflow-hidden relative lg:col-span-12">

	<?php if ($is_new_product || $is_discounted): ?>
		<div class="absolute top-0 left-0 flex flex-col gap-2.5 mt-7 ml-7 lg:mt-3 lg:ml-3 z-10 lg:gap-2">
			<?php if ($is_new_product): ?>
				<div class="bg-white inline-flex items-center rounded-md px-2 py-1 w-fit">
					<span class="uppercase body-extra-small-regular text-deep-dark-gray">
						<?php echo wp_kses_post("Naujiena"); ?>
					</span>
				</div>
			<?php endif; ?>

			<?php if ($is_discounted): ?>
				<div class="bg-pink inline-flex items-center rounded-md px-2 py-1 w-fit">
					<span
						class="uppercase body-extra-small-regular text-deep-dark-gray"><?php echo wp_kses_post("Išpardavimas"); ?></span>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="swiper-wrapper w-full relative inline-block h-auto">
		<!-- Main Product Image -->
		<?php if ($post_thumbnail_id): ?>
			<div class="swiper-slide aspect-[663/725] object-center w-full inline-block h-auto">
				<?php echo wp_get_attachment_image($post_thumbnail_id, 'large', false, ['class' => 'w-full h-auto object-cover object-center rounded-lg aspect-[663/725]']); ?>
			</div>
		<?php else: ?>
			<div class="swiper-slide aspect-[663/725] object-center w-full inline-block h-auto">
				<?php echo wp_get_attachment_image(7, 'large', false, ['class' => 'w-full h-auto object-cover object-center rounded-lg aspect-[663/725]']); ?>
			</div>
		<?php endif; ?>

		<!-- Product Gallery Images -->
		<?php if ($attachment_ids): ?>
			<?php foreach ($attachment_ids as $attachment_id): ?>
				<div class="swiper-slide aspect-[663/725] object-center w-full inline-block h-auto">
					<?php echo wp_get_attachment_image($attachment_id, 'large', false, ['class' => 'w-full h-auto object-cover rounded-lg aspect-[663/725] object-center']); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>


	</div>

	<div id="single-product-gallery-swiper-pagination"
		class="z-10 product-gallery-swiper-pagination pb-5 px-5 gap-2 absolute flex justify-end">
	</div>
</div>