<?php
/**
 * Result Count
 *
 * Shows text: Displaying only the product count with correct Lithuanian pluralization.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
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