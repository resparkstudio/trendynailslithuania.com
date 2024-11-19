<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="cart-summary">

	<?php wc_get_template('checkout/checkout-product-list.php'); ?>
	<?php wc_get_template('checkout/cart-summary-details.php'); ?>


	<div class="discount-code">
		<label for="discount-code">Įveskite nuolaidos kodą:</label>
		<select id="discount-code">
			<option value="">Choose a discount code</option>
			<!-- Populate dynamically if necessary -->
		</select>
	</div>

	<div class="terms">
		<label>
			<input type="checkbox" required> Su el. prekybos taisyklėmis susipažinau ir sutinku
		</label>
	</div>

	<button class="checkout-button">Apmokėti</button>
</div>