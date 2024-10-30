<h3 class="text-deep-dark-gray heading-md mb-1"><?php the_title(); ?></h3>

<?php
global $product;

$attribute_slug = 'pa_ml';
$attribute_value = $product->get_attribute($attribute_slug);

function clean_attribute_slug($slug)
{
	return str_replace('pa_', '', $slug);
}

if ($attribute_value): ?>
	<div class="product-attribute-simple body-extra-small-regular text-deep-dark-gray">
		<?php echo esc_html($attribute_value); ?> 	<?php echo strtoupper(clean_attribute_slug($attribute_slug)); ?>
	</div>
<?php endif; ?>