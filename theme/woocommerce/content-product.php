<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>

<li <?php wc_product_class('product-card flex flex-col col-span-3 lg:col-span-4 md:col-span-6', $product); ?>>
	<div class="aspect-[324/365] w-full relative mb-4 lg:mb-3 product-image-container">
		<?php
		// Get the main product thumbnail
		$thumbnail_id = get_post_thumbnail_id($product->get_id());
		$thumbnail_url = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'medium')[0] : wp_get_attachment_image_src(7, 'medium')[0];

		// Get the first gallery image if available
		$gallery_image_ids = $product->get_gallery_image_ids();
		$first_gallery_image_url = !empty($gallery_image_ids) ? wp_get_attachment_image_src($gallery_image_ids[0], 'medium')[0] : '';
		?>

		<a href="<?php the_permalink(); ?>" class="w-full">
			<!-- Original Image -->
			<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>"
				class="w-full h-full object-cover aspect-[324/365] object-center rounded-lg original-image"
				style="position: relative; opacity: 1;">

			<!-- Gallery Image (displayed on hover) -->
			<?php if ($first_gallery_image_url): ?>
				<img src="<?php echo esc_url($first_gallery_image_url); ?>" alt="<?php the_title(); ?> - Gallery"
					class="w-full h-full object-cover rounded-lg gallery-image"
					style="position: absolute; top: 0; left: 0; opacity: 0;">
			<?php endif; ?>
		</a>
		<a class="shop-heart-icon add-to-wishlist-btn absolute top-5 right-5 z-10 cursor-pointer"
			data-action="add_to_wishlist" data-product_id="<?php echo esc_attr(get_the_ID()); ?>"
			data-product_name="<?php echo esc_attr(get_the_title()); ?>">
			<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
					stroke="#201F1F" stroke-width="0.7" stroke-linecap="round" fill="none" />
			</svg>
		</a>
		<a data-product_id="<?php echo esc_attr($product->get_id()); ?>"
			data-product_name="<?php echo esc_attr(get_the_title()); ?>"
			class="add-item-icon add-to-cart-swiper-btn cursor-pointer absolute bottom-5 right-5 z-10 p-4 lg:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
			<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z" fill="#201F1F" />
			</svg>
		</a>
	</div>
	<?php
	$categories = get_the_terms($product->get_id(), 'product_cat');
	if (!empty($categories) && !is_wp_error($categories)) {
		$category = $categories[0];
		echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 md:mb-2">' . wp_kses_post($category->name) . '</a>';
	}
	?>

	<a href="<?php the_permalink(); ?>" class="product-title body-normal-regular mb-2.5 lg:mb-7">
		<?php woocommerce_template_loop_product_title(); ?>
	</a>

	<div class="product-price">
		<?php woocommerce_template_loop_price(); ?>
	</div>
</li>