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
				<header class="mb-10 mt-11 md:mt-10 md:mb-9 flex justify-center">
					<h2 class="heading-lg text-deep-dark-gray md:text-[1.5rem] md:leading-[2rem]"><?php the_title(); ?></h2>
				</header>

				<!-- Excerpt -->
				<div class="mb-16 md:mb-10 text-deep-dark-gray body-normal-regular">
					<?php the_excerpt(); ?>
				</div>

				<!-- Featured Image -->
				<?php if (has_post_thumbnail()): ?>
					<div class="w-full  mb-16 md:mb-10">
						<?php the_post_thumbnail('full', ['class' => 'object-cover object-center aspect-[1341/515] w-full h-auto round-15']); ?>
					</div>
				<?php endif; ?>
				<!-- Content -->
				<div class="single-post-content text-deep-dark-gray mb-28 md:md-16 flex justify-center">
					<div class=max-w-[43.125rem]>
						<?php
						the_content();
						?>
					</div>

				</div>
				<footer class="text-deep-dark-gray">
					<?php
					// Query related posts from the same category
					$current_post_id = get_the_ID();
					$current_post_categories = wp_get_post_categories($current_post_id);
					$args = [
						'post_type' => 'post',
						'posts_per_page' => 8,
						'post__not_in' => [$current_post_id],
						'category__in' => $current_post_categories,
					];
					$related_posts = new WP_Query($args);

					if ($related_posts->have_posts()):
						?>
						<div class="related-posts-swiper-container swiper-container">
							<div class="swiper-wrapper">
								<?php while ($related_posts->have_posts()):
									$related_posts->the_post(); ?>
									<div class="swiper-slide">
										<article id="post-<?php the_ID(); ?>" <?php post_class("related-post-item"); ?>>
											<?php if (has_post_thumbnail()): ?>
												<a href="<?php the_permalink(); ?>" class="related-post-thumbnail">
													<?php the_post_thumbnail('medium', ['class' => 'w-full h-auto object-cover rounded']); ?>
												</a>
											<?php endif; ?>
											<h3 class="related-post-title text-center mt-4">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<a href="<?php the_permalink(); ?>"
												class="related-post-read-more text-center mt-2 block text-blue-500">Daugiau</a>
										</article>
									</div>
								<?php endwhile; ?>
							</div>
						</div>
						<?php
					endif;
					wp_reset_postdata();
					?>

				</footer>
			</article>

			<?php
		endwhile;
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
?>