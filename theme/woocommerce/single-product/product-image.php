<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
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
	<?php
	$wishlist = custom_get_wishlist();
	$is_in_wishlist = in_array($product->get_id(), $wishlist);
	?>

	<a class="shop-heart-icon add-to-wishlist-btn absolute top-5 right-5 z-10 cursor-pointer 
		<?php echo $is_in_wishlist ? 'active' : ''; ?>" data-action="add_to_wishlist"
		data-product_id="<?php echo esc_attr(get_the_ID()); ?>"
		data-product_name="<?php echo esc_attr(get_the_title()); ?>">
		<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
				stroke="#201F1F" stroke-width="0.7" stroke-linecap="round"
				fill="<?php echo $is_in_wishlist ? 'currentColor' : 'none'; ?>" />
		</svg>
	</a>
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