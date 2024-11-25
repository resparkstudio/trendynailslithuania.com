<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */
?>

<h3 class="text-deep-dark-gray heading-md mb-1 lg:text-[1.125rem] lg:leading-[1.375rem]"><?php the_title(); ?></h3>

<?php
global $product;

function clean_attribute_slug($slug)
{
	return str_replace('pa_', '', $slug);
}

// Get all product attributes
$attributes = $product->get_attributes();
$attribute_strings = [];

// Loop through each attribute
foreach ($attributes as $attribute_slug => $attribute) {
	// Get the attribute value
	$attribute_value = $product->get_attribute($attribute_slug);

	// If the attribute has a value, format it and add to array
	if ($attribute_value) {
		$formatted_attribute = esc_html($attribute_value) . ' ' . clean_attribute_slug($attribute_slug);
		$attribute_strings[] = $formatted_attribute;
	}
}

// Display all attributes in one line, separated by commas
if (!empty($attribute_strings)): ?>
	<div class="product-attributes-inline body-extra-small-regular text-deep-dark-gray">
		<?php echo implode(', ', $attribute_strings); ?>
	</div>
<?php endif; ?>