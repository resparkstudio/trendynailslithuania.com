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

	<section class="relative mt-28 lg:mt-16">
		<div class="flex justify-between w-full mb-7">
			<h3 class="heading-md text-deep-dark-gray lg:text-[1.125rem] lg:leading-[1.375rem] grow w-full">
				<?php echo wp_kses_post("Jums taip pat gali patikti"); ?>
			</h3>
			<div
				class="flex flex-nowrap justify-end items-center body-small-regular uppercase text-deep-dark-gray grow-0 lg:text-[0.75rem] lg:leading-[1.125rem]">
				<a class="flex gap-3 justify-center items-center" href="#">
					<span class="uppercase"><?php echo wp_kses_post("Daugiau"); ?></span>
					<div class="flex items-center">
						<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
								fill="#201F1F" />
						</svg>
					</div>
				</a>
			</div>
		</div>
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

							<div class="aspect-[324/365] object-center w-full relative mb-4 lg:mb-3">
								<a href="<?php the_permalink(); ?>" class="w-full">
									<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>"
										class="w-full h-full object-cover rounded-lg">
								</a>
								<a href="#" class="shop-heart-icon absolute top-5 right-5 z-10">
									<svg width="20" height="18" viewBox="0 0 20 18" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
											stroke="#201F1F" stroke-width="0.7" stroke-linecap="round" fill="none" />
									</svg>
								</a>
								<a href="?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>"
									class="add-item-icon absolute bottom-5 right-5 z-10 p-4 lg:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
											fill="#201F1F" />
									</svg>
								</a>
							</div>

							<a href="<?php the_permalink(); ?>" class="product-title body-normal-regular mb-2.5 lg:mb-7">
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

<!-- New Products Section -->
<?php
$new_product_days = 30;
$args = array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'orderby' => 'date',
	'order' => 'DESC',
	'date_query' => array(
		array(
			'after' => date('Y-m-d', strtotime("-{$new_product_days} days")),
		),
	),
);
$new_product_loop = new WP_Query($args);
?>
<?php if ($new_product_loop->have_posts()): ?>
	<section id="new-products-section" class="mt-20 relative">
		<div class="flex justify-between w-full mb-7">
			<h3 class="w-full heading-md text-deep-dark-gray lg:text-[1.125rem] lg:leading-[1.375rem]">
				<?php echo wp_kses_post("Naujienos"); ?>
			</h3>
			<div
				class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray  lg:text-[0.75rem] lg:leading-[1.125rem]">
				<a class="flex gap-3 justify-center items-center" href="#">
					<span><?php echo wp_kses_post("Daugiau"); ?></span>
					<div class="flex items-center">
						<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
								fill="#201F1F" />
						</svg>
					</div>
				</a>
			</div>
		</div>

		<div class="relative">

			<div class="relative swiper-container overflow-hidden">
				<div id="product-swiper-wrapper" class="swiper-wrapper">
					<?php

					if ($new_product_loop->have_posts()):
						while ($new_product_loop->have_posts()):
							$new_product_loop->the_post();
							?>
							<div class="swiper-slide">
								<div class="relative product-card flex flex-col">
									<?php
									$thumbnail_id = get_post_thumbnail_id($product->get_id());
									$thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
									?>

									<div class="aspect-[324/365] object-center w-full relative mb-4 lg:mb-3">
										<a class="w-full" href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>"
												class="w-full h-full object-cover rounded-lg">
										</a>

										<a href="#" class="shop-heart-icon absolute top-5 right-5 z-10">
											<svg width="20" height="18" viewBox="0 0 20 18" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M17.612 2.41452C17.1722 1.96607 16.65 1.61034 16.0752 1.36763C15.5005 1.12492 14.8844 1 14.2623 1C13.6401 1 13.0241 1.12492 12.4493 1.36763C11.8746 1.61034 11.3524 1.96607 10.9126 2.41452L9.99977 3.34476L9.08699 2.41452C8.19858 1.50912 6.99364 1.00047 5.73725 1.00047C4.48085 1.00047 3.27591 1.50912 2.38751 2.41452C1.4991 3.31992 1 4.5479 1 5.82833C1 7.10875 1.4991 8.33674 2.38751 9.24214L3.30029 10.1724L9.99977 17L16.6992 10.1724L17.612 9.24214C18.0521 8.79391 18.4011 8.26171 18.6393 7.67596C18.8774 7.0902 19 6.46237 19 5.82833C19 5.19428 18.8774 4.56645 18.6393 3.9807C18.4011 3.39494 18.0521 2.86275 17.612 2.41452V2.41452Z"
													stroke="#201F1F" stroke-width="0.7" stroke-linecap="round" fill="none" />
											</svg>
										</a>

										<div class="absolute bottom-5 right-5 z-10">
											<a href="?add-to-cart=<?php echo $product->get_id(); ?>"
												class="add-item-icon flex items-center justify-center p-4 lg:p-2.5 border-[0.5px] border-deep-dark-gray rounded-full">
												<svg width="12" height="12" viewBox="0 0 12 12" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<mask id="path-1-inside-1_46_159" fill="white">
														<path
															d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z" />
													</mask>
													<path
														d="M6.678 0.69V11.91H5.424V0.69H6.678ZM0.452 5.728H11.65V6.872H0.452V5.728Z"
														fill="#201F1F" />
													<path
														d="M6.678 0.69H7.678V-0.31H6.678V0.69ZM6.678 11.91V12.91H7.678V11.91H6.678ZM5.424 11.91H4.424V12.91H5.424V11.91ZM5.424 0.69V-0.31H4.424V0.69H5.424ZM0.452 5.728V4.728H-0.548V5.728H0.452ZM11.65 5.728H12.65V4.728H11.65V5.728ZM11.65 6.872V7.872H12.65V6.872H11.65ZM0.452 6.872H-0.548V7.872H0.452V6.872ZM5.678 0.69V11.91H7.678V0.69H5.678ZM6.678 10.91H5.424V12.91H6.678V10.91ZM6.424 11.91V0.69H4.424V11.91H6.424ZM5.424 1.69H6.678V-0.31H5.424V1.69ZM0.452 6.728H11.65V4.728H0.452V6.728ZM10.65 5.728V6.872H12.65V5.728H10.65ZM11.65 5.872H0.452V7.872H11.65V5.872ZM1.452 6.872V5.728H-0.548V6.872H1.452Z"
														fill="#201F1F" mask="url(#path-1-inside-1_46_159)" />
												</svg>
											</a>
										</div>
									</div>


									<?php
									$categories = get_the_terms($product->get_id(), 'product_cat');
									if (!empty($categories) && !is_wp_error($categories)) {
										$category = $categories[0];
										echo '<a href="' . get_term_link($category) . '" class="product-category body-small-semibold text-black mb-1 lg:mb-2">' . wp_kses_post($category->name) . '</a>';
									}
									?>

									<a href="<?php the_permalink(); ?>">
										<p class="product-title text-wrap body-normal-regular mb-2.5 lg:mb-7">
											<?php the_title(); ?>
										</p>
									</a>

									<div class="product-price">
										<?php woocommerce_template_loop_price(); ?>
									</div>


								</div>

							</div>
						<?php endwhile;
						wp_reset_postdata();
					endif; ?>
				</div>
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
<?php endif; ?>