<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-order">
	<div class="max-w-[87.5rem] mx-auto w-full">
		<div class="mx-12 md:mx-4">
			<header id="heading-section">
				<h1
					class="w-full heading-md text-deep-dark-gray mb-12 lg:mb-7 lg:font-medium lg:text-[1.5rem] lg:leading-[2rem]">
					<?php echo get_the_title(); ?>
				</h1>
			</header>

			<div class='flex flex-col justify-center items-center mb-48 mt-44 sm:mt-36 text-deep-dark-gray'>
				<?php if ($order): ?>
					<?php $order_number = $order->get_order_number(); ?>

					<?php if ($order->has_status('failed')): ?>
						<h5 class="heading-md block mb-5 md:text-[1.125rem] md:leading-[1.375rem]">
							<?php echo esc_html("Jūsų užsakymas #" . $order_number . "nepateiktas"); ?>
						</h5>
						<p class="body-normal-medium md:mb-8 mb-11">
							<?php echo wp_kses_post("Deja, jūsų užsakymas nepavyko. Pabandykite dar kartą arba susisiekite su mumis!"); ?>
						</p>
					<?php else: ?>
						<h5 class="heading-md block mb-5 md:text-[1.125rem] md:leading-[1.375rem]">
							<?php echo esc_html("Jūsų užsakymas #" . $order_number . " pateiktas"); ?>
						</h5>
						<p class="body-normal-medium md:mb-8 mb-11">
							<?php echo wp_kses_post("Ačiū, kad renkatės mus!"); ?>
						</p>
					<?php endif; ?>

					<a class="black-button uppercase px-28 py-3 sm:w-full sm:px-4 sm:flex sm:justify-center sm:items-center"
						href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
						Į parduotuvę
					</a>
				<?php else: ?>
					<!-- Fallback if no order object is available -->
					<p class="body-normal-medium md:mb-8 mb-11">
						<?php echo wp_kses_post("Įvyko klaida. Prašome bandyti dar kartą."); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>