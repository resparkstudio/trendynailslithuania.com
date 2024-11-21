<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */
?>
<div class="mt-5 md:mt-2.5">
	<?php
	if (function_exists('is_checkout') && is_checkout()) {
		if (function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('order-received')) {
			?>
			<div class="md:mb-28 md:mt-2.5">
				<div class="max-w-[87.5rem] mx-auto w-full">
					<div class="mx-12 md:mx-4">
						<header id="thank-you-heading-section">
							<h1
								class="w-full heading-md text-deep-dark-gray mb-12 lg:mb-7 lg:font-medium lg:text-[1.5rem] lg:leading-[2rem]">
								<?php echo wp_kses_post("Atsiskaitymas") ?>
							</h1>
						</header>
					</div>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="mb-48 mt-5 md:mb-28 md:mt-2.5">
				<div class="max-w-[87.5rem] mx-auto w-full">
					<div class="mx-12 md:mx-4">
						<header id="heading-section">
							<h1
								class="w-full heading-md text-deep-dark-gray mb-12 lg:mb-7 lg:font-medium lg:text-[1.5rem] lg:leading-[2rem]">
								<?php echo get_the_title(); ?>
							</h1>
						</header>
					</div>
				</div>
			</div>
			<?php
		}
	}
	?>
	<?php the_content(); ?>
</div>