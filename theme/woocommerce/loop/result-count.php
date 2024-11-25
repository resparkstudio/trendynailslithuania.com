<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.4.0
 */


if (!defined('ABSPATH')) {
	exit;
}

// Function to determine the correct form of "produktas" in Lithuanian
function get_product_name_form($count)
{
	// Convert to absolute value to handle any negative numbers (if needed)
	$count = abs($count);

	// Extract last two digits and last digit for special cases
	$last_digit = $count % 10;
	$last_two_digits = $count % 100;

	// Apply the rules based on Lithuanian grammar
	if ($last_two_digits >= 10 && $last_two_digits <= 19) {
		return 'produktų';
	} elseif ($last_digit === 1) {
		return 'produktas';
	} elseif ($last_digit >= 2 && $last_digit <= 9) {
		return 'produktai';
	} else {
		return 'produktų';
	}
}

// Display the product count with the correct form
$product_form = get_product_name_form($total);
?>
<p class="woocommerce-result-count">
	<?php printf('%d %s', $total, $product_form); ?>
</p>