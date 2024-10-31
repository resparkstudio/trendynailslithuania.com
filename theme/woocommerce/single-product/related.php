<?php
/**
 * Custom Related Products Section with Swiper
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 */

if (!defined('ABSPATH')) {
	exit;
}

global $product;

if (!$product) {
	return;
}

// Get current product categories
$categories = wp_get_post_terms($product->get_id(), 'product_cat');
$category_ids = wp_list_pluck($categories, 'term_id');

$args = array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'post__not_in' => array($product->get_id()),
	'tax_query' => array(
		array(
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => $category_ids,
		),
	),
);

$related_products_query = new WP_Query($args);

if ($related_products_query->have_posts()): ?>

	<section class="relative mt-20">
		<h3 class="heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
			<?php echo wp_kses_post("Jums taip pat gali patikti"); ?>
		</h3>

		<div class="swiper-container overflow-hidden">
			<div class="swiper-wrapper">
				<?php while ($related_products_query->have_posts()):
					$related_products_query->the_post(); ?>
					<div class="swiper-slide">
						<div class="product-card flex flex-col">
							<?php
							$thumbnail_id = get_post_thumbnail_id(get_the_ID());
							$thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
							?>

							<div class="aspect-[324/365] object-center w-full relative mb-4 md:mb-3">
								<a href="<?php the_permalink(); ?>" class="w-full">
									<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>"
										class="w-full h-full object-cover rounded-lg">
								</a>
								<a href="?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>"
									class="add-item-icon absolute bottom-5 right-5 z-10 p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
											fill="#201F1F" />
									</svg>
								</a>
							</div>

							<a href="<?php the_permalink(); ?>" class="product-title body-normal-regular mb-2.5 md:mb-7">
								<?php the_title(); ?>
							</a>

							<div class="product-price">
								<?php woocommerce_template_loop_price(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<!-- Swiper Navigation -->
		<div class="product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
			<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
					fill="black" />
			</svg>
		</div>
		<div class="product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
			<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
					fill="black" />
			</svg>
		</div>
	</section>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
<?php if ($related_products_query->have_posts()): ?>

	<section class="relative mt-20">
		<h3 class="heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
			<?php echo wp_kses_post("Jums taip pat gali patikti"); ?>
		</h3>

		<div class="swiper-container overflow-hidden">
			<div class="swiper-wrapper">
				<?php while ($related_products_query->have_posts()):
					$related_products_query->the_post(); ?>
					<div class="swiper-slide">
						<div class="product-card flex flex-col">
							<?php
							$thumbnail_id = get_post_thumbnail_id(get_the_ID());
							$thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
							?>

							<div class="aspect-[324/365] object-center w-full relative mb-4 md:mb-3">
								<a href="<?php the_permalink(); ?>" class="w-full">
									<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>"
										class="w-full h-full object-cover rounded-lg">
								</a>
								<a href="?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>"
									class="add-item-icon absolute bottom-5 right-5 z-10 p-4 md:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
											fill="#201F1F" />
									</svg>
								</a>
							</div>

							<a href="<?php the_permalink(); ?>" class="product-title body-normal-regular mb-2.5 md:mb-7">
								<?php the_title(); ?>
							</a>

							<div class="product-price">
								<?php woocommerce_template_loop_price(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<!-- Swiper Navigation -->
		<div class="product-nav-button-prev absolute left-[-1.21875rem] z-20 cursor-pointer">
			<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M-6.95394e-07 5L5.25394 10L6 9.29L4.19264 7.58L1.48161 5L4.19264 2.42L5.98949 0.71L5.24343 -3.30706e-08L-6.95394e-07 5Z"
					fill="black" />
			</svg>
		</div>
		<div class="product-nav-button-next absolute right-[-1.21875rem] z-20 cursor-pointer">
			<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
					fill="black" />
			</svg>
		</div>
	</section>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>