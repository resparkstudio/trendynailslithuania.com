<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $product;

?>
<?php if ($product->is_on_sale()): ?>
	<div class='price text-deep-dark-gray flex'>
		<div class="body-normal-semibold pr-2.5">
			<span class="woocommerce-Price-amount amount body-normal-semibold"><?php echo $product->get_sale_price() ?>
			</span>
			<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol() ?>
			</span>
		</div>
		<del class="body-small-regular text-mid-gray flex items-center md:text-medium md:text-[0.9375rem]"><?php echo wc_price($product->get_regular_price()); ?>
		</del>
	</div>
<?php else: ?>
	<div class='price text-deep-dark-gray body-normal-semibold'><?php echo $product->get_price_html(); ?></span>
	<?php endif; ?>