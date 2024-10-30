<?php
/**
 * Single Product Image with Swiper Integration
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 */

defined('ABSPATH') || exit;

global $product;

// Get the main product image and gallery images
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
?>

<div
	class="woocommerce-product-gallery aspect-[663/725] inline-block product-gallery-swiper col-span-6 overflow-hidden relative">
	<!-- Swiper Wrapper -->
	<div class="swiper-wrapper aspect-[663/725] w-full relative inline-block h-auto">
		<!-- Main Product Image -->
		<?php if ($post_thumbnail_id): ?>
			<div class="swiper-slide aspect-[663/725] object-center w-full inline-block h-auto">
				<?php echo wp_get_attachment_image($post_thumbnail_id, 'large', false, ['class' => 'w-full h-auto object-cover rounded-lg aspect-[663/725]']); ?>
			</div>
		<?php endif; ?>

		<!-- Product Gallery Images -->
		<?php if ($attachment_ids): ?>
			<?php foreach ($attachment_ids as $attachment_id): ?>
				<div class="swiper-slide aspect-[663/725] object-center w-full inline-block h-auto">
					<?php echo wp_get_attachment_image($attachment_id, 'large', false, ['class' => 'w-full h-auto object-cover rounded-lg aspect-[663/725]']); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>


	</div>

	<!-- Swiper Pagination -->
	<div id="single-product-gallery-swiper-pagination"
		class="z-10 product-gallery-swiper-pagination pb-5 px-5 gap-2 absolute flex justify-end">
	</div>
</div>