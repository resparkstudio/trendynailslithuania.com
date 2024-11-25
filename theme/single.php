<?php
get_header();
?>

<section id="primary" class="max-w-[87.5rem] mx-auto w-full">
	<main id="main" class="mx-12 md:mx-4 mb-36 md:mb-32 mt-5 md:mt-2.5">
		<header id="heading-section">
			<h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo wp_kses_post("Blogas"); ?></h1>
		</header>
		<?php
		while (have_posts()):
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class("w-full"); ?>>

				<!-- Post Title -->
				<?php if (get_the_title()): ?>
					<header class="mb-10 mt-11 md:mt-10 md:mb-9 flex justify-center">
						<h2 class="heading-lg text-deep-dark-gray md:text-[1.5rem] md:leading-[2rem]"><?php the_title(); ?></h2>
					</header>
				<?php endif; ?>

				<!-- Excerpt -->
				<?php if (has_excerpt()): ?>
					<div class="mb-16 md:mb-10 text-deep-dark-gray body-normal-regular">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

				<!-- Featured Image -->
				<?php if (has_post_thumbnail()): ?>
					<div class="w-full mb-16 md:mb-10">
						<?php the_post_thumbnail('full', ['class' => 'object-cover object-center aspect-[1341/515] w-full h-auto round-15']); ?>
					</div>
				<?php endif; ?>

				<!-- Content -->
				<?php if (get_the_content()): ?>
					<div class="single-post-content text-deep-dark-gray mb-28 md:md-16 flex justify-center">
						<div class="max-w-[43.125rem] w-full">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php
				// Query related posts
				$current_post_id = get_the_ID();
				$current_post_categories = wp_get_post_categories($current_post_id);
				$args = [
					'post_type' => 'post',
					'post__not_in' => [$current_post_id],
					'category__in' => $current_post_categories,
				];
				$related_posts = new WP_Query($args);

				if ($related_posts->have_posts()):
					?>
					<footer class="text-deep-dark-gray">
						<?php
						// Get category link for "Daugiau" button
						$category = get_the_category();
						$category_url = !empty($category) ? get_category_link($category[0]->term_id) : '#';
						?>

						<div class="flex justify-between w-full mb-7">
							<h3 class="w-full heading-md text-deep-dark-gray md:text-[1.125rem] md:leading-[1.375rem]">
								<?php echo wp_kses_post("Blogas"); ?>
							</h3>
							<div class="w-full flex justify-end items-center body-small-regular uppercase text-deep-dark-gray">
								<a class="daugiau-button flex gap-3" href="<?php echo esc_url($category_url); ?>">
									<span><?php echo wp_kses_post("Daugiau"); ?></span>
									<div class="flex items-center">
										<svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
												fill="#201F1F" />
										</svg>
									</div>
								</a>
							</div>
						</div>
						<div class="related-posts-swiper-container swiper-container overflow-hidden">
							<div class="swiper-wrapper">
								<?php while ($related_posts->have_posts()):
									$related_posts->the_post(); ?>
									<div class="swiper-slide">
										<article id="post-<?php the_ID(); ?>" <?php post_class("related-post-item"); ?>>
											<a href="<?php the_permalink(); ?>" class="related-post-thumbnail block mb-5">
												<?php if (has_post_thumbnail()): ?>
													<?php the_post_thumbnail('medium', [
														'class' => 'w-full h-auto object-cover object-center aspect-center aspect-square round-12',
														'alt' => esc_attr(get_the_title())
													]); ?>
												<?php else: ?>
													<?php echo wp_get_attachment_image(7, 'medium', false, [
														'class' => 'w-full h-auto object-cover object-center aspect-center aspect-square round-12'
													]); ?>
												<?php endif; ?>
											</a>
											<p class="related-post-title mb-4 heading-sm text-deep-dark-gray">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</p>
											<a class="daugiau-button flex gap-3" href="<?php the_permalink(); ?>">
												<span
													class="body-small-regular uppercase text-deep-dark-gray"><?php echo wp_kses_post("Daugiau"); ?></span>
												<div class="flex items-center">
													<svg class="daugiau-button-svg" width="6" height="10" viewBox="0 0 6 10"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<path
															d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
															fill="#201F1F" />
													</svg>
												</div>
											</a>
										</article>
									</div>
								<?php endwhile; ?>
							</div>
						</div>
						<?php

						wp_reset_postdata();
						?>
					</footer>
				<?php endif; ?>
			</article>

			<?php
		endwhile;
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
?>