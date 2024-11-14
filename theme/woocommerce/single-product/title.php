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